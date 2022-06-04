<?= $this->extend('template/template_kasir') ?>

<?= $this->section('content') ?>
<style>
select:required:invalid {
    color: gray;
}

option[value=""][disabled] {
    display: none;
}

option {
    color: black;
}
</style>
<?php $request = \Config\Services::request();?>
<?php $id_tranksaksi_link=$request->uri->getSegment(3) ?>
<div class="col">
    <p class="d-none id_trx_tambah_card"><?= $id_tranksaksi_link ?></p>

    <h4 class="h4-list">Tambah Pesanan</h4>

    <div class="tableBox">

        <button type="button" class="btn btn-primary btnTambah mb-3" data-toggle="modal" data-target="#modalMenu">
            Pilih Menu
        </button>
        <?php if($dataTambahKeranjangTranksaksi){?>
        <input type="hidden" name="id_tranksaksi" class="id_trx_tambah" value="<?= $id_tranksaksi?>">
        <div class="row menuTambah">

        </div>

        <button class="btn btn-warning btnTambahPesanan">Lanjut Tambah</button>
        <?php } ?>
    </div>

</div>
</div>
</div>




<!-- Modal -->
<div class="modal fade" id="modalMenu" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Pesanan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">

                <label>Nama Menu</label>
                <form action="/kasir/prosesTambahPesananTrx" class="formKeranjang">
                    <input type="hidden" name="id_tranksaksi" value="<?= $id_tranksaksi?>">
                    <select name="id_menu" id="">
                        <option value="" selected disabled>Pilih</option>
                        <?php foreach($dataMenu as $dm){?>
                        <option value="<?= $dm['id']?>">
                            <?= $dm['nama_menu']?>(harga:<?= $dm['harga']?>)(stok:<?= $dm['stok']?>)
                        </option>
                        <?php }?>
                    </select>
                    <br>
                    <label for="">Jumlah</label><br>
                    <input type="text" name="jumlah">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary btnMenu">tambah</button>
            </div>
            </form>

        </div>
    </div>
</div>



<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
$('.btnTambahPesanan').on('click', function() {
    let id_tranksaksi = $('.id_trx_tambah').val()
    let total_pembayaran = $('#total_pembayaran').html();
    let bayar_tranksaksi = $("#bayar_tranksaksi").val();
    $.ajax({
        type: "post",
        url: '/kasir/bayarTambahPesanan',
        data: {
            id_tranksaksi: id_tranksaksi,
            total_pembayaran: total_pembayaran,
            bayar_tranksaksi: bayar_tranksaksi
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
                    window.location.href = "/kasir/tambahPesanan/" + id_tranksaksi;
                }, 1000);
            }

        },
        error: function(xhr, ajaxOptions, thrownError) {

        }
    });
})
</script>
<?= $this->endSection() ?>