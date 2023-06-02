$(document).ready(function () {
  $(".card-result").hide("fast");
  $(".result-img").attr("src", "/img/placeholder/img-placeholder-dark.jpg");
});

function save(ths, e) {
  let form = new FormData(ths);

  divLoading.css("display", "flex");
  let ajaxUrl = base_url + "admin/ia/save";
  $.ajax({
    type: "POST",
    url: ajaxUrl,
    data: form,
    processData: false,
    contentType: false,
    success: function (data) {
      divLoading.css("display", "none");
      Swal.fire(
        data.status ? "Excelente" : "Atención",
        data.message,
        data.status ? "success" : "warning"
      );
      if (data.status) {
        $(".result-img").attr("src", base_url + data.data.es_imagen_url);
        $(".result-name").html(data.data.es_nombre_cientifico);
        $(".result-name-2").html(data.data.es_nombre_comun);
        $(".result-link").attr(
          "href",
          base_url + "admin/especies/" + data.data.es_slug
        );
        // desplazarse hasta el elemento result-img
        $(".card-result").show("slow");
        $("html, body").animate(
          {
            scrollTop: $(".result-img").offset().top,
          },
          1000
        );
      }
    },
    error: function (error) {
      console.log(error);
    },
  });
  return false;
}

var view = $(".dz-message");
var html = view.html();

$("#photo").change(function () {
  clear_result();
  var inputFile = this.files[0];

  var reader = new FileReader();

  reader.onload = function (e) {
    var imageSrc = e.target.result;
    view
      .html(
        `<img class="card-img-top preview" style="max-height: 300px; object-fit:contain;" src="` +
          imageSrc +
          `" alt="Card image cap">`
      )
      .addClass("m-0");
    if (!$("#btn-delete").length) {
      $(".btns").append(
        `<button id="btn-delete" class="btn btn-outline-danger" type="button" onclick="btn_butter()">Quitar</button>`
      );
    }
  };
  reader.readAsDataURL(inputFile);
});

function btn_butter() {
  view.html(html).removeClass("m-0");
  $("#btn-delete").remove();
  $("#photo").val("");
  clear_result();
}

function clear_result() {
  $(".result-img").attr("src", "/img/placeholder/img-placeholder-dark.jpg");
  $(".result-name").html("");
  $(".result-name-2").html("");
  $(".result-link").attr("href", "#");
  $(".card-result").hide("fast");
}
