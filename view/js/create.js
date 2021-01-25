const createCep = (cepOrigem, cepDestino) => {
  return new Promise((resolve, reject) => {
    sendDataAPI(cepOrigem, cepDestino).then((res) => {
      getTableData().then((result) => {
        resolve(result);
      });
    });
  });
};

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
