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

    <h4 class="h4-list">Tambah Pesanan</h4>

    <div class="tableBox">


        <label for="">Kode Meja</label>
        <input type="text" class="form-control" id="kode_meja">

        <button class="btn btn-primary mt-3 btnCariMeja">Cari</button>

    </div>

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