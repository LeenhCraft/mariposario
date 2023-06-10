let tb;
$(document).ready(function () {
  // tb = $("#tbl").dataTable({
  //   aProcessing: true,
  //   aServerSide: true,
  //   language: {
  //     url: base_url + "js/app/plugins/dataTable.Spanish.json",
  //   },
  //   ajax: {
  //     url: base_url + "admin/historial",
  //     method: "POST",
  //     dataSrc: "",
  //   },
  //   columns: [
  //     { data: "idhistorial" },
  //     { data: "iddetallemodelo" },
  //     { data: "his_tiempo" },
  //     { data: "his_inicio" },
  //     { data: "his_fin" },
  //     { data: "his_index" },
  //     { data: "his_prediccion" },
  //     { data: "his_fecha" },
  //     { data: "options" },
  //   ],
  //   resonsieve: "true",
  //   bDestroy: true,
  //   iDisplayLength: 10,
  //   // order: [[0, "desc"]],
  //   scrollX: true,
  // });
  loadCards();
});
function save(ths, e) {
  // let men_nombre = $("#name").val();
  let form = $(ths).serialize();
  // if (men_nombre == "") {
  //   Swal.fire("Atención", "Es necesario un nombre para continuar.", "warning");
  //   return false;
  // }
  divLoading.css("display", "flex");
  let ajaxUrl = base_url + "admin/historial/save";
  $.post(ajaxUrl, form, function (data) {
    if (data.status) {
      $("#mdlHistorial").modal("hide");
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
function fntEdit(id) {
  resetForm();
  let ajaxUrl = base_url + "admin/historial/search";
  $(".modal-title").html("Agregar Historial");
  $("#btnText").html("Actualizar");
  $("#btnActionForm")
    .removeClass("btn-outline-primary")
    .addClass("btn-outline-info");
  $("#frmHistorial").attr("onsubmit", "return update(this,event)");
  $("#mdlHistorial").modal("show");
  //
  $.post(ajaxUrl, { idhistorial: id }, function (data) {
    if (data.status) {
      $("#idhistorial").val(data.data.idhistorial);
      $("#iddetallemodelo").val(data.data.iddetallemodelo);
      $("#his_tiempo").val(data.data.his_tiempo);
      $("#his_inicio").val(data.data.his_inicio);
      $("#his_fin").val(data.data.his_fin);
      $("#his_index").val(data.data.his_index);
      $("#his_prediccion").val(data.data.his_prediccion);
      $("#his_fecha").val(data.data.his_fecha);
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
  let ajaxUrl = base_url + "admin/historial/update";
  $.post(ajaxUrl, form, function (data) {
    if (data.status) {
      $("#mdlHistorial").modal("hide");
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
    title: "Eliminar Historial",
    text: "¿Realmente quiere eliminar Historial?",
    icon: "warning",
    showCancelButton: true,
    //   confirmButtonColor: "#3085d6",
    //   cancelButtonColor: "#d33",
    confirmButtonText: "Si, eliminar!",
    cancelButtonText: "No, cancelar!",
  }).then((result) => {
    if (result.isConfirmed) {
      let ajaxUrl = base_url + "admin/historial/delete";
      $.post(ajaxUrl, { idhistorial: idp }, function (data) {
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
  $("#titleModal").html("Nuevo Historial");
  $("#idhistorial").val("");
  $("#frmHistorial").attr("onsubmit", "return save(this,event)");
  $("#frmHistorial").trigger("reset");
  $("#mdlHistorial").modal("show");
}
function resetForm(ths) {
  $("#frmHistorial").trigger("reset");
  $("#idhistorial").val("");
  $(ths).attr("onsubmit", "return save(this,event)");
  $("#btnText").html("Guardar");
  $("#btnActionForm").removeClass("btn-info").addClass("btn-outline-primary");
  $(".modal-title").html("Agregar Historial");
}

function loadCards(params = { sort: "es_nombre_cientifico", order: "asc" }) {
  // capturar el parametro page de la url y loa agrego a params
  let url = new URL(window.location.href);
  let page = url.searchParams.get("page");
  let limit = url.searchParams.get("limit");
  params.page = page != null ? page : 1;
  params.limit = limit != null ? limit : 10;
  $(".total-historial .val").html(
    `<div class="spinner-border text-primary m-0" role="status"><span class="visually-hidden">Loading...</span></div>`
  );

  // divLoading.css("display", "flex");
  $(".content-card-butter").html(`
  <div class="col-12 mb-3 spinkit-content">
      <div class="card border h-100" style="min-height:239px;">
          <div class="card-body h-100 d-flex flex-column justify-content-center align-items-center">
              <div class="spinkit-ln mb-3">
                  <div class="sk-chase sk-primary">
                      <div class="sk-chase-dot"></div>
                      <div class="sk-chase-dot"></div>
                      <div class="sk-chase-dot"></div>
                      <div class="sk-chase-dot"></div>
                      <div class="sk-chase-dot"></div>
                      <div class="sk-chase-dot"></div>
                  </div>
              </div>
              <h5>Cargando...</h5>
          </div>
      </div>
  </div>
  `);
  let cards = ``;
  if (arrHistorial.data.length > 0) {
    // dataEspecies = data.data;
    $.each(arrHistorial.data, function (index, value) {
      // paginacion
      let pagination = $(".pagination");
      pagination.empty();

      let prevLink = arrHistorial.prev_page_url
        ? `<a class="page-link" href="${arrHistorial.prev_page_url}">Anterior</a>`
        : `<a class="page-link disabled" href="#">Anterior</a>`;

      let nextLink = arrHistorial.next_page_url
        ? `<a class="page-link" href="${arrHistorial.next_page_url}">Siguiente</a>`
        : `<a class="page-link disabled" href="#">Siguiente</a>`;

      let pageLinks = "";
      for (let i = 1; i <= arrHistorial.last_page; i++) {
        let pageLink = `<a class="page-link" href="/admin/historial?page=${i}&perpage=${arrHistorial.per_page}">${i}</a>`;
        let listItem = `<li class="page-item">${pageLink}</li>`;

        // Marcar la página actual como activa
        if (i === Number(arrHistorial.current_page)) {
          listItem = `<li class="page-item active">${pageLink}</li>`;
        }

        pageLinks += listItem;
      }

      let html = [
        `<li class="page-item">${prevLink}</li>`,
        pageLinks,
        `<li class="page-item">${nextLink}</li>`,
      ];

      pagination.html(html.reduce((acc, curr) => acc + curr, ""));

      $(".total-historial .val")
        .html(`<h2 class="m-0 p-0">` + arrHistorial.total + `</h2>`)
        .fadeIn("slow");

      url = base_url + "img/placeholder/img-placeholder.png";
      if (value.his_img != "") {
        url = base_url + value.his_img;
      }
      cards +=
        `
      <div class="col-12 mb-3">
          <div class="h-100 border-primary border-bottom p-3" style="min-height: 239px;">
              <div class="h-100 d-flex flex-row">
                  <img class="border rounded" src="` +
        url +
        `" alt="" style="max-width: 250px;object-fit: cover;">
                  <div class="col mx-5">
                      <label for="defaultFormControlInput" class="form-label">Especie Predicha</label>
                      <label class="form-control">` +
        value.his_prediccion +
        `</label>
                      <div class="form-text">Identificación en ` +
        Number(value.his_tiempo).toFixed(2) +
        ` segundos</div>
                      <button class="btn btn-outline-primary mt-4">Exportar</button>
                  </div>
              </div>
          </div>
      </div>
      `;
    });
    $(".content-card-butter").html(cards);
    // divLoading.css("display", "none");
  }
}
