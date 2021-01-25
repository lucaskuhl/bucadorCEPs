/**
 *
 * @param {String} cepOrigem
 * @param {String} cepDestino
 * @param {String} btnType ID do botão para ser escondido
 * @param {String} btnLoading ID do botão de loading a ser mostrado
 */
const validate = (cepOrigem, cepDestino, btnType, btnLoading) => {
  return new Promise((resolve, reject) => {
    let validInput = validateInput(cepOrigem, cepDestino, btnType, btnLoading);
    if (typeof validInput == "undefined") {
      resolve(
        validateAPI(cepOrigem, cepDestino).then((response) => {
          return response;
        })
      );
    }
  });
};

/**
 *
 * @param {String} cepOrigem
 * @param {String} cepDestino
 * @param {String} btnType ID do botão para ser escondido
 * @param {String} btnLoading ID do botão de loading a ser mostrado
 */
const validateInput = (cepOrigem, cepDestino, btnType, btnLoading) => {
  let valid = [];
  if (!cepOrigem || 0 === cepOrigem.length) {
    $("#cep-origem").addClass("is-invalid");
    valid["cep_origem"] = false;
  }

  if (!cepDestino || 0 === cepDestino.length) {
    $("#cep-destino").addClass("is-invalid");
    valid["cep_destino"] = false;
  }
  if (valid["cep_origem"] === false || valid["cep_destino"] === false) {
    $(btnType).show();
    $(btnLoading).hide();
    return valid;
  }
};

/**
 * Manda os dados para o PHP validar os CEPs
 * @param {String} cepOrigem
 * @param {String} cepDestino
 */
const validateAPI = (cepOrigem, cepDestino) => {
  return new Promise((resolve, reject) => {
    $.ajax({
      type: "GET",
      dataType: "json",
      data:
        "action=validate&cep_origem=" +
        cepOrigem +
        "&cep_destino=" +
        cepDestino,
      url: "../api/index.php",
      async: true,
      success: function (response) {
        let valid = [];

        if (response.cep_origem == false) {
          $("#cep-origem").addClass("is-invalid");
          valid["cep_origem"] = response.cep_origem;
        } else {
          $("#cep-origem").removeClass("is-invalid");
          $("#cep-origem").addClass("is-valid");
          valid["cep_origem"] = response.cep_origem;
        }
        if (response.cep_destino == false) {
          $("#cep-destino").addClass("is-invalid");
          valid["cep_destino"] = response.cep_destino;
        } else {
          $("#cep-destino").removeClass("is-invalid");
          $("#cep-destino").addClass("is-valid");
          valid["cep_destino"] = response.cep_destino;
        }
        resolve(valid);
      },
    });
  });
};
