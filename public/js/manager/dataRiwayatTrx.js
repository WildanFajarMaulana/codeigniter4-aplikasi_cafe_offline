$(".filter").on("change", function () {
  if (this.value == "nama_pegawai") {
    $(".namaPegawaiBox").removeClass("d-none");
    $(".tanggalBox").addClass("d-none");
    $(".hariBulanBox").addClass("d-none");
  } else if (this.value == "tanggal") {
    $(".namaPegawaiBox").addClass("d-none");
    $(".tanggalBox").removeClass("d-none");
    $(".hariBulanBox").addClass("d-none");
  } else if (this.value == "hariBulanan") {
    $(".namaPegawaiBox").addClass("d-none");
    $(".tanggalBox").addClass("d-none");
    $(".hariBulanBox").removeClass("d-none");
  } else {
    $(".namaPegawaiBox").addClass("d-none");
    $(".tanggalBox").addClass("d-none");
    $(".hariBulanBox").addClass("d-none");
  }
});
$(document).ready(function () {
  function dataTrx() {
    $.ajax({
      url: "/manager/dataTrx",
      dataType: "json",
      success: function (response) {
        $(".v-dataTrx").html(response.data);
      },
    });
  }
  dataTrx();
});

$(".filterNama").on("change", function () {
  let id_login = this.value;

  $.ajax({
    type: "post",
    url: "/manager/filterNama",
    data: {
      id_login: id_login,
    },
    dataType: "json",
    success: function (response) {
      $(".v-dataTrx").html(response.data);
    },
    error: function (xhr, ajaxOptions, thrownError) {
      alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
    },
  });
});

$(".cariByTanggal").on("click", function () {
  let tanggal_awal = $(".tanggal_awal").val();
  let tanggal_akhir = $(".tanggal_akhir").val();
  $.ajax({
    type: "post",
    url: "/manager/filterTanggal",
    data: {
      tanggal_awal: tanggal_awal,
      tanggal_akhir: tanggal_akhir,
    },
    dataType: "json",
    success: function (response) {
      $(".v-dataTrx").html(response.data);
    },
    error: function (xhr, ajaxOptions, thrownError) {
      alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
    },
  });
});

$(".filterTotalPembayaran").on("change", function () {
  let harianOrBulanan = this.value;

  $.ajax({
    type: "post",
    url: "/manager/filterTotalPembayaran",
    data: {
      harianOrBulanan: harianOrBulanan,
    },
    dataType: "json",
    success: function (response) {
      if (harianOrBulanan == "harian") {
        $(".h4-pendapatan-harian").removeClass("d-none");
        $(".h4-pendapatan-bulanan").addClass("d-none");
        $(".span-pendapatan-harian").html(response.data[0].total_pembayaran);
      } else if (harianOrBulanan == "bulanan") {
        $(".h4-pendapatan-harian").addClass("d-none");
        $(".h4-pendapatan-bulanan").removeClass("d-none");
        $(".span-pendapatan-bulanan").html(response.data[0].total_pembayaran);
      } else {
      }
    },
    error: function (xhr, ajaxOptions, thrownError) {
      alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
    },
  });
});
