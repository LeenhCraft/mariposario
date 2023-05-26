$(document).ready(function () {
  var descMinHeight = $(".desc-wrapper").height();
  var desc = $(".desc");
  var descWrapper = $(".desc-wrapper");

  // show more button if desc too long
  if (desc.height() > descWrapper.height()) {
    $(".more-info").show();
  }

  // When clicking more/less button
  $(".more-info").click(function () {
    var fullHeight = $(".desc").height();

    if ($(this).hasClass("expand")) {
      // contract
      $(".desc-wrapper").animate(
        {
          height: descMinHeight,
        },
        "slow"
      );
    } else {
      // expand
      $(".desc-wrapper")
        .css({
          height: descMinHeight,
          "max-height": "none",
        })
        .animate(
          {
            height: fullHeight,
          },
          "slow"
        );
    }

    $(this).toggleClass("expand");
    let btn = $(".btn-acction");
    if (btn.hasClass("hiden")) {
      btn.removeClass("hiden").show("slow").fadeIn();
    } else {
      btn.addClass("hiden").hide("fast");
    }
    return false;
  });
});
$("#btnEditImg").click(function () {
  if ($(this).attr("data-edit") == "true") {
    save();
  } else {
    $("input[name='carpeta_img_entrenamiento']").removeAttr("disabled");
    $(this)
      .find(".bxs-edit-alt")
      .removeClass("bxs-edit-alt")
      .addClass("bxs-save");
    $(this).attr("data-edit", "true");
    $("input[name='carpeta_img_entrenamiento']").focus();
  }
});

$("#verEspecies").click(function () {
  divLoading.css("display", "flex");
  // let ajaxUrl = base_url + "admin/especies";
  let ajaxUrl = base_url + "admin/entrenamiento/especies";
  $.ajax({
    type: "POST",
    url: ajaxUrl,
    data: {},
    processData: false,
    contentType: false,
    success: function (data) {
      divLoading.css("display", "none");
      let html = "";
      // verificar que data no este vacio
      if (data.length > 0) {
        $.each(data, function (index, value) {
          html +=
            `<div class="border-bottom py-2"><div class="row"><div class="col-6">` +
            value.es_nombre_comun +
            `</div><div class="col-6">` +
            value.total_imagenes +
            ` imagenes</div></div></div>`;
        });
      } else {
        html = `<div class="border-bottom py-2"><div class="row"><div class="col-12">Sin especies e imagenes</div></div></div>`;
      }
      $("#modalCenter .modal-body").html(html);
    },
    error: function (error) {
      divLoading.css("display", "none");
      console.log("error");
      console.log(error);
    },
  });
});

function save() {
  Swal.fire({
    title: "Actualizar",
    text: "¿Estas Seguro?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonText: "Si!",
    cancelButtonText: "No, cancelar!",
  }).then((result) => {
    if (result.isConfirmed) {
      divLoading.css("display", "flex");
      let id = $("#carpeta_img_entrenamiento").val();
      let data = new FormData();
      data.append("carpeta_img_entrenamiento", id);
      let ajaxUrl = base_url + "admin/entrenamiento/imagenes";
      $.ajax({
        type: "POST",
        url: ajaxUrl,
        data: data,
        processData: false,
        contentType: false,
        success: function (data) {
          divLoading.css("display", "none");
          Toast.fire({
            icon: "success",
            title: data.message,
          });
        },
        error: function (error) {
          divLoading.css("display", "none");
          console.log(error);
        },
      });
    }
  });
}

$("#btnRtaEntre").click(function () {
  if ($(this).attr("data-edit") == "true") {
    Swal.fire({
      title: "Actualizar",
      text: "¿Estas Seguro?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonText: "Si!",
      cancelButtonText: "No, cancelar!",
    }).then((result) => {
      if (result.isConfirmed) {
        divLoading.css("display", "flex");
        let id = $("#ruta").val();
        let data = new FormData();
        data.append("ruta_datos_entrenamiento", id);
        let ajaxUrl = base_url + "admin/entrenamiento/ruta";
        $.ajax({
          type: "POST",
          url: ajaxUrl,
          data: data,
          processData: false,
          contentType: false,
          success: function (data) {
            divLoading.css("display", "none");
            Toast.fire({
              icon: "success",
              title: data.message,
            });
          },
          error: function (error) {
            divLoading.css("display", "none");
            console.log(error);
          },
        });
      }
    });
  } else {
    $("input[name='ruta_datos_entrenamiento']").removeAttr("disabled");
    $(this)
      .find(".bxs-edit-alt")
      .removeClass("bxs-edit-alt")
      .addClass("bxs-save");
    $(this).attr("data-edit", "true");
    $("input[name='ruta_datos_entrenamiento']").focus();
  }
});

$("#btnNomEntre").click(function () {
  if ($(this).attr("data-edit") == "true") {
    Swal.fire({
      title: "Actualizar",
      text: "¿Estas Seguro?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonText: "Si!",
      cancelButtonText: "No, cancelar!",
    }).then((result) => {
      if (result.isConfirmed) {
        divLoading.css("display", "flex");
        let id = $("#nombre").val();
        let data = new FormData();
        data.append("nombre_datos_entrenamiento", id);
        let ajaxUrl = base_url + "admin/entrenamiento/nombre";
        $.ajax({
          type: "POST",
          url: ajaxUrl,
          data: data,
          processData: false,
          contentType: false,
          success: function (data) {
            divLoading.css("display", "none");
            Toast.fire({
              icon: "success",
              title: data.message,
            });
          },
          error: function (error) {
            divLoading.css("display", "none");
            console.log(error);
          },
        });
      }
    });
  } else {
    $("input[name='nombre_datos_entrenamiento']").removeAttr("disabled");
    $(this)
      .find(".bxs-edit-alt")
      .removeClass("bxs-edit-alt")
      .addClass("bxs-save");
    $(this).attr("data-edit", "true");
    $("input[name='nombre_datos_entrenamiento']").focus();
  }
});

$(".generar-entrenamiento").click(function () {
  Swal.fire({
    title: "Generar",
    text: "¿Estas Seguro, esto tomara algunos minutos en procesar?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonText: "Si!",
    cancelButtonText: "No, cancelar!",
  }).then((result) => {
    if (result.isConfirmed) {
      divLoading.css("display", "flex");
      let ajaxUrl = base_url + "admin/entrenamiento";
      $.ajax({
        type: "POST",
        url: ajaxUrl,
        // data: {},
        processData: false,
        contentType: false,
        success: function (data) {
          divLoading.css("display", "none");
          Toast.fire({
            icon: "info",
            title: data.message,
          });
        },
        error: function (error) {
          divLoading.css("display", "none");
          console.log(error);
        },
      });
    }
  });
});
