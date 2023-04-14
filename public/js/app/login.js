$(document).ready(function () {
  $("#frmlogin").submit(function (event) {
    event.preventDefault();
    let ajaxUrl = base_url + "admin/login";
    let form = $(this).serialize();
    $.post(ajaxUrl, form, function (data) {
      if (data.status) {
        Swal.fire({
          title: data.message,
          icon: "success",
          showConfirmButton: false,
          timer: 1100,
          timerProgressBar: true,
        }).then((result) => {
          if (result.dismiss === Swal.DismissReason.timer) {
            window.location.reload();
          }
        });
      } else {
        Swal.fire({
          title: data.message,
          icon: "error",
          confirmButtonText: "ok",
        });
      }
    });
  });
});
