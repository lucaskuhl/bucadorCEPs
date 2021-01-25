function validate(cepOrigem, cepDestino) {
  return new Promise((resolve, reject) => {
    let validInput = validateInput(cepOrigem, cepDestino);
    if (typeof validInput == "undefined") {
      resolve(
        validateAPI(cepOrigem, cepDestino).then((response) => {
          return response;
        })
      );
    }
  });
}

const validateInput = (cepOrigem, cepDestino) => {
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
    $("#btnSend").show();
    $("#btnLoading").hide();
    return valid;
  }
};

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
