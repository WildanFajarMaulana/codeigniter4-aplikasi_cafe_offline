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
<h3 class="text-center">Tranksaksi</h3>

<div class="container">
    <h2>Type</h2>
    <h3><span class="newTrx">New Trx</span> || <span class="tambahMenu">Tambah Menu</span></h3>
    <div class="wrapperNewTrx">
        <label for="">nama pembeli</label>
        <input type="text">
        <br>
        <label for="">total pembayaran</label>
        <input type="text">
        <br>
        <label for="">Kode Meja</label>
        <select name="meja" id="meja">
            <option value="" disabled selected>Pilih Meja</option>
            <?php foreach($meja as $m) {?>
            <?php if($m['status']==1){ ?>
            <option value="<?= $m['kode_meja'] ?>" disabled><?= $m['kode_meja'] ?></option>
            <?php }else{?>
            <option value="<?= $m['kode_meja'] ?>"><?= $m['kode_meja'] ?></option>
            <?php }?>

            <?php }?>
        </select>
    </div>
    <div class="wrapperAddMenu d-none">
        <label for="">Kode Meja</label>
        <input type="text">
        <br>

    </div>




    <!-- Modal -->
    <div class="modal fade" id="modalMenu" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Menu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <h4 class="nama_menu_modal">Nama Menu</h4>
                    <img src="" alt="" class="gambar_menu_modal" width="200">
                    <p>Stok :<span class="stok_menu_modal"></span></p>
                    <label>Jumlah</label>
                    <form action="/kasir/tambahKeranjang" class="formKeranjang">
                        <input type="hidden" name="id" id="id_menu">
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
    <div class="row v-dataMenu">


    </div>
</div>

<?= $this->endSection() ?>