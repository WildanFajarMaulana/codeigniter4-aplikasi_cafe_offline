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

<div class="col">
    <?php if($keranjang){?>
    <h4 class="h4-list">Keranjang</h4>

    <div class="tableBox">
        <h4>List Menu Keranjang</h4>
        <div class="row v-dataKeranjang">






        </div>
        <label for="">Nama Pembeli</label>
        <input type="text" class="form-control" id="nama_pembeli">
        <label for="">Kode Meja</label>
        <select id="kode_meja" class="form-control">
            <option value="" disabled selected>Pilih Meja</option>
            <?php foreach($meja as $m){?>
            <?php if($m['status']==0){?>
            <option value="<?= $m['kode_meja']?>"><?= $m['kode_meja']?></option>
            <?php }else{?>
            <option value="<?= $m['kode_meja']?>" disabled><?= $m['kode_meja']?></option>
            <?php }?>
            <?php }?>
        </select>
        <label for="">Bayar</label>
        <input type="text" class="form-control mt-2" id="bayar_tranksaksi">
        <button class="btn btn-primary mt-3 bayarTranksaksi">Bayar</button>

    </div>
    <?php }else{?>
    <p class="text-center mt-5">Keranjang Kosong</p>
    <?php }?>
</div>
</div>
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



<?= $this->endSection() ?>