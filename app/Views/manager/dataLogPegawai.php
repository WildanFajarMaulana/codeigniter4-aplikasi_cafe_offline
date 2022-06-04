<?= $this->extend('template/template_manager') ?>

<?= $this->section('content') ?>

<!-- <h3 class="text-center">Data User</h3> -->

<div class="col">
    <section class="table">
        <div class="judul ">
            <h4>Log Pegawai</h4>
        </div>
        <div class="tableBox">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Pegawai</th>
                        <th scope="col">Deskripsi</th>
                        <th scope="col">Role</th>
                    </tr>
                </thead>
                <tbody class="v-dataLog">


                </tbody>
            </table>
        </div>

    </section>

</div>
</div>














<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary btnTambah mb-3" data-toggle="modal" data-target="#modalUser">
        Tambah User
    </button> -->

<!-- Modal -->

</div>

</div>

<?= $this->endSection() ?>