let tb;

$(document).ready(function () {
  // $.post(base_url + "menus/listar", { as: 'a' }, function (data) {
  //   // let objData = JSON.parse(data);
  //   console.log(data);
  // });
  tb = $("#sis_menus").dataTable({
    aProcessing: true,
    aServerSide: true,
    language: {
      url: base_url + "js/app/plugins/dataTable.Spanish.json",
    },
    ajax: {
      url: base_url + "admin/menus",
      method: "POST",
      dataSrc: "",
    },
    columns: [
      { data: "nmr" },
      { data: "men_nombre" },
      { data: "ver", class: "text-center" },
      { data: "men_orden", class: "text-center" },
      { data: "options", class: "text-end" },
    ],
    resonsieve: "true",
    bDestroy: true,
    iDisplayLength: 10,
    // order: [[0, "desc"]],
  });

  $("#url_si").change(function () {
    if ($("#url_si").prop("checked")) {
      $(".in_hidde").show("slow");
      $("#url").attr("disabled", false);
      $("#controller").attr("disabled", false);
    } else {
      $(".in_hidde").hide("slow");
      $("#url").attr("disabled", true);
      $("#controller").attr("disabled", true);
    }
  });
});

function fntView(id) {
  let ajaxUrl = base_url + "menus/buscar/" + id;
  $.get(ajaxUrl, function (data) {
    let objData = JSON.parse(data);
    if (objData.status) {
      $("#idmenu").html(objData.data.idmenu);
      $("#men_nombre").html(objData.data.men_nombre);
      $("#men_icono").html(objData.data.men_icono);
      $("#url_si").val(objData.data.men_url_si);
      $("#men_url").html(objData.data.men_url);
      $("#men_controlador").html(objData.data.men_controlador);
      $("#men_orden").html(objData.data.men_orden);
      $("#men_visible").html(objData.data.men_visible);
      $("#men_fecha").html(objData.data.men_fecha);
      $("#mdView").modal("show");
    } else {
      Swal.fire({
        title: objData.title,
        text: objData.text,
        icon: objData.icon,
        confirmButtonText: "ok",
      });
    }
  });
}

function fntEdit(id) {
  let ajaxUrl = base_url + "admin/menus/search";
  $("#titleModal").html("Actualizar menus");
  $(".modal-header").removeClass("headerRegister");
  $(".modal-header").addClass("headerUpdate");
  $("#btnActionForm").removeClass("btn-primary");
  $("#btnActionForm").addClass("btn-info");
  $("#btnText").html("Actualizar");
  $(".div_fecha").removeClass("d-none");
  $("#menus_form").attr("onsubmit", "return update(this,event)");
  $("#modalmenus").modal("show");
  //
  $.post(ajaxUrl, { id: id }, function (data) {
    if (data.status) {
      $("#id").val(data.data.idmenu);
      $("#txtIdmenu").val(data.data.idmenu);
      $("#name").val(data.data.men_nombre);
      $("#icon").val(data.data.men_icono);
      $("#url_si").prop("checked", data.data.men_url_si).trigger("change");
      $("#url").val(data.data.men_url);
      $("#controller").val(data.data.men_controlador);
      $("#order").val(data.data.men_orden);
      $("#visible").val(data.data.men_visible);
      $("#fecha").val(data.data.men_fecha);
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
    title: "Eliminar menus",
    text: "¿Realmente quiere eliminar menus?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, eliminar!",
    cancelButtonText: "No, cancelar!",
  }).then((result) => {
    if (result.isConfirmed) {
      let ajaxUrl = base_url + "admin/menus/delete";
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

function openModal() {
  $(".modal-header").removeClass("headerUpdate");
  $(".modal-header").addClass("headerRegister");
  $("#btnActionForm").removeClass("btn-info");
  $("#btnActionForm").addClass("btn-primary");
  $("#btnText").html("Guardar");
  $("#titleModal").html("Nuevo menus");
  $("#id").val("");
  //document.querySelector("#menus_form").reset();
  $(".in_hidde").hide("slow");
  $(".div_fecha").addClass("d-none");
  $("#txtMen_url").attr("disabled", true);
  $("#menus_form").attr("onsubmit", "return save(this,event)");
  $("#menus_form").trigger("reset");
  $("#modalmenus").modal("show");
}

function save(ths, e) {
  let men_nombre = $("#name").val();
  let form = $(ths).serialize();
  if (men_nombre == "") {
    Swal.fire("Atención", "Es necesario un nombre para continuar.", "warning");
    return false;
  }
  divLoading.css("display", "flex");
  let ajaxUrl = base_url + "admin/menus/save";
  $.post(ajaxUrl, form, function (data) {
    if (data.status) {
      $("#modalmenus").modal("hide");
      Swal.fire("Menu", data.message, "success");
      tb.api().ajax.reload();
    } else {
      Swal.fire("Error", data.message, "warning");
    }
    divLoading.css("display", "none");
  });
  return false;
}

function update(ths, e) {
  let men_nombre = $("#name").val();
  let form = $(ths).serialize();
  if (men_nombre == "") {
    Swal.fire("Atención", "Es necesario un nombre para continuar.", "warning");
    return false;
  }
  divLoading.css("display", "flex");
  let ajaxUrl = base_url + "admin/menus/update";
  $.post(ajaxUrl, form, function (data) {
    if (data.status) {
      $("#modalmenus").modal("hide");
      Swal.fire("Menu", data.message, "success");
      tb.api().ajax.reload();
    } else {
      Swal.fire("Error", data.message, "warning");
    }
    divLoading.css("display", "none");
  });
  return false;
}
