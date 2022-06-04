$(document).ready(function () {
  console.log("ok");
  function dataTranksaksiDiproses() {
    $.ajax({
      url: "/kasir/dataTranksaksiDiproses",
      dataType: "json",
      success: function (response) {
        $(".v-dataTranksaksi").html(response.data);
      },
      error: function (xhr, ajaxOptions, thrownError) {
        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
      },
    });
  }
  dataTranksaksiDiproses();
});
