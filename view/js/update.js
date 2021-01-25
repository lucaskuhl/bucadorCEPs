const updateCep = (uid, cep_origem, cep_destino) => {
  let cepOrigem = cep_origem;
  let cepDestino = cep_destino;
  let cepId = uid;
  return new Promise((resolve, reject) => {
    updateAPI(cepId, cepOrigem, cepDestino).then((res) => {
      getTableDataUpdate().then((result) => {
        resolve(result);
      });
    });
  });
};

const updateAPI = (cepId, cepOrigem, cepDestino) => {
  return new Promise((resolve, reject) => {
    $.ajax({
      type: "GET",
      dataType: "json",
      data:
        "action=update&cep_id=" +
        cepId +
        "&cep_origem=" +
        cepOrigem +
        "&cep_destino=" +
        cepDestino,
      url: "../api/index.php",
      async: true,
      success: function (response) {
        resolve(response);
      },
    });
  });
};

const updateStyle = (data) => {
  let cepOrigem = data.cep_origem;
  let cepDestino = data.cep_destino;

  $("#btnUpdate").show();
  $("#btnDelete").show();
  $("#btnCancel").show();

  $("#btnSend").hide();
  $("#cep-origem").val(cepOrigem).focus();
  $("#cep-destino").val(cepDestino).focus();
};

const getTableDataUpdate = () => {
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
