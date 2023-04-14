$(document).ready(function () {
  $("#email").focus();
  $("#reset_form").validate({
    rules: {
      password: {
        required: true,
        minlength: 5,
      },
      password_confirmation: {
        required: true,
        minlength: 5,
        equalTo: "#password",
      },
    },
    messages: {
      password: {
        required: "Debe de ingresar su contraseña",
        minlength: "La contraseña debe de tener al menos 5 caracteres",
      },
      password_confirmation: {
        required: "Debe de ingresar su contraseña",
        minlength: "La contraseña debe de tener al menos 5 caracteres",
        equalTo: "Las contraseñas no coinciden",
      },
    },
    submitHandler: function (form) {
      let data = $("#reset_form").serialize();
      let ajaxUrl = base_url + "reset-password";
      divLoading.css("display", "flex");
      $.post(ajaxUrl, data, function (data) {
        // console.log(data);
        divLoading.css("display", "none");
        Swal.fire({
          title: "¡Éxito!",
          text: data.message,
          icon: "success",
          timer: 1000,
        }).then((result) => {
          if (result.dismiss === Swal.DismissReason.timer) {
            window.location.href = base_url;
          }
        });
      });
    },
  });
});
