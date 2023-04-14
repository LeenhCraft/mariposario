let tb;
$(document).ready(function () {
  $.fn.modal.Constructor.prototype._initializeFocusTrap = function () {
    return {
      activate: function () {},
      deactivate: function () {},
    };
  };
  initSample();
  lstAutores();
  $("#idautor,#ideditorial,#idarticulo").select2({
    dropdownParent: $("#modal"),
  });
  tb = $("#tb").dataTable({
    aProcessing: true,
    aServerSide: true,
    language: {
      url: base_url + "js/app/plugins/dataTable.Spanish.json",
    },
    ajax: {
      url: base_url + "admin/libros",
      method: "POST",
      dataSrc: "",
    },
    columns: [
      { data: "num", class: "text-left" },
      { data: "name", class: "text-left" },
      { data: "web", class: "text-end" },
      { data: "status", class: "text-center" },
      { data: "options", class: "text-end" },
    ],
    resonsieve: "true",
    bDestroy: true,
    iDisplayLength: 10,
    // order: [[1, "desc"]],
  });
});

function openModal() {
  lstAutores();
  resetForm();
  $("#form").attr("onsubmit", "return save(this,event)");
  $("#modal").modal("show");
}

function viewImg(ths, event) {
  let fileSize = $(ths)[0].files[0].size / 1024 / 1024; // Tamaño del archivo en MB
  if (fileSize > 5) {
    Toast.fire({
      icon: "error",
      title: "El tamaño del archivo no debe superar los 5MB",
    });
    $("#photo").val("");
  } else {
    let view = $(".mostrarimagen");
    let file = $(ths)[0].files[0];
    var tmppath = URL.createObjectURL(event.target.files[0]);
    view
      .html('<img width="140px" src="' + tmppath + '" alt="" id="viewimg">')
      .show("fast");
    $("#photo_url").val("");
  }
}

function viewImgUrl(ths, event) {
  let view = $(".mostrarimagen");
  let file = $(ths).val();
  view
    .html('<img width="140px" src="' + file + '" alt="" id="viewimg">')
    .show("fast");
  $("#photo").val("");
}

function save(ths, e) {
  let sub_nombre = $("#name").val();
  let dat = new FormData(ths);
  let editor = CKEDITOR.instances.description.getData();
  dat.append("description", editor);

  if (sub_nombre == "") {
    Swal.fire("Atención", "Es necesario un nombre para continuar.", "warning");
    return false;
  }
  divLoading.css("display", "flex");
  let ajaxUrl = base_url + "admin/libros/save";
  $.ajax({
    type: "POST",
    url: ajaxUrl,
    data: dat,
    processData: false,
    contentType: false,
    success: function (data) {
      if (data.status) {
        resetForm();
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

function update(ths, e) {
  let sub_nombre = $("#name").val();
  let form = new FormData(ths);
  form.append("description", CKEDITOR.instances.description.getData());
  if (sub_nombre == "") {
    Swal.fire("Atención", "Es necesario un nombre para continuar", "warning");
    return false;
  }
  divLoading.css("display", "flex");
  let ajaxUrl = base_url + "admin/libros/update";
  $.ajax({
    type: "POST",
    url: ajaxUrl,
    data: form,
    processData: false,
    contentType: false,
    success: function (data) {
      if (data.status) {
        $("#modal").modal("hide");
        Swal.fire("articulo", data.message, "success");
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
  lstAutores();
  resetForm();
  let ajaxUrl = base_url + "admin/libros/search";
  $(".modal-title").html("Actualizar articulo");
  $("#btnActionForm").removeClass("btn-primary");
  $("#btnActionForm").addClass("btn-info");
  $("#btnText").html("Actualizar");
  $("#form").attr("onsubmit", "return update(this,event)");
  // $("#form").attr("id", "update_form");
  $("#modal").modal("show");
  //
  $.post(ajaxUrl, { id: id }, function (data) {
    if (data.status) {
      $("#id").val(data.data.idlibro);
      $("#status")
        .prop("checked", data.data.lib_estado == 1)
        .trigger("change");
      $("#idarticulo").val(data.data.idarticulo).trigger("change");
      $("#ideditorial").val(data.data.ideditorial).trigger("change");
      $("#idautor").val(data.data.idautor).trigger("change");
      $("#name").val(data.data.lib_titulo);
      $("#date_publish").val(data.data.lib_fecha_publi);
      $("#pages").val(data.data.lib_num_paginas);
      $("#publish")
        .prop("checked", data.data.lib_publicar == 1)
        .trigger("change");
      $("#slug").val(data.data.lib_slug);
      $(".mostrarimagen")
        .html('<img width="140px" src="' + data.data.photo + '" alt="" id="viewimg">')
        .show("fast");
      $("#photo_url").val("");
      CKEDITOR.instances.description.setData(data.data.lib_descripcion);
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

function fntDel(idp) {
  Swal.fire({
    title: "Eliminar articulo",
    text: "¿Realmente quiere eliminar el articulo?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, eliminar!",
    cancelButtonText: "No, cancelar!",
  }).then((result) => {
    if (result.isConfirmed) {
      let ajaxUrl = base_url + "admin/libros/delete";
      $.post(ajaxUrl, { id: idp }, function (data) {
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

function lstAutores() {
  let ajaxUrl = base_url + "admin/libros/autores";
  $.post(ajaxUrl, function (data) {
    if (data.status) {
      $("#idautor").empty();
      $.each(data.data, function (index, value) {
        $("#idautor").append(
          "<option value=" + value.id + ">" + value.nombre + "</option>"
        );
      });
    }
  });
  ajaxUrl = base_url + "admin/libros/editoriales";
  $.post(ajaxUrl, function (data) {
    if (data.status) {
      $("#ideditorial").empty();
      $.each(data.data, function (index, value) {
        $("#ideditorial").append(
          "<option value=" + value.id + ">" + value.nombre + "</option>"
        );
      });
    }
  });

  ajaxUrl = base_url + "admin/libros/articulos";
  $.post(ajaxUrl, function (data) {
    if (data.status) {
      $("#idarticulo").empty();
      $.each(data.data, function (index, value) {
        $("#idarticulo").append(
          "<option value=" + value.id + ">" + value.nombre + "</option>"
        );
      });
    }
  });
}

function resetForm(ths) {
  $("#form").trigger("reset");
  $("#id").val("");
  $("#idarticulo").trigger("change");
  $("#ideditorial").trigger("change");
  $("#idautor").trigger("change");
  // window.editor.setData("");
  CKEDITOR.instances.description.setData("");
  $(".mostrarimagen").html("").hide("fast");
  $("#img_externa").prop("checked", false).trigger("change");

  $(ths).attr("onsubmit", "return save(this,event)");
  $("#btnText").html("Guardar");
  $("#btnActionForm").removeClass("btn-info").addClass("btn-primary");
  $(".modal-title").html("Agregar articulo");
}

function editSlug(e) {
  if ($(".i_var").hasClass("bxs-pencil")) {
    $("#slug").attr("readonly", false);
    //attr("disabled", false);
    $(".i_var").removeClass("bxs-pencil").addClass("bxs-lock-alt");
  } else {
    $("#slug").attr("readonly", true); //.attr("disabled", true);
    $(".i_var").removeClass("bxs-lock-alt").addClass("bxs-pencil");
  }
}

function crearSlug(slug) {
  slug = slug.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
  slug = slug
    .replace(/[`~!@#$%^&*()_\-+=\[\]{};:'"\\|\/,.<>?\s]/g, " ")
    .toLowerCase();
  slug = slug.replace(/^\s+|\s+$/gm, "");
  slug = slug.replace(/\s+/g, "-");
  $("#slug").val(slug);
}

function imgExterna(ths, e) {
  if ($(ths).prop("checked")) {
    $(".imgExterna").show("fast");
    $(".imgLocal").hide("fast");
  } else {
    $(".imgExterna").hide("fast");
    $(".imgLocal").show("fast");
  }
  $(".mostrarimagen").html("").hide("fast");
}
