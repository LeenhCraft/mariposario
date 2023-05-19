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
      if (data.status) {
        console.log(data);
        Toast.fire({
          icon: "success",
          title: data.message,
        });
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
