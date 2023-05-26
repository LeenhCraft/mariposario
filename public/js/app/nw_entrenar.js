let tb;
$(document).ready(function () {
  tb = $("#tbl").dataTable({
    aProcessing: true,
    aServerSide: true,
    language: {
      url: base_url + "js/app/plugins/dataTable.Spanish.json",
    },
    ajax: {
      url: base_url + "admin/modelo/datos-de-entrenamiento",
      method: "POST",
      dataSrc: "",
    },
    columns: [{ data: "accion" }, { data: "fecha" }, { data: "ruta" }],
    resonsieve: "true",
    bDestroy: true,
    iDisplayLength: 10,
    // ocultar busqueda
    bFilter: false,
    // ocultar la cantidad de registros a mostrar
    bLengthChange: false,
    // tabla scrollX
    scrollX: true,
    // order: [[0, "desc"]],
  });

  $("#btnEntrenar").click(function () {
    Swal.fire({
      title: "Entrenar",
      text: "¿Estas Seguro, esto tomara unos minutos en procesar?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonText: "Si!",
      cancelButtonText: "No, cancelar!",
    }).then((result) => {
      if (result.isConfirmed) {
        divLoading.css("display", "flex");
        let ajaxUrl = base_url + "admin/modelo/entrenar";
        $.ajax({
          type: "POST",
          url: ajaxUrl,
          //   data: data,
          processData: false,
          contentType: false,
          success: function (data) {
            divLoading.css("display", "none");
            Swal.fire(
              data.status ? "Excelente" : "Atención",
              data.message,
              data.status ? "success" : "warning"
            );
          },
          error: function (error) {
            divLoading.css("display", "none");
            console.log(error);
          },
        });
      }
    });
  });
});

$("#editNameModel").click(function () {
  if ($(this).attr("data-edit") == "true") {
    $("input[name='nombre_modelo']").attr("disabled", "disabled");
    $(this).find(".bxs-save").removeClass("bxs-save").addClass("bxs-edit-alt");
    $(this).attr("data-edit", "false");

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
        let name = $("#nombre_modelo").val();
        let data = new FormData();
        data.append("nombre_modelo", name);
        let ajaxUrl = base_url + "admin/modelo/ruta";
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
            // crear url amigable de name

            $("#nombre_modelo").val(crearSlug(name));
          },
          error: function (error) {
            divLoading.css("display", "none");
            console.log(error);
          },
        });
      }
    });
  } else {
    $("input[name='nombre_modelo']").removeAttr("disabled");
    $(this)
      .find(".bxs-edit-alt")
      .removeClass("bxs-edit-alt")
      .addClass("bxs-save");
    $(this).attr("data-edit", "true");
    $("input[name='nombre_modelo']").focus();
  }
});

function accion(ths, id) {
  divLoading.css("display", "flex");
  let data = new FormData();
  data.append("identrenamiento", id);
  let ajaxUrl = base_url + "admin/modelo/datos";
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
      //   actualizar tabla
      tb.api().ajax.reload();
    },
    error: function (error) {
      divLoading.css("display", "none");
      console.log(error);
    },
  });
  return false;
}
