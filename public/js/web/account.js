$(document).ready(function () {
  $("#account_form").validate({
    rules: {
      dni: {
        required: true,
        minlength: 8,
        maxlength: 8,
      },
      name: {
        required: true,
      },
      phone: {
        required: true,
      },
      address: {
        required: true,
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
      phone: {
        required: "Debe de ingresar un número de celular",
      },
      address: {
        required: "Debe de ingresar su dirección",
      },
    },
    submitHandler: function (form) {
      let dat = $(form).serialize();
      let ajaxUrl = base_url + "me";
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
    },
  });
});
