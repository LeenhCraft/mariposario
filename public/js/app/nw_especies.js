let arrImages = [];
let dropzone = new Dropzone(".dropzone", {
  url: "/admin/especies",
  maxFilesize: 2,
  maxFiles: 1,
  addRemoveLinks: true,
  dictRemoveFile: "Eliminar",
  dictDefaultMessage: "Arrastre las imagenes aqui para subirlas",
  dictResponseError: "Ha ocurrido un error en el servidor",
  dictFallbackMessage: "Su navegador no soporta la carga de archivos",
  dictInvalidFileType: "No puede subir archivos de este tipo",
  dictFileTooBig:
    "El archivo es muy grande ({{filesize}}MiB). Tamaño maximo: {{maxFilesize}}MiB.",
  dictMaxFilesExceeded: "No puede subir mas de {{maxFiles}} archivos.",
  // acceptedFiles: "image/*",
  acceptedFiles: "image/jpeg, image/png, image/jpg",
  // headers: {
  //   "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
  // },
});

dropzone.on("addedfile", (file) => {
  // console.log(file);
  arrImages.push(file);
});

dropzone.on("removedfile", (file) => {
  // console.log(file);
  let index = arrImages.indexOf(file);
  arrImages.splice(index, 1);
});

let tb;
$(document).ready(function () {
  loadOptions(
    "/admin/especies/subordenes",
    "#subordenes",
    "sub_nombre",
    "idsuborden"
  );

  // loadOptions("/admin/especies/generos", "#generos", "gen_nombres", "idgenero");
  tb = $("#tbl").dataTable({
    aProcessing: true,
    aServerSide: true,
    language: {
      url: base_url + "js/app/plugins/dataTable.Spanish.json",
    },
    ajax: {
      url: base_url + "admin/especies",
      method: "POST",
      dataSrc: "",
    },
    columns: [
      { data: "idespecie" },
      { data: "idgenero" },
      { data: "es_nombre_cientifico" },
      { data: "es_nombre_comun" },
      { data: "es_habitad" },
      { data: "es_alimentacion" },
      { data: "es_plantas_hospederas" },
      { data: "es_tiempo_de_vida" },
      { data: "es_imagen_url" },
      { data: "es_date" },
      { data: "options" },
    ],
    resonsieve: "true",
    bDestroy: true,
    iDisplayLength: 10,
    // order: [[0, "desc"]],
  });
});
function save(ths, e) {
  // let men_nombre = $("#name").val();
  let form = new FormData(ths);
  // agregar imagenes a form
  arrImages.forEach((file, index) => {
    form.append("file[" + index + "]", file);
  });

  divLoading = $("#divLoading");
  let ajaxUrl = base_url + "admin/especies/save";
  // if (men_nombre == "") {
  //   Swal.fire("Atención", "Es necesario un nombre para continuar.", "warning");
  //   return false;
  // }
  $.ajax({
    type: "POST",
    url: ajaxUrl,
    data: form,
    processData: false,
    contentType: false,
    success: function (data) {
      if (data.status) {
        resetForm();
        $("#mdlEspecies").modal("hide");
        // Swal.fire("Menu", data.message, "success");
        tb.api().ajax.reload();
        Toast.fire({
          icon: "success",
          title: data.message,
        });
        tb.api().ajax.reload();
      } else {
        Swal.fire("Error", data.message, "warning");
      }
      divLoading.css("display", "none");
    },
    error: function (error) {
      console.log(error);
    },
  });
  return false;
}
function fntEdit(id) {
  resetForm();
  let ajaxUrl = base_url + "admin/especies/search";
  $(".modal-title").html("Agregar Especies");
  $("#btnText").html("Actualizar");
  $("#btnActionForm")
    .removeClass("btn-outline-primary")
    .addClass("btn-outline-info");
  $("#frmEspecies").attr("onsubmit", "return update(this,event)");
  $("#mdlEspecies").modal("show");
  //
  $.post(ajaxUrl, { idespecie: id }, function (data) {
    if (data.status) {
      $("#idespecie").val(data.data.idespecie);
      $("#idgenero").val(data.data.idgenero);
      $("#es_nombre_cientifico").val(data.data.es_nombre_cientifico);
      $("#es_nombre_comun").val(data.data.es_nombre_comun);
      $("#es_habitad").val(data.data.es_habitad);
      $("#es_alimentacion").val(data.data.es_alimentacion);
      $("#es_plantas_hospederas").val(data.data.es_plantas_hospederas);
      $("#es_tiempo_de_vida").val(data.data.es_tiempo_de_vida);
      $("#es_imagen_url").val(data.data.es_imagen_url);
      $("#es_date").val(data.data.es_date);
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
function update(ths, e) {
  // let men_nombre = $("#name").val();
  let form = $(ths).serialize();
  // if (men_nombre == "") {
  //   Swal.fire("Atención", "Es necesario un nombre para continuar.", "warning");
  //   return false;
  // }
  divLoading.css("display", "flex");
  let ajaxUrl = base_url + "admin/especies/update";
  $.post(ajaxUrl, form, function (data) {
    if (data.status) {
      $("#mdlEspecies").modal("hide");
      resetForm();
      Swal.fire("Menu", data.message, "success");
      tb.api().ajax.reload();
    } else {
      Swal.fire("Error", data.message, "warning");
    }
    divLoading.css("display", "none");
  });
  return false;
}
function fntDel(idp) {
  Swal.fire({
    title: "Eliminar Especies",
    text: "¿Realmente quiere eliminar Especies?",
    icon: "warning",
    showCancelButton: true,
    //   confirmButtonColor: "#3085d6",
    //   cancelButtonColor: "#d33",
    confirmButtonText: "Si, eliminar!",
    cancelButtonText: "No, cancelar!",
  }).then((result) => {
    if (result.isConfirmed) {
      let ajaxUrl = base_url + "admin/especies/delete";
      $.post(ajaxUrl, { idespecie: idp }, function (data) {
        if (data.status) {
          Swal.fire({
            title: "Eliminado!",
            text: data.message,
            icon: "success",
            confirmButtonText: "ok",
          });
          tb.DataTable().ajax.reload();
        } else {
          Swal.fire({
            title: "Error",
            text: data.message,
            icon: "error",
            confirmButtonColor: "#007065",
            confirmButtonText: "ok",
          });
        }
      });
    }
  });
}
function openModal() {
  resetForm();
  $("#btnActionForm").removeClass("btn-outline-info");
  $("#btnActionForm").addClass("btn-outline-primary");
  $("#btnText").html("Guardar");
  $("#titleModal").html("Nuevo Especies");
  $("#idespecie").val("");
  $("#frmEspecies").attr("onsubmit", "return save(this,event)");
  $("#frmEspecies").trigger("reset");
  $("#mdlEspecies").modal("show");
}
function resetForm(ths) {
  dropzone.removeAllFiles();
  $("#frmEspecies").trigger("reset");
  $("#idespecie").val("");
  $(ths).attr("onsubmit", "return save(this,event)");
  $("#btnText").html("Guardar");
  $("#btnActionForm").removeClass("btn-info").addClass("btn-outline-primary");
  $(".modal-title").html("Agregar Especies");
}

// Función para cargar las opciones de un select utilizando Ajax
function loadOptions(ruta, selectId, text, attr, param = "") {
  console.log(param);
  $.ajax({
    type: "POST",
    url: ruta,
    data: param,
    dataType: "json",
    success: function (data) {
      $.each(data, function (index, value) {
        $(selectId).append(
          $("<option>").text(value[text]).attr("value", value[attr])
        );
      });
    },
  });
}

function loadFamilias(s) {
  let id = {
    id: $(s).val(),
  };

  loadOptions(
    "/admin/especies/familias",
    "#familias",
    "fam_nombre",
    "idfamilia",
    id
  );
}
