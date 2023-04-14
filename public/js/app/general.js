var divLoading = $("#divLoading");
const Toast = Swal.mixin({
  toast: true,
  position: "top-end",
  showConfirmButton: false,
  showCloseButton: true,
  timer: 3000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener("mouseenter", Swal.stopTimer);
    toast.addEventListener("mouseleave", Swal.resumeTimer);
  },
});
function limitar(e, contenido, caracteres) {
  var unicode = e.keyCode ? e.keyCode : e.charCode;
  if (
    unicode == 8 ||
    unicode == 46 ||
    unicode == 13 ||
    unicode == 9 ||
    unicode == 37 ||
    unicode == 39 ||
    unicode == 38 ||
    unicode == 40
  )
    return true;

  if (contenido.length >= caracteres) return false;

  return true;
}

function cerrar() {
  $(".div_search").hide("slow");
}

function add_carrito(e, id) {
  let ajaxUrl = base_url + "carrito/add";
  var canti = 1;
  if ($("#quantity").length > 0) {
    var input = $("#quantity").val();
    canti = input != "" ? input : 1;
  }

  var datos = {
    id: id,
    cant: canti,
  };
  $.post(ajaxUrl, datos, function (data, textStatus, jqXHR) {
    if (textStatus == "success") {
      Toast.fire({
        icon: data.icon,
        title: data.text,
      });
      if (data.status == true) {
        $("#cantcar").find(".cant_car").show("slow").html(data.data);
      }
    }
  });

  return false;
}
