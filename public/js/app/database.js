let tb;
$(document).ready(function () {
  tb = $("#tb").dataTable({
    aProcessing: true,
    aServerSide: true,
    language: {
      url: base_url + "js/app/plugins/dataTable.Spanish.json",
    },
    ajax: {
      url: base_url + "admin/database",
      method: "POST",
      dataSrc: "",
    },
    columns: [
      { data: "name", class: "fw-bold" },
      { data: "des" },
      { data: "options", class: "text-end" },
    ],
    resonsieve: "true",
    bDestroy: true,
    iDisplayLength: 10,
    paging: false,
    searching: false,
    ordering: false,
    info: false,
    // order: [[1, "desc"]],
  });
});

function todo(op) {
  Toast.fire({
    icon: "info",
    title: op,
  });

  Swal.fire({
    title: "Ejecutar tarea",
    text: "Es probable perder datos, ¿Desea continuar?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonText: "Si, ejecutar!",
    cancelButtonText: "No!",
  }).then((result) => {
    if (result.isConfirmed) {
      let ajaxUrl = base_url + "admin/database/execute";
      $.post(ajaxUrl, { id: op }, function (data) {
        Toast.fire({
          icon: data.status ? "success" : "error",
          title: data.message,
        });
      });
    }
  });
}

function openModal() {
  $("#btnActionForm").removeClass("btn-info");
  $("#btnActionForm").addClass("btn-primary");
  $("#btnText").html("Guardar");
  $(".modal-title").html("Nueva tarea");
  $("#id").val("");

  $("#task_form").attr("onsubmit", "return save(this,event)");
  $("#task_form").trigger("reset");
  $("#modal").modal("show");
  $("#name").focus();
}

function save(ths, e) {
  let sub_nombre = $("#name").val();
  let form = $(ths).serialize();
  // console.log(form);
  if (sub_nombre == "") {
    Swal.fire("Atención", "Es necesario un nombre para continuar.", "warning");
    return false;
  }
  divLoading.css("display", "flex");
  let ajaxUrl = base_url + "admin/database/save";
  $.post(ajaxUrl, form, function (data) {
    if (data.status) {
      $("#id").val("");
      $("#task_form").trigger("reset");
      Toast.fire({
        icon: "success",
        title: data.message,
      });
      tb.api().ajax.reload();
    } else {
      Swal.fire("Error", data.message, "warning");
    }
    divLoading.css("display", "none");
  });
  return false;
}

function fntEdit(id) {
  let ajaxUrl = base_url + "admin/database/search";
  $(".modal-title").html("Actualizar Tipo de articulo");
  $("#btnActionForm").removeClass("btn-primary");
  $("#btnActionForm").addClass("btn-info");
  $("#btnText").html("Actualizar");
  $("#task_form").attr("onsubmit", "return update(this,event)");
  $("#modal").modal("show");
  //
  $.post(ajaxUrl, { id: id }, function (data) {
    // console.log(data);
    if (data.status) {
      $("#id").val(data.data.idtarea);
      $("#name").val(data.data.ta_name);
      $("#description").val(data.data.ta_description);
      $("#execute").val(data.data.ta_execute);
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
  let sub_nombre = $("#name").val();

  let form = $(ths).serialize();
  // console.log(form);
  if (sub_nombre == "") {
    Swal.fire("Atención", "Es necesario un nombre para continuar.", "warning");
    return false;
  }
  divLoading.css("display", "flex");
  let ajaxUrl = base_url + "admin/database/update";
  $.post(ajaxUrl, form, function (data) {
    if (data.status) {
      $("#modal").modal("hide");
      Swal.fire("Tipo de Articulo", data.message, "success");
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
    title: "Eliminar submenus",
    text: "¿Realmente quiere eliminar submenus?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, eliminar!",
    cancelButtonText: "No, cancelar!",
  }).then((result) => {
    if (result.isConfirmed) {
      let ajaxUrl = base_url + "admin/database/delete";
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
