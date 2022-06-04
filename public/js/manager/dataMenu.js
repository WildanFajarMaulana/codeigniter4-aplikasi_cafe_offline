$(document).ready(function () {
  function dataMenu() {
    $.ajax({
      url: "/manager/dataMenu",
      dataType: "json",
      success: function (response) {
        $(".v-dataMenu").html(response.data);
      },
    });
  }
  dataMenu();

  $(".btnTambah").on("click", function () {
    $(".modal-title").html("Tambah Menu");
    $("#id").val("");
    $("#nama_menu").val("");
    $("#gambar_menu").val("");
    $("#stok").val("");
    $("#harga").val("");
    $("#kategori").val("");
  });
  $(".menuForm").submit(function (e) {
    e.preventDefault();

    $.ajax({
      type: "post",
      url: $(this).attr("action"),
      data: new FormData(this),
      contentType: false,
      cache: false,
      processData: false,
      dataType: "json",
      beforeSend: function () {
        $(".btnUser").attr("disabled", "disabled");
        $(".btnUser").html(`<div class="spinner-border text-light mt-2" role="status">
              <span class="sr-only">Loading...</span>
            </div>`);
      },
      complete: function () {
        $(".btnUser").removeAttr("disabled");
        $(".btnUser").removeClass("spinner-border text-light");
        $(".btnUser").html("Simpan");
      },
      success: function (response) {
        if (response.error) {
          if (response.error.nama_menu) {
            $("#nama_menuNotif").removeClass("d-none");
            $("#nama_menuNotif").html(response.error.nama_menu);
          } else {
            $("#nama_menuNotif").addClass("d-none");
          }

          if (response.error.gambar_menu) {
            $("#gambar_menuNotif").removeClass("d-none");
            $("#gambar_menuNotif").html(response.error.gambar_menu);
          } else {
            $("#gambar_menuNotif").addClass("d-none");
          }

          if (response.error.stok) {
            $("#stokNotif").removeClass("d-none");
            $("#stokNotif").html(response.error.stok);
          } else {
            $("#stokNotif").addClass("d-none");
          }

          if (response.error.harga) {
            $("#hargaNotif").removeClass("d-none");
            $("#hargaNotif").html(response.error.harga);
          } else {
            $("#hargaNotif").addClass("d-none");
          }
          if (response.error.kategori) {
            $("#kategoriNotif").removeClass("d-none");
            $("#kategoriNotif").html(response.error.kategori);
          } else {
            $("#kategoriNotif").addClass("d-none");
          }
        } else {
          if (response.success) {
            dataMenu();
            $("#id").val("");
            $("#nama_menu").val("");
            $("#gambar_menu").val("");
            $("#stok").val("");
            $("#harga").val("");
            $("#kategori").val("");

            $("#nama_menuNotif").addClass("d-none");
            $("#gambar_menuNotif").addClass("d-none");
            $("#stokNotif").addClass("d-none");
            $("#hargaNotif").addClass("d-none");
            $("#kategoriNotif").addClass("d-none");

            swal.fire({
              icon: "success",
              title: "Berhasil",
              text: response.success,
            });
            $("#modalMenu .close").click();
          }
        }
      },
      error: function (xhr, ajaxOptions, thrownError) {
        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
      },
    });
    return false;
  });
});
