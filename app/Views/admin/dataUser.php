<?= $this->extend('template/template_admin') ?>

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
<!-- <h3 class="text-center">Data User</h3> -->

<div class="container">
    <div class="row">
        <div class="col">
            <section class="sidebar">
                <div class="judulSidebar">
                    <h4>Selamat Datang </h4>
                </div>
                <div class="linkSidebar">
                    <a href="/admin" class="linkChildren">Data User</a>
                    <br><br>
                    <a href="/admin/logPegawai" class="linkChildren">Log Pegawai</a>
                    <br><br>
                    <a class="linkChildren logout">Logout</a>
                </div>
            </section>
        </div>
        <div class="col">
            <section class="table">
                <div class="judul ">
                    <h4>Data User</h4>
                </div>
                <div class="tableBox">

                    <button type="button" class="btn btn-primary btnTambah mb-3" data-toggle="modal"
                        data-target="#modalUser">
                        Tambah User
                    </button>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Username</th>
                                <th scope="col">Password</th>
                                <th scope="col">Role</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody class="v-dataUser">


                        </tbody>
                    </table>
                </div>

            </section>

        </div>
    </div>
















    <!-- Modal -->
    <div class="modal fade" id="modalUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/admin/user" method="post" class="userForm">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="formGroupExampleInput">Nama</label>
                            <input type="hidden" name="id" id="id">
                            <input type="text" name="nama" id="nama" class="form-control" id="formGroupExampleInput"
                                placeholder="Masukkan Nama">
                            <p style="color:red" id="namaNotif" class="d-none"></p>
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput">Username</label>
                            <input type="text" id="username" name="username" class="form-control"
                                id="formGroupExampleInput" placeholder="Masukkan Username">
                            <p style="color:red" id="usernameNotif" class="d-none"></p>
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput">Password</label>
                            <input type="password" id="password" name="password" class="form-control"
                                id="formGroupExampleInput" placeholder="Masukkan Password">
                            <p style="color:red" id="passwordNotif" class="d-none"></p>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Role</label>
                            <select class="form-control" id="role" id="exampleFormControlSelect1" name="role">
                                <option value="" selected disabled>Pilih Role</option>
                                <option value="kasir">Kasir</option>
                                <option value="manager">Manager</option>
                            </select>
                            <p style="color:red" id="roleNotif" class="d-none">nama wajib diisi</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btnUser">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

<?= $this->endSection() ?>