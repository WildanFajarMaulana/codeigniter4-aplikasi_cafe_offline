$(document).ready(function () {
  console.log("ok");
  function dataMeja() {
    $.ajax({
      url: "/manager/dataMeja",
      dataType: "json",
      success: function (response) {
        $(".v-dataMeja").html(response.data);
      },
    });
  }
  dataMeja();

  $(".btnTambah").on("click", function () {
    $(".modal-title").html("Tambah Meja");
    $("#status").val("0").attr("selected", "selected");
    $("#id").val("");
    $("#kode_meja").val("");
  });
  $(".mejaForm").submit(function (e) {
    e.preventDefault();

    $.ajax({
      type: "post",
      url: $(this).attr("action"),
      data: $(this).serialize(),
      dataType: "json",
      beforeSend: function () {
        $(".btnMeja").attr("disabled", "disabled");
        $(".btnMeja").html(`<div class="spinner-border text-light mt-2" role="status">
              <span class="sr-only">Loading...</span>
            </div>`);
      },
      complete: function () {
        $(".btnMeja").removeAttr("disabled");
        $(".btnMeja").removeClass("spinner-border text-light");
        $(".btnMeja").html("Simpan");
      },
      success: function (response) {
        if (response.error) {
          if (response.error.kode_meja) {
            $("#kode_mejaNotif").removeClass("d-none");
            $("#kode_mejaNotif").html(response.error.kode_meja);
          } else {
            $("#kode_mejaNotif").addClass("d-none");
          }

          if (response.error.status) {
            $("#statusNotif").removeClass("d-none");
            $("#statusNotif").html(response.error.status);
          } else {
            $("#statusNotif").addClass("d-none");
          }
        } else {
          if (response.success) {
            dataMeja();
            $("#id").val("");
            $("#kode_meja").val("");
            $("#status").val("");

            $("#kode_mejaNotif").addClass("d-none");
            $("#statusNotif").addClass("d-none");

            swal.fire({
              icon: "success",
              title: "Berhasil",
              text: response.success,
            });
            $("#modalMeja .close").click();
          }

          if (response.errorMeja) {
            swal.fire({
              icon: "error",
              title: "gagal",
              text: response.errorMeja,
            });
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
