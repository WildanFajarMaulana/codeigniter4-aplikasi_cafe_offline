<?php foreach($dataKeranjangTambah as $dm){ ?>
<div class="col mt-3 mb-3">
    <div class="wrapperMenu">
        <img src="/img/<?= $dm['gambar_menu'] ?>" alt="" width="200" height="200">
        <h5><?= $dm['nama_menu']  ?></h5>
        <p>Harga:<?= $dm['harga']?></p>
        <p>Total:<?= $dm['total_harga_tambah'] ?></p>
        <p>Jumlah: <i class="fas fa-plus button-plus"
                data-id="<?= $dm['id_tambah'] ?>"></i><?= $dm['jumlah_tambah'] ?><i class="fas fa-minus button-minus"
                data-id="<?= $dm['id_tambah'] ?>"></i>
        </p>
        <i class="fas fa-trash-alt hapusMenuKeranjang" data-id="<?= $dm['id_tambah'] ?>"></i>

    </div>

</div>
<?php }?>
<h5 class="mt-3 ml-2 ">Total Pembayaran :<span
        id="total_pembayaran"><?= $total_pembayaran[0]['total_harga_tambah'] ?></span>
    <p class="id_tranksaksi_card d-none"><?= $id_tranksaksi ?></p><br>
    <label for="">Bayar</label>
    <input type="text" class="form-control mt-2" id="bayar_tranksaksi">

    <script type="text/javascript">
    // function dataKeranjangTambah() {
    //     let id_trx = $(".id_tranksaksi_card").val();
    //     $.ajax({
    //         type: "get",
    //         url: "/kasir/dataKeranjangTrxTambah",
    //         data: {
    //             id_trx: id_trx,
    //         },
    //         dataType: "json",
    //         success: function(response) {
    //             $(".menuTambah").html(response.data);
    //         },
    //     });
    // }
    $('.button-plus').on('click', function() {

        let id = $(this).attr('data-id')
        let id_tranksaksi = $('.id_tranksaksi_card').html();



        $.ajax({
            type: "post",
            url: '/kasir/tambahJumlahTrx',
            data: {
                id: id
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
                    dataKeranjangTambah();
                }




            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    })

    $('.button-minus').on('click', function() {

        let id = $(this).attr('data-id')
        let id_tranksaksi = $('.id_tranksaksi_card').html();


        $.ajax({
            type: "post",
            url: '/kasir/kurangJumlahTrx',
            data: {
                id: id
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
                    dataKeranjangTambah();
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
        let id_tranksaksi = $('.id_tranksaksi_card').html();
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
                    url: '/kasir/hapusMenuKeranjangTambah',
                    data: {
                        id: id,

                    },
                    dataType: "json",
                    success: function(response) {

                        if (response.success) {
                            Swal.fire(
                                'Deleted!',
                                'deleted.',
                                'success'
                            )
                            dataKeranjangTambah();
                            setTimeout(function() {
                                window.location.href = "/kasir/tambahPesanan/" +
                                    id_tranksaksi;
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