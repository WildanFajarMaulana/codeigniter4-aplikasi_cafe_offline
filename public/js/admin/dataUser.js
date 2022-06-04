$(document).ready(function () {
  function dataUser() {
    $.ajax({
      url: "/admin/dataUser",
      dataType: "json",
      success: function (response) {
        $(".v-dataUser").html(response.data);
      },
    });
  }
  dataUser();

  $(".btnTambah").on("click", function () {
    $(".modal-title").html("Tambah User");
    $("#id").val("");
    $("#nama").val("");
    $("#username").val("");
    $("#password").val("");
    $("#role").val("");
  });
  $(".userForm").submit(function (e) {
    e.preventDefault();

    $.ajax({
      type: "post",
      url: $(this).attr("action"),
      data: $(this).serialize(),
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
          if (response.error.nama) {
            $("#namaNotif").removeClass("d-none");
            $("#namaNotif").html(response.error.nama);
          } else {
            $("#namaNotif").addClass("d-none");
          }

          if (response.error.username) {
            $("#usernameNotif").removeClass("d-none");
            $("#usernameNotif").html(response.error.username);
          } else {
            $("#usernameNotif").addClass("d-none");
          }

          if (response.error.password) {
            $("#passwordNotif").removeClass("d-none");
            $("#passwordNotif").html(response.error.password);
          } else {
            $("#passwordNotif").addClass("d-none");
          }

          if (response.error.role) {
            $("#roleNotif").removeClass("d-none");
            $("#roleNotif").html(response.error.role);
          } else {
            $("#roleNotif").addClass("d-none");
          }
        } else {
          if (response.success) {
            dataUser();
            $("#id").val("");
            $("#nama").val("");
            $("#username").val("");
            $("#password").val("");
            $("#role").val("");

            $("#namaNotif").addClass("d-none");
            $("#usernameNotif").addClass("d-none");
            $("#passwordNotif").addClass("d-none");
            $("#roleNotif").addClass("d-none");
            swal.fire({
              icon: "success",
              title: "Berhasil",
              text: response.success,
            });
            $("#modalUser .close").click();
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
