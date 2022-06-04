$(document).ready(function () {
  console.log("okkeranjang");
  function dataKeranjang() {
    $.ajax({
      url: "/kasir/dataKeranjangCard",
      dataType: "json",
      success: function (response) {
        $(".v-dataKeranjang").html(response.data);
      },
    });
  }
  dataKeranjang();

  $(".bayarTranksaksi").on("click", function () {
    let nama_pembeli = $("#nama_pembeli").val();
    let total_pembayaran = $("#total_pembayaran").html();
    let meja = $("#kode_meja").val();
    let bayar_tranksaksi = $("#bayar_tranksaksi").val();

    console.log(nama_pembeli, meja, total_pembayaran);
    $.ajax({
      type: "post",
      url: "/kasir/bayarTranksaksi",
      data: {
        nama_pembeli: nama_pembeli,
        total_pembayaran: total_pembayaran,
        meja: meja,
        bayar_tranksaksi: bayar_tranksaksi,
      },
      dataType: "json",
      success: function (response) {
        if (response.success) {
          Swal.fire({
            icon: "success",
            title: "Success",
            text: response.success,
          });
          setTimeout(function () {
            window.location.href = "/kasir/keranjang";
          }, 1000);
          dataKeranjang();
        }
      },
      error: function (xhr, ajaxOptions, thrownError) {
        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
      },
    });
  });
});
