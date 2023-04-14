$(document).ready(function () {
  $("#email").focus();
  $("#forgot_form").validate({
    rules: {
      email: {
        required: true,
        email: true,
      },
    },
    messages: {
      email: {
        required: "Debe de ingresar su correo",
        email: "Debe de ingresar un correo valido",
      },
    },
    submitHandler: function (form) {
      let data = $("#forgot_form").serialize();
      let ajaxUrl = base_url + "forgot-password";
      divLoading.css("display", "flex");
      $.post(ajaxUrl, data, function (data) {
        // console.log(data);
        divLoading.css("display", "none");
        if (data.status) {
          Swal.fire({
            title: "success",
            text: data.message,
            icon: "success",
            confirmButtonText: "ok",
          });
        } else {
          Swal.fire({
            title: "error",
            text: data.message,
            icon: "error",
            confirmButtonText: "ok",
          });
        }
      });
    },
  });
});
