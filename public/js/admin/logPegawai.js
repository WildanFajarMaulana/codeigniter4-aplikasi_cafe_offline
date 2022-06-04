$(document).ready(function () {
  function dataUser() {
    $.ajax({
      url: "/admin/dataLog",
      dataType: "json",
      success: function (response) {
        $(".v-dataLog").html(response.data);
      },
      error: function (xhr, ajaxOptions, thrownError) {
        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
      },
    });
  }
  dataUser();
});
