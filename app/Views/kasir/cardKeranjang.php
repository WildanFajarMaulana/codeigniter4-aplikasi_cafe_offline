<?php foreach($dataKeranjangCard as $dm){ ?>
<div class="col mt-3 mb-3">
    <div class="wrapperMenu">
        <img src="/img/<?= $dm['gambar_menu'] ?>" alt="" width="200" height="200">
        <h5><?= $dm['nama_menu']  ?></h5>
        <p>harga:<?= $dm['harga']?></p>
        <p>total harga:<?= $dm['total_harga'] ?></p>

        <p>Jumlah: <i class="fas fa-plus button-plus" data-id="<?= $dm['id'] ?>"></i><?= $dm['jumlah'] ?><i
                class="fas fa-minus button-minus" data-id="<?= $dm['id'] ?>"></i>
        </p>
        <i class="fas fa-trash-alt hapusMenuKeranjang" data-id="<?= $dm['id'] ?>"></i>

    </div>

    </h5>
</div>

<?php }?>

<h5 class="mt-3 ml-2 ">Total Pembayaran :<span id="total_pembayaran"><?= $total_pembayaran[0]['total_harga'] ?></span>



    <script type="text/javascript">
    function dataKeranjang() {
        $.ajax({
            url: "/kasir/dataKeranjangCard",
            dataType: "json",
            success: function(response) {
                console.log(response.data);
                $(".v-dataKeranjang").html(response.data);
            },
        });
    }
    $('.button-plus').on('click', function() {

        let id_menu = $(this).attr('data-id')


        $.ajax({
            type: "post",
            url: '/kasir/tambahJumlah',
            data: {
                id_menu: id_menu
            },
            dataType: "json",
            success: function(response) {
                if (response.error) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Warning',
                        text: response.error
                    });
                } else {

                    dataKeranjang();
                }


            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);

            }
        });
    })

    $('.button-minus').on('click', function() {

        let id_menu = $(this).attr('data-id')


        $.ajax({
            type: "post",
            url: '/kasir/kurangJumlah',
            data: {
                id_menu: id_menu
            },
            dataType: "json",
            success: function(response) {

                if (response.error) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Warning',
                        text: response.error
                    });
                } else {
                    dataKeranjang();
                }

            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);

            }
        });
    })



    // modal location

    $('.hapusMenuKeranjang').on('click', function() {


        let id = $(this).attr('data-id');

        Swal.fire({
            title: 'Yakin Hapus Menu?',
            text: "Kamu Tidak Bisa Mengembalikannya Lagi!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya,Hapus'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "post",
                    url: '/kasir/hapusMenuKeranjang',
                    data: {
                        id: id
                    },
                    dataType: "json",
                    success: function(response) {

                        if (response.success) {
                            Swal.fire(
                                'Deleted!',
                                'deleted.',
                                'success'
                            )
                            dataKeranjang();
                            setTimeout(function() {
                                window.location.href = "/kasir/keranjang/"
                            }, 1000);


                        }


                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);

                    }
                });

            }
        })

    })
    </script>