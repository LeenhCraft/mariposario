let tb;
$(document).ready(function () {
  tb = $("#tb").dataTable({
    aProcessing: true,
    aServerSide: true,
    language: {
      url: base_url + "js/app/plugins/dataTable.Spanish.json",
    },
    ajax: {
      url: base_url + "admin/person",
      method: "POST",
      dataSrc: "",
    },
    columns: [
      { data: "nmr" },
      { data: "name" },
      { data: "email" },
      { data: "status" },
      { data: "opciones" },
    ],
    responsive: "true",
    bDestroy: true,
    iDisplayLength: 10,
    // order: [[0, "desc"]],
  });
});

function openModal() {
  resetForm();
  $("#addModal").modal("show");
}

function fntEdit(idp) {
  let ajaxUrl = base_url + "admin/person/search";
  resetForm();
  $("#person_form").attr("onsubmit", "return update(this,event)");
  $("#titleModal").html("Actualizar");
  $("#btnActionForm").removeClass("btn-primary").addClass("btn-info");
  $("#btnText").html("Actualizar");
  $("#addModal").modal("show");
  //
  $.post(ajaxUrl, { id: idp }, function (data) {
    // console.log(data);
    if (data.status) {
      $("#id").val(data.data.idpersona);
      $("#dni").val(data.data.per_dni);
      $("#name").val(data.data.per_nombre);
      $("#phone").val(data.data.per_celular);
      $("#email").val(data.data.per_email);
      $("#address").val(data.data.per_direcc);
      $("#status").val(data.data.per_estado);
      $(".mostrarimagen").attr("src", data.data.img_url);
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
      let ajaxUrl = base_url + "admin/person/delete";
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

function save(ths, e) {
  let dat = new FormData(ths);
  divLoading.css("display", "flex");
  let ajaxUrl = base_url + "admin/person/save";
  $.ajax({
    type: "POST",
    url: ajaxUrl,
    data: dat,
    processData: false,
    contentType: false,
    success: function (data) {
      if (data.status) {
        $("#addModal").modal("hide");
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
  let dat = new FormData(ths);
  divLoading.css("display", "flex");
  let ajaxUrl = base_url + "admin/person/update";
  $.ajax({
    type: "POST",
    url: ajaxUrl,
    data: dat,
    processData: false,
    contentType: false,
    success: function (data) {
      if (data.status) {
        $("#addModal").modal("hide");
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
    view.attr("src", tmppath);
  }
}

function resetForm(ths) {
  $("#person_form").trigger("reset");
  $("#id").val("");
  $(".mostrarimagen").attr(
    "src",
    "/img/placeholder/woocommerce-placeholder-150x150.png"
  );
  $(ths).attr("onsubmit", "return save(this,event)");
  $("#btnText").html("Guardar");
  $("#btnActionForm").removeClass("btn-info").addClass("btn-primary");
  $(".modal-title").html("Agregar articulo");
}
