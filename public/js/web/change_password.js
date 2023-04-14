function resend(ths, e) {
  let dat = $(ths).serialize();
  let ajaxUrl = base_url + "me/forgot-password";
  divLoading.css("display", "flex");

  $.post(ajaxUrl, dat, function (data) {
    // console.log(data);
    divLoading.css("display", "none");
    Swal.fire({
      // title: data.title,
      text: data.message,
      icon: "success",
      confirmButtonText: "ok",
    });
  });
  return false;
}
