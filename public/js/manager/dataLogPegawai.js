$(document).ready(function () {
  console.log("sda");
  function dataLog() {
    $.ajax({
      url: "/manager/dataLog",
      dataType: "json",
      success: function (response) {
        $(".v-dataLog").html(response.data);
      },
    });
  }
  dataLog();
});
