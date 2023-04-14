function resend_notification(ths, e) {
  e.preventDefault();
  let data = $(ths).serialize();
  let ajaxUrl = base_url + "email/verification-notification";
  divLoading.css("display", "flex");
  $.post(ajaxUrl, data, function (data) {
    divLoading.css("display", "none");
    if (data.status) {
      $("input[name='_token']").val(data.tk);
      Swal.fire({
        title: "Enviado",
        text: data.message,
        icon: "success",
        confirmButtonText: "ok",
      });
    } else {
      Swal.fire({
        title: "Error",
        text: data.message,
        icon: "error",
        confirmButtonText: "ok",
      });
    }
  });
}
