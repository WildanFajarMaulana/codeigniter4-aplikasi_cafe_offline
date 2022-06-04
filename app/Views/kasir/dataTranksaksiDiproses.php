<?php if($dataTranksaksiDiprosesp){ ?>
<?php $no=1;foreach($dataTranksaksiDiprosesp as $dm){?>
<tr>
    <th scope="row"><?= $no++ ?></th>
    <td><?= $dm['nama'] ?></td>
    <td><?= $dm['nama_pembeli'] ?></td>
    <td><?= $dm['total_pembayaran'] ?></td>
    <td><?= $dm['kode_meja'] ?></td>
    <td><?= $dm['status'] ?></td>
    <td><?= $dm['tanggal_tertentu'] ?></td>
    <td><button class="btn btn-primary perbaruiTranksaksi" data-id="<?= $dm['id'] ?>">Tandai Selesai</button>
        <button class="btn btn-warning buttonMenuPesanan mt-3" data-id="<?= $dm['id'] ?>" data-toggle="modal"
            data-target="#modalMenu">
            Menu Pesanan</button>
    </td>


</tr>
<?php } ?>
<?php }else{?>
<p class="text-center">Data Trx Kosong</p>
<?php }?>

<script>
$(".buttonMenuPesanan").on("click", function() {
    const id_tranksaksi = $(this).attr("data-id");
    $.ajax({
        type: 'post',
        url: "/kasir/dataMenuPesanan",
        dataType: "json",
        data: {
            id_tranksaksi: id_tranksaksi
        },
        success: function(response) {

            $(".body-pesanan").html(response.data);
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        },
    });
    console.log(id_tranksaksi);
});
$('.perbaruiTranksaksi').on('click', function() {

    let id = $(this).attr('data-id')




    $.ajax({
        type: "post",
        url: '/kasir/updateTranksaksiDiproses',
        data: {
            id: id
        },
        dataType: "json",
        success: function(response) {
            if (response.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: response.success
                });
                setTimeout(function() {
                    window.location.href = "/kasir/viewTranksaksi/";
                }, 1000);
            }




        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
})
</script>