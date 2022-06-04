function dataKeranjangTambah() {
  let id_trx = $(".id_trx_tambah").val();
  $.ajax({
    type: "get",
    url: "/kasir/dataKeranjangTrxTambah",
    data: {
      id_trx: id_trx,
    },
    dataType: "json",
    success: function (response) {
      $(".menuTambah").html(response.data);
    },
  });
}
$(document).ready(function () {
  dataKeranjangTambah();
});

$(".btnCariMeja").on("click", function () {
  let kode_meja = $("#kode_meja").val();
  $.ajax({
    type: "post",
    url: "/kasir/cariMeja",
    data: {
      kode_meja: kode_meja,
    },
    dataType: "json",
    success: function (response) {
      if (response.id_trx) {
        setTimeout(function () {
          window.location.href = "/kasir/tambahPesanan/" + response.id_trx;
        }, 1000);
        // dataKeranjang(response.id_trx);
      }
      if (response.error) {
        Swal.fire({
          icon: "warning",
          title: "Warning",
          text: response.error,
        });
      }
    },
    error: function (xhr, ajaxOptions, thrownError) {},
  });
});

$(".formKeranjang").submit(function (e) {
  e.preventDefault();

  $.ajax({
    type: "post",
    url: $(this).attr("action"),
    data: $(this).serialize(),
    dataType: "json",
    beforeSend: function () {
      $(".btnMenu").attr("disabled", "disabled");
      $(".btnMenu").html(`<div class="spinner-border text-light mt-2" role="status">
              <span class="sr-only">Loading...</span>
            </div>`);
    },
    complete: function () {
      $(".btnMenu").removeAttr("disabled");
      $(".btnMenu").removeClass("spinner-border text-light");
      $(".btnMenu").html("Simpan");
    },
    success: function (response) {
      if (response.success) {
        Swal.fire({
          icon: "success",
          title: "Success",
          text: response.success,
        });
        setTimeout(function () {
          window.location.href = "/kasir/tambahPesanan/" + response.id_trx;
        }, 1000);
      }

      if (response.error) {
        Swal.fire({
          icon: "warning",
          title: "error",
          text: response.error,
        });
      }
    },
    error: function (xhr, ajaxOptions, thrownError) {
      alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
    },
  });
  return false;
});
