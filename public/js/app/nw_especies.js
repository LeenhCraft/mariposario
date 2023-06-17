var modal = true;
$(document).ready(function () {
  // funcion que carga antes de mostrar el modal
  $.fn.modal.Constructor.prototype._initializeFocusTrap = function () {
    return {
      activate: function () {},
      deactivate: function () {},
    };
  };

  initSample();
  $("#mdlEspecies").on("show.bs.modal", function (e) {
    loadOptions(
      "/admin/especies/familias",
      "#idfamilia",
      "fam_nombre",
      "idfamilia"
    );
  });

  $("#mdlEspecies").on("hide.bs.modal", function (e) {
    resetForm();
  });

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
  loadCards();
  $('.filters input[type="radio"]').change(function () {
    let sort = $('input[name="sort"]:checked').val();
    let order = $('input[name="order"]:checked').val();
    // loadCards({ sort, order });
    $(".content-card-butter").html(`
      <div class="col-6 col-md-2 mb-3 spinkit-content">
          <div class="card h-100" style="min-height:239px;">
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
    let cards = `
    <div class="col-6 col-md-2 mb-3">
      <div class="card h-100" style="min-height:239px;">
          <a href="#" class="h-100" onclick="openModal()">
              <div class="card-body h-100">
                  <div class="d-flex h-100 justity-content-center align-items-center text-center">
                      <div class="w-100">
                          <i class='bx bxs-plus-circle bx-lg mb-4'></i>
                          <h5>Agregar Nueva Especie</h5>
                      </div>
                  </div>
              </div>
          </a>
      </div>
    </div>`;
    // verificar ´sort´ si idespecie o es_nombre_cientifico esta seleccionado
    if (sort == "idespecie") {
      // ordenar por idespecie
      arrEspecies.data.sort(function (a, b) {
        if (order == "asc") {
          return a.idespecie - b.idespecie;
        } else {
          return b.idespecie - a.idespecie;
        }
      });
    } else {
      // ordenar por es_nombre_cientifico
      arrEspecies.data.sort(function (a, b) {
        if (order == "asc") {
          return a.es_nombre_cientifico.localeCompare(b.es_nombre_cientifico);
        } else {
          return b.es_nombre_cientifico.localeCompare(a.es_nombre_cientifico);
        }
      });
    }
    $.each(arrEspecies.data, function (index, value) {
      url = base_url + "img/placeholder/img-placeholder-dark.jpg";
      if (value.es_imagen_url != "") {
        url = base_url + value.es_imagen_url;
      }
      cards +=
        `<div class="col-6 col-md-2 mb-3">
            <div class="card h-100 overflow-hidden" style="max-height:239px;">
                <a class="text-center" href="` +
        base_url +
        "admin/especies/" +
        value.es_slug +
        `">
                <div class="text-center"><img class="w-100 butter-card-img" src="` +
        url +
        `" alt="` +
        value.es_nombre_cientifico +
        `"></div>
                    <div class="card-body">
                        <h5 class="card-title text-truncate" title="` +
        value.es_nombre_cientifico +
        `">` +
        value.es_nombre_cientifico +
        `</h5>
                    </div>
                </a>
            </div>
        </div>`;
    });
    cards += `<hr>`;
    $(".content-card-butter").html(cards);
  });
});

function openModal() {
  resetForm();
  $("#btnActionForm")
    .removeClass("btn-outline-info")
    .addClass("btn-outline-primary")
    .html("Guardar");
  $(".modal-title").html("Agregar Nueva Especie");
  $("#mdlEspecies").modal("show");
}

function resetForm(ths) {
  $("#form").trigger("reset");
  $(".idsubfamilia").hide("fast");
  $(".idgenero").hide("fast");
  CKEDITOR.instances.description.setData("");
  btn_butter();
}

function btn_butter() {
  view.html(html).removeClass("m-0");
  $("#btn-butter").remove();
  $("#es_imagen_url").val("");
}

function save(ths, e) {
  // let sub_nombre = $("#name").val();
  let dat = new FormData(ths);
  let editor = CKEDITOR.instances.description.getData();
  dat.append("description", editor);

  // if (sub_nombre == "") {
  //   Swal.fire("Atención", "Es necesario un nombre para continuar.", "warning");
  //   return false;
  // }
  divLoading.css("display", "flex");
  let ajaxUrl = base_url + "admin/especies/save";
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
        loadCards();
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

function loadCards_old(
  params = { sort: "es_nombre_cientifico", order: "asc" }
) {
  // capturar el parametro page de la url y loa agrego a params
  let url = new URL(window.location.href);
  let page = url.searchParams.get("page");
  let limit = url.searchParams.get("limit");
  params.page = page != null ? page : 1;
  params.limit = limit != null ? limit : 10;
  $(".total-especies .val").html(
    `<div class="spinner-border text-primary m-0" role="status"><span class="visually-hidden">Loading...</span></div>`
  );

  // divLoading.css("display", "flex");
  $(".content-card-butter").html(`
  <div class="col-6 col-md-2 mb-3 spinkit-content">
      <div class="card h-100" style="min-height:239px;">
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
  let cards = `<div class="col-6 col-md-2 mb-3">
      <div class="card h-100" style="min-height:239px;">
          <a href="#" class="h-100" onclick="openModal()">
              <div class="card-body h-100">
                  <div class="d-flex h-100 justity-content-center align-items-center text-center">
                      <div class="w-100">
                          <i class='bx bxs-plus-circle bx-lg mb-4'></i>
                          <h5>Agregar Nueva Especie</h5>
                      </div>
                  </div>
              </div>
          </a>
      </div>
  </div>`;
  $.ajax({
    type: "POST",
    url: base_url + "admin/especies",
    data: params,
    dataType: "json",
    success: function (data) {
      // console.log(data);
      // verificar que no este vacio
      if (data.data.length > 0) {
        dataEspecies = data.data;
        $.each(data.data, function (index, value) {
          // paginacion
          let pagination = $(".pagination");
          pagination.empty();
          let prevLink = data.prev_page_url
            ? `<a class="page-link" href="${data.prev_page_url}">Anterior</a>`
            : `<a class="page-link disabled" href="#">Anterior</a>`;
          let nextLink = data.next_page_url
            ? `<a class="page-link" href="${data.next_page_url}">Siguiente</a>`
            : `<a class="page-link disabled" href="#">Siguiente</a>`;

          let html = [
            `<li class="page-item">${prevLink}</li>`,
            `<li class="page-item">${nextLink}</li>`,
          ];
          // agregar el active a la pagina actual
          $('.dropdown-menu a[href="?limit=' + data.per_page + '"]').addClass(
            "active"
          );

          pagination.html(html.reduce((acc, curr) => acc + curr, ""));
          $(".total-especies .val")
            .html(`<h2 class="m-0 p-0">` + data.total + `</h2>`)
            .fadeIn("slow");

          url = base_url + "img/placeholder/img-placeholder-dark.jpg";
          if (value.es_imagen_url != "") {
            url = base_url + value.es_imagen_url;
          }
          cards +=
            `<div class="col-6 col-md-2 mb-3">
                <div class="card h-100 overflow-hidden" style="max-height:239px;">
                    <a class="text-center" href="` +
            base_url +
            "admin/especies/" +
            value.es_slug +
            `">
                    <div class="text-center"><img class="w-100 butter-card-img" src="` +
            url +
            `" alt="` +
            value.es_nombre_cientifico +
            `"></div>
                        <div class="card-body">
                            <h5 class="card-title text-truncate" title="` +
            value.es_nombre_cientifico +
            `">` +
            value.es_nombre_cientifico +
            `</h5>
                        </div>
                    </a>
                </div>
            </div>`;
        });
        cards += `<hr>`;
        $(".content-card-butter").html(cards);
        // divLoading.css("display", "none");
      }
    },
  });
}
