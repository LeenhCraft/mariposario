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
      Swal.fire(
        data.status ? "Excelente" : "Atención",
        data.message,
        data.status ? "success" : "warning"
      );
      divLoading.css("display", "none");
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
}
