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


<div class="col">
    <section class="table">
        <div class="judul ">
            <h4>List Meja</h4>
        </div>
        <div class="tableBox">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary btnTambah mb-3" data-toggle="modal" data-target="#modalMeja">
                Tambah Meja
            </button>


            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Kode Meja</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody class="v-dataMeja">


                </tbody>
            </table>
        </div>

    </section>

</div>
</div>



<!-- Modal -->
<div class="modal fade" id="modalMeja" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Meja</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/manager/meja" method="post" class="mejaForm">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="formGroupExampleInput">Kode Meja</label>
                        <input type="hidden" name="id" id="id">
                        <input type="text" name="kode_meja" id="kode_meja" class="form-control"
                            id="formGroupExampleInput" placeholder="Masukkan kode_meja">
                        <p style="color:red" id="kode_mejaNotif" class="d-none"></p>
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Status</label>
                        <select class="form-control" id="status" id="exampleFormControlSelect1" name="status">

                            <option value="1">Aktif</option>
                            <option value="0" selected>Tidak Aktif</option>
                        </select>
                        <p style="color:red" id="statusNotif" class="d-none"></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btnMeja">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

</div>

<?= $this->endSection() ?>