let tb;
$(document).ready(function () {
  lstAutores();
  $("#idlibro").select2({
    dropdownParent: $("#modal"),
  });
  // tb = $("#tb").dataTable({
  //   aProcessing: true,
  //   aServerSide: true,
  //   language: {
  //     url: base_url + "js/app/plugins/dataTable.Spanish.json",
  //   },
  //   ajax: {
  //     url: base_url + "admin/copias",
  //     method: "POST",
  //     dataSrc: "",
  //   },
  //   columns: [
  //     { data: "num", class: "text-left" },
  //     { data: "name", class: "text-left" },
  //     { data: "cod", class: "text-left" },
  //     { data: "status", class: "text-center" },
  //     { data: "options", class: "text-end" },
  //   ],
  //   resonsieve: "true",
  //   bDestroy: true,
  //   iDisplayLength: 10,
  //   // order: [[1, "desc"]],
  // });
});

function openModal() {
  lstAutores();
  resetForm();
  $("#form").attr("onsubmit", "return save(this,event)");
  $("#modal").modal("show");
}

function save(ths, e) {
  // let sub_nombre = $("#name").val();
  let dat = new FormData(ths);
  // if (sub_nombre == "") {
  //   Swal.fire("Atención", "Es necesario un nombre para el submenu.", "warning");
  //   return false;
  // }
  divLoading.css("display", "flex");
  let ajaxUrl = base_url + "admin/copias/save";
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
  // let sub_nombre = $("#name").val();
  let form = new FormData(ths);
  // if (sub_nombre == "") {
  //   Swal.fire("Atención", "Es necesario un nombre para continuar", "warning");
  //   return false;
  // }
  divLoading.css("display", "flex");
  let ajaxUrl = base_url + "admin/copias/update";
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
  let ajaxUrl = base_url + "admin/copias/search";
  $(".modal-title").html("Actualizar articulo");
  $("#btnActionForm").removeClass("btn-outline-primary");
  $("#btnActionForm").addClass("btn-info");
  $("#btnText").html("Actualizar");
  $("#form").attr("onsubmit", "return update(this,event)");
  // $("#form").attr("id", "update_form");
  $("#modal").modal("show");
  //
  $.post(ajaxUrl, { id: id }, function (data) {
    if (data.status) {
      $("#id").val(data.data.idcopias);
      $("#idlibro").val(data.data.idlibro).trigger("change");
      $("#name").val(data.data.cop_codinventario);
      $("#ubicacion").val(data.data.cop_ubicacion);
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
      let ajaxUrl = base_url + "admin/copias/delete";
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
  let ajaxUrl = base_url + "admin/copias/libros";
  $.post(ajaxUrl, function (data) {
    if (data.status) {
      $("#idlibro").empty();
      $.each(data.data, function (index, value) {
        $("#idlibro").append(
          "<option value=" + value.id + ">" + value.nombre + "</option>"
        );
      });
    }
  });
}

function resetForm(ths) {
  $("#form").trigger("reset");
  $("#idlibro").trigger("change");
  $("#id").val("");
  $(ths).attr("onsubmit", "return save(this,event)");
  $("#btnText").html("Guardar");
  $("#btnActionForm").removeClass("btn-info").addClass("btn-outline-primary");
  $(".modal-title").html("Agregar copia");
}
