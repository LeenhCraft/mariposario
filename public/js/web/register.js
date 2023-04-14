$(document).ready(function () {
  $("#dni").focus();
  $("#register_form").validate({
    rules: {
      dni: {
        required: true,
        minlength: 8,
        maxlength: 8,
      },
      name: {
        required: true,
      },
      email: {
        required: true,
        email: true,
      },
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
      dni: {
        required: "Debe de ingresar su DNI",
        minlength: "El DNI debe de tener 8 caracteres",
        maxlength: "El DNI debe de tener 8 caracteres",
      },
      name: {
        required: "Debe de ingresar su nombre",
      },
      email: {
        required: "Debe de ingresar su correo",
        email: "Debe de ingresar un correo valido",
      },
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
        let data = $("#register_form").serialize();
        let ajaxUrl = base_url + "register";
        divLoading.css("display", "flex");
        $.post(ajaxUrl, data, function (data) {
          // console.log(data);
          divLoading.css("display", "none");
          if (data.status) {
            let tk = data.data.token ?? "#";
            $(".login_part_form_iner").html(
              `<h1 class="text-center text-md-left">Gracias por registrarte!<br><b>` +
                data.data.name +
                `</b></h1>
            <p>Antes de comenzar, ¿podría verificar su dirección de correo electrónico haciendo clic en el enlace que le acabamos de enviar? Si no recibiste el correo electrónico, con gusto te enviaremos otro.</p>
            <form id="resend_notification" method="post" onsubmit="resend_notification(this,event)" class="mt-3">
            <input type="hidden" name="_token" value="` +
                tk +
                `">
            <button type="submit" value="submit" class="btn_3">Resend Verification Email</button>
            </form>`
            );
          } else {
            Swal.fire({
              title: "Error",
              text: data.message,
              icon: "error",
              confirmButtonText: "ok",
            });
          }
        });
    },
  });
});
