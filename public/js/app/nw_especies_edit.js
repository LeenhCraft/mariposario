var view = $(".dz-message");
var html = `Haga click aqui para cargar una imagen<br><span class="note needsclick">(Esta imagen es la <strong>referencia</strong> para la especie.)</span>`;
$(document).ready(function () {
  $(".especie-edit").hide("fast");

  $.fn.modal.Constructor.prototype._initializeFocusTrap = function () {
    return {
      activate: function () {},
      deactivate: function () {},
    };
  };
  initSample();
  // loadOptions(
  //   "/admin/especies/familias",
  //   "#idfamilia",
  //   "fam_nombre",
  //   "idfamilia"
  // );
  $("#es_imagen_url").change(function () {
    var inputFile = this.files[0];

    var reader = new FileReader();

    reader.onload = function (e) {
      var imageSrc = e.target.result;
      view
        .html(
          `<img class="card-img-top preview" src="` +
            imageSrc +
            `" alt="Card image cap">`
        )
        .addClass("m-0");
      // comprobar si existe el boton btn-butter
      if (!$("#btn-butter").length) {
        $("#navs-dos").append(
          `<button id="btn-butter" class="btn btn-sm btn-danger mt-3" type="button" onclick="btn_butter()">Eliminar</button>`
        );
      }
    };
    reader.readAsDataURL(inputFile);
  });
  $("#idfamilia").change(function () {
    loadOptions(
      "/admin/especies/subfamilias",
      "#idsubfamilia",
      "sub_nombre",
      "idsubfamilia",
      { idfamilia: this.value }
    );
    $(".idsubfamilia").show("slow");
  });
  $("#idsubfamilia").change(function () {
    loadOptions(
      "/admin/especies/generos",
      "#idgenero",
      "gen_nombres",
      "idgenero",
      { idsubfamilia: this.value }
    );
    $(".idgenero").show("slow");
  });
  // loadCards();
  $(".btn-especie-edit").click(function () {
    divLoading.css("display", "flex");
    let ajaxUrl = base_url + "admin/especies/search";
    let id = $("#idespecie").val();
    let data = new FormData();
    data.append("idespecie", id);
    $.ajax({
      type: "POST",
      url: ajaxUrl,
      data: data,
      processData: false,
      contentType: false,
      success: function (data) {
        if (data.status) {
          // data.data.es_imagen_url no este vacio
          if (data.data.es_imagen_url != "") {
            view.html(
              `<img class="card-img-top preview" src="` +
                base_url +
                data.data.es_imagen_url +
                `" alt="Card image cap">`
            );
          }
          $("#es_nombre_comun").val(data.data.es_nombre_comun);
          $("#es_nombre_cientifico").val(data.data.es_nombre_cientifico);

          $("#idfamilia").empty();
          $.each(data.familias, function (index, value) {
            $("#idfamilia").append(
              $("<option>")
                .text(value.fam_nombre)
                .attr("value", value.idfamilia)
            );
          });
          $("#idsubfamilia").empty();
          $.each(data.subfamilias, function (index, value) {
            $("#idsubfamilia").append(
              $("<option>")
                .text(value.sub_nombre)
                .attr("value", value.idsubfamilia)
            );
          });
          $("#idgenero").empty();
          $.each(data.generos, function (index, value) {
            $("#idgenero").append(
              $("<option>")
                .text(value.gen_nombres)
                .attr("value", value.idgenero)
            );
          });

          $("#idfamilia").val(data.data.familia.idfamilia);
          $("#idsubfamilia").val(data.data.subfamilia.idsubfamilia);
          $("#idgenero").val(data.data.genero.idgenero);
          CKEDITOR.instances.description.setData(data.data.es_descripcion);
        }
        divLoading.css("display", "none");
      },
      error: function (error) {
        divLoading.css("display", "none");
        console.log(error);
      },
    });
    $(".especie-edit").show("slow");
    $(".especie-view").hide("fast");
  });
  $(".btn-especie-entre").click(function () {
    $(".especie-view").hide("fast");
    $(".especie-edit").hide("fast");
    $(".especie-entre").show("slow");
    // peticion ajax a /admin/especies/view enviando el valor idespcie y la prespuesta mostrando en consola
    let ajaxUrl = base_url + "admin/especies/view";
    let id = $("#idespecie").val();
    let data = new FormData();
    data.append("idespecie", id);
    $.ajax({
      type: "POST",
      url: ajaxUrl,
      data: data,
      processData: false,
      contentType: false,
      success: function (data) {
        // contar data
        let count = Object.keys(data).length;
        $(".numimgentre").html(count);
        // mostrar data en viewimgentre
        $(".viewimgentre").empty();
        $.each(data, function (index, value) {
          $(".viewimgentre").append(
            `<div class="col-6 col-md-2 mb-3">
            <div class="card h-100 overflow-hidden" style="max-height:239px;">
                <div class="text-center">
                  <img class="w-100 butter-card-img" src="` +
              base_url +
              value +
              `" alt="Demo">
                </div>
                <div class="card-body text-center">
                    <button class="btn btn-sm btn-outline-danger" onclick="return delete_img(this,'` +
              value +
              `')"><i class='bx bxs-trash-alt'></i></button>
                </div>
            </div>
        </div>`
          );
        });
      },
    });
  });
  $(".btn-especie-cancel").click(function () {
    $(".especie-view").show("slow");
    $(".especie-edit").hide("fast");
    $(".especie-entre").hide("fast");
  });
  $(".btn-especie-delete").click(function () {
    let id = $("#idespecie").val();
    Swal.fire({
      title: "Eliminar Especie",
      text: "¿Realmente quiere eliminar esta especie?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonText: "Si, eliminar!",
      cancelButtonText: "No, cancelar!",
    }).then((result) => {
      if (result.isConfirmed) {
        let ajaxUrl = base_url + "admin/especies/delete";
        $.post(ajaxUrl, { idespecie: id }, function (data) {
          if (data.status) {
            Swal.fire({
              title: "Eliminado!",
              text: data.message,
              icon: "success",
              confirmButtonText: "ok",
            }).then((result) => {
              window.history.back();
            });
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
  });

  // dropzone
  Dropzone.autoDiscover = false;

  // Configurar Dropzone
  var myDropzone = new Dropzone("#myDropzone", {
    url: base_url + "admin/especies/upload",
    paramName: "file", // Nombre del archivo en el backend
    maxFilesize: 5, // Tamaño máximo del archivo en MB
    acceptedFiles: ".jpg, .jpeg, .png", // Tipos de archivo permitidos
    maxFiles: 20, //
    thumbnailWidth: 160,
    thumbnailHeight: 160,
    // thumbnailMethod: "contain",
    parallelUploads: 20,
    // previewTemplate: previewTemplate,
    autoQueue: true,
    // previewsContainer: "#previews",
    // clickable: ".fileinput-button",
    addRemoveLinks: !0,
    init: function () {
      // success
      this.on("success", function (file, response) {
        // Callback cuando el archivo se sube exitosamente
        Toast.fire({
          icon: "success",
          title: response.message,
        });
        // console.log(response);
      });
      this.on("sending", function (file, xhr, formData) {
        // Callback antes de enviar el archivo
        formData.append("idespecie", $("#idespecie").val()); // Agregar el parámetro adicional al formData
      });

      this.on("complete", function (file) {
        myDropzone.removeAllFiles(); // Limpiar el área de Dropzone
        // console.log(file);
      });
    },
  });
});

function update(ths, e) {
  // let sub_nombre = $("#name").val();
  let dat = new FormData(ths);

  dat.append("idespecie", $("#idespecie").val());
  let editor = CKEDITOR.instances.description.getData();
  dat.append("description", editor);

  // if (sub_nombre == "") {
  //   Swal.fire("Atención", "Es necesario un nombre para continuar.", "warning");
  //   return false;
  // }
  divLoading.css("display", "flex");
  let ajaxUrl = base_url + "admin/especies/update";
  $.ajax({
    type: "POST",
    url: ajaxUrl,
    data: dat,
    processData: false,
    contentType: false,
    success: function (data) {
      if (data.status) {
        Toast.fire({
          icon: "success",
          title: data.message,
        });
        // recargar la pagina
        setTimeout(function () {
          location.reload();
        }, 1000);
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

function loadOptions(ruta, selectId, text, attr, param = "") {
  $(selectId).empty();
  $(selectId).append($("<option>").text("Seleccione").attr("value", "0"));
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

function btn_butter() {
  $("#eliminar_img").val(1);
  view.html(html).removeClass("m-0");
  $("#btn-butter").remove();
  $("#es_imagen_url").val("");
}

//funcion de eliminar imagen
function delete_img(ths, path) {
  Swal.fire({
    title: "Eliminar",
    text: "¿Realmente quiere eliminar la imagen?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonText: "Si, eliminar!",
    cancelButtonText: "No, cancelar!",
  }).then((result) => {
    if (result.isConfirmed) {
      let ajaxUrl = base_url + "admin/especies/destroy";
      let data = new FormData();
      data.append("ruta", path);
      $.ajax({
        type: "POST",
        url: ajaxUrl,
        data: data,
        processData: false,
        contentType: false,
        success: function (data) {
          Toast.fire({
            icon: "info",
            title: data.message,
          });
          $(".btn-especie-entre").eq(0).trigger("click"); // Activará el evento "click" en el primer elemento
        },
      });
    }
  });
  return false;
}
