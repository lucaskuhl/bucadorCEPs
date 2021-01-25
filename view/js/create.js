function createCep(cepOrigem, cepDestino) {
  let data = [];
  console.log(cepOrigem);
  console.log(cepDestino);
  $.ajax({
    type: "GET",
    dataType: "json",
    data: "action=add&cep_origem=" + cepOrigem + "&cep_destino=" + cepDestino,
    url: "../api/index.php",
    async: false,
    success: function (response) {
      $.ajax({
        type: "GET",
        dataType: "json",
        data: "action=read",
        url: "../api/index.php",
        async: false,
        success: function (res) {
            console.log("oi");
            data = JSON.parse(res);
        },
      });
    },
    error: function (response) {
      console.log(response);
    },
  });
  return data;
}
