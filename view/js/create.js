/**
 *
 * @param {String} cepOrigem
 * @param {String} cepDestino
 */
const createCep = (cepOrigem, cepDestino) => {
  return new Promise((resolve, reject) => {
    sendDataAPI(cepOrigem, cepDestino).then((res) => {
      getTableData().then((result) => {
        resolve(result);
      });
    });
  });
};

/**
 * Manda os dados para o php criar
 *
 * @param {Strign} cepOrigem
 * @param {String} cepDestino
 */
const sendDataAPI = (cepOrigem, cepDestino) => {
  return new Promise((resolve, reject) => {
    $.ajax({
      type: "GET",
      dataType: "json",
      data: "action=add&cep_origem=" + cepOrigem + "&cep_destino=" + cepDestino,
      url: "../api/index.php",
      async: true,
      success: function (response) {
        resolve(response);
      },
    });
  });
};

/**
 * Pega os dados para recriar a tabela
 */
const getTableData = () => {
  return new Promise((resolve, reject) => {
    $.ajax({
      type: "GET",
      dataType: "json",
      data: "action=read",
      url: "../api/index.php",
      async: true,
      success: function (response) {
        resolve(response);
      },
    });
  });
};
