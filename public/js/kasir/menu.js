$(document).ready(function () {
  console.log("ok");
  function dataMenu() {
    $.ajax({
      url: "/kasir/dataMenu",
      dataType: "json",
      success: function (response) {
        $(".v-dataMenu").html(response.data);
      },
    });
  }
  dataMenu();

  //   $(".btnTambah").on("click", function () {
  //     $(".modal-title").html("Tambah Meja");
  //     $("#status").val("0").attr("selected", "selected");
  //     $("#id").val("");
  //     $("#kode_meja").val("");
  //   });
  $(".formKeranjang").submit(function (e) {
    e.preventDefault();
    let jumlahValue = $(".jumlahValue").val();
    if (!jumlahValue) {
      swal.fire({
        icon: "warning",
        title: "Gagal",
        text: "Masukkan Jumlah Menu",
      });
      return false;
    }
    if (jumlahValue == 0) {
      swal.fire({
        icon: "error",
        title: "Gagal",
        text: "Menu tidak boleh kosong",
      });
      return false;
    }

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
        $(".btnMenu").html("tambah");
      },
      success: function (response) {
        if (response.success) {
          dataMenu();

          swal.fire({
            icon: "success",
            title: "Berhasil",
            text: response.success,
          });
          $(".jumlahValue").val("");
          $("#modalMenu .close").click();
        }

        if (response.error) {
          swal.fire({
            icon: "warning",
            title: "Gagal",
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
});
