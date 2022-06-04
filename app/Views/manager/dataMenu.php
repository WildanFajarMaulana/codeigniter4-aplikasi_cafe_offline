<?= $this->extend('template/template_manager') ?>

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
<!-- <h3 class="text-center">Data Menu</h3> -->


<div class="col">
    <section class="table">
        <div class="judul ">
            <h4>List Menu</h4>
        </div>
        <div class="tableBox">
            <button type="button" class="btn btn-primary btnTambah mb-3" data-toggle="modal" data-target="#modalMenu">
                Tambah Menu
            </button>


            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Menu</th>
                        <th scope="col">Gambar Menu</th>
                        <th scope="col">Stok</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Kategori</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody class="v-dataMenu">


                </tbody>
            </table>
        </div>

    </section>

</div>
</div>









<div class="modal fade" id="modalMenu" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/manager/menu" method="post" class="menuForm" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="formGroupExampleInput">Nama Menu</label>
                        <input type="hidden" name="id" id="id">
                        <input type="text" name="nama_menu" id="nama_menu" class="form-control"
                            id="formGroupExampleInput" placeholder="Masukkan nama_menu">
                        <p style="color:red" id="nama_menuNotif" class="d-none"></p>
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput">Gambar Menu</label><br>
                        <input type="hidden" name="gambar_lama" id="gambar_lama">
                        <input type="file" id="gambar_menu" name="gambar_menu" id="formGroupExampleInput"
                            placeholder="Masukkan gambar_menu">
                        <p style="color:red" id="gambar_menuNotif" class="d-none"></p>
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput">Stok</label>
                        <input type="text" id="stok" name="stok" class="form-control" id="formGroupExampleInput"
                            placeholder="Masukkan stok">
                        <p style="color:red" id="stokNotif" class="d-none"></p>
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput">harga</label>
                        <input type="text" id="harga" name="harga" class="form-control" id="formGroupExampleInput"
                            placeholder="Masukkan harga">
                        <p style="color:red" id="hargaNotif" class="d-none"></p>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Kategori</label>
                        <select class="form-control" id="kategori" id="exampleFormControlSelect1" name="kategori">
                            <option value="" selected disabled>Pilih Kategori</option>
                            <option value="makanan">Makanan</option>
                            <option value="minuman">Minuman</option>
                        </select>
                        <p style="color:red" id="kategoriNotif" class="d-none">nama wajib diisi</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btnMenu">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

</div>

<?= $this->endSection() ?>