$(".formLogin").submit(function (e) {
  e.preventDefault();

  $.ajax({
    type: "post",
    url: $(this).attr("action"),
    data: $(this).serialize(),
    dataType: "json",
    beforeSend: function () {
      $(".btnLogin").attr("disabled", "disabled");
      $(".btnLogin").html(`<div class="spinner-border text-light mt-2" role="status">
            <span class="sr-only">Loading...</span>
          </div>`);
    },
    complete: function () {
      $(".btnLogin").removeAttr("disabled");
      $(".btnLogin").removeClass("spinner-border text-light");
      $(".btnLogin").html("Simpan");
    },
    success: function (response) {
      if (response.errorValid) {
        if (response.errorValid.username) {
          $("#usernameNotif").removeClass("d-none");
          $("#usernameNotif").html(response.errorValid.username);
        } else {
          $("#usernameNotif").addClass("d-none");
        }
        if (response.errorValid.password) {
          $("#passwordNotif").removeClass("d-none");
          $("#passwordNotif").html(response.errorValid.password);
        } else {
          $("#passwordNotif").addClass("d-none");
        }
      } else {
        if (response.successKasir) {
          $("#username").val("");
          $("#password").val("");
          $("#usernameNotif").addClass("d-none");
          $("#passwordNotif").addClass("d-none");
          Swal.fire({
            type: "success",
            title: "Login Berhasil!",
            text: "Anda akan di arahkan dalam 3 Detik",
            timer: 3000,
            showCancelButton: false,
            showConfirmButton: false,
          }).then(function () {
            window.location.href = "/kasir/";
          });
        } else if (response.successManager) {
          $("#username").val("");
          $("#password").val("");
          $("#usernameNotif").addClass("d-none");
          $("#passwordNotif").addClass("d-none");
          Swal.fire({
            type: "success",
            title: "Login Berhasil!",
            text: "Anda akan di arahkan dalam 3 Detik",
            timer: 3000,
            showCancelButton: false,
            showConfirmButton: false,
          }).then(function () {
            window.location.href = "/manager/";
          });
        } else if (response.successAdmin) {
          $("#username").val("");
          $("#password").val("");
          $("#usernameNotif").addClass("d-none");
          $("#passwordNotif").addClass("d-none");
          Swal.fire({
            type: "success",
            title: "Login Berhasil!",
            text: "Anda akan di arahkan dalam 3 Detik",
            timer: 3000,
            showCancelButton: false,
            showConfirmButton: false,
          }).then(function () {
            window.location.href = "/admin/";
          });
        } else if (response.successNull) {
          $("#username").val("");
          $("#password").val("");
          $("#usernameNotif").addClass("d-none");
          $("#passwordNotif").addClass("d-none");
          Swal.fire({
            type: "error",
            title: "Login Gagal!",
            text: response.successNull,
          });
        } else if (response.errorPassword) {
          $("#username").val("");
          $("#password").val("");
          $("#usernameNotif").addClass("d-none");
          $("#passwordNotif").addClass("d-none");
          Swal.fire({
            type: "error",
            title: "Login Gagal!",
            text: response.errorPassword,
          });
        } else {
          $("#username").val("");
          $("#password").val("");
          $("#usernameNotif").addClass("d-none");
          $("#passwordNotif").addClass("d-none");
          Swal.fire({
            type: "error",
            title: "Login Gagal!",
            text: response.errorUsername,
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
