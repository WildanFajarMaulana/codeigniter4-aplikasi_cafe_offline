<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/manager/<?= $css ?>">
    <title><?= $title ?></title>
</head>

<body>
    <div class="container">

        <div class="row">
            <div class="col">
                <section class="sidebar">
                    <div class="judulSidebar">
                        <h4>Selamat Datang </h4>
                    </div>
                    <div class="linkSidebar">
                        <a href="/manager" class="linkChildren">Data Menu</a>
                        <br><br>
                        <a href="/manager/viewMeja" class="linkChildren">Data Meja</a>
                        <br><br>
                        <a href="/manager/viewRiwayatTrx" class="linkChildren">Riwayat Tranksaksi</a>
                        <br><br>
                        <a href="/manager/viewLogPegawai" class="linkChildren">Log Pegawai</a>
                        <br><br>
                        <a class="linkChildren logout">Logout</a>
                    </div>
                </section>
            </div>
            <?= $this->renderSection('content')?>


            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
                integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
                crossorigin="anonymous">
            </script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
                crossorigin="anonymous">
            </script>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"
                integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
            <script src="/sweetalert/package/dist/sweetalert2.all.js"></script>
            <script src="/js/manager/<?= $js ?>"></script>
            <script>
            $(document).ready(function() {
                $(".logout").on("click", function() {

                    $.ajax({
                        type: "post",
                        url: "/auth/logout",
                        dataType: "json",
                        success: function(response) {

                            Swal.fire({
                                type: "success",
                                title: "Logout!",
                                text: response.data,
                            }).then(function() {
                                window.location.href = "/";
                            });
                        },
                        error: function(xhr, ajaxOptions, thrownError) {},
                    });
                });
            });
            </script>


</body>

</html>