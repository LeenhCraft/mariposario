$(document).ready(function () {
  $("#email").focus();
  $("#form_login").validate({
    rules: {
      email: {
        required: true,
      },
      password: {
        required: true,
      },
    },
    messages: {
      email: {
        required: "Debe de ingresar su correo",
      },
      password: {
        required: "Debe de ingresar su contraseña",
      },
    },
    submitHandler: function (form) {
      let data = $("#form_login").serialize();
      divLoading.css("display", "flex");
      let ajaxUrl = base_url + "login";
      $.post(ajaxUrl, data, function (data) {
        divLoading.css("display", "none");
        // console.log(data);
        if (data.status) {
          Toast.fire({
            icon: "success",
            title: data.message,
            timer: 1000,
          }).then((result) => {
            if (result.dismiss === Swal.DismissReason.timer) {
              window.location.reload();
            }
          });
        } else {
          Swal.fire({
            title: "Advertencia!",
            text: data.message,
            icon: "warning",
            confirmButtonText: "ok",
          });
        }
      });
    },
  });
});
