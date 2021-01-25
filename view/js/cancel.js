/**
 * Reseta os botões e os inputs para a forma original
 */
const cancel = () => {
  $("#cep-origem").val("").removeClass("active");
  $("#cep-destino").val("").removeClass("active");

  $("#btnCancel").hide();
  $("#btnUpdate").hide();
  $("#btnLoadingUpdate").hide();
  $("#btnDelete").hide();
  $("#btnLoadingDelete").hide();
  $("#btnLoading").hide();
  $("#btnSend").show();
  $("#cep-origem").removeClass("is-valid");
  $("#cep-destino").removeClass("is-valid");
  $("#cep-origem").removeClass("is-invalid");
  $("#cep-destino").removeClass("is-invalid");
};
