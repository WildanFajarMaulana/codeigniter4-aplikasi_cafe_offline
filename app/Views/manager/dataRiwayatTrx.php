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
        <div class="judul">
            <h4>Riwayat Tranksaksi</h4>
        </div>
        <div class="tableBox">
            <label for="">Filter</label>
            <select name="" id="" class="form-control filter mb-3">
                <option value="" disabled selected>Pilih</option>
                <option value="nama_pegawai">By Nama Pegawai</option>
                <option value="tanggal">By Tanggal Tertentu</option>
                <option value="hariBulanan">By Harian/Bulanan</option>
            </select>
            <div class="namaPegawaiBox d-none">

                <label for="">Pilih</label>
                <select class="filterNama form-control" id="">
                    <option value="" selected disabled>Cari Nama Pegawai</option>
                    <?php foreach($nama_pegawai as $nm){?>
                    <option value="<?= $nm['id_login'] ?>"><?= $nm['nama'] ?></option>
                    <?php }?>
                </select>

                <br>
            </div>
            <div class="tanggalBox d-none">

                <label for="">Tanggal</label>
                <input type="date" class="form-control tanggal_awal">
                <label for="">Sampai</label>
                <input type="date" class="form-control tanggal_akhir">
                <button type="submit" class="btn btn-primary mt-2 mb-2 cariByTanggal">Cari</button>

            </div>
            <div class="hariBulanBox d-none mb-3">

                <label for="">Pilih</label>
                <select name="" id="" class="form-control filterTotalPembayaran">
                    <option value="" selected disabled>Pilih</option>
                    <option value="harian">Harian</option>
                    <option value="bulanan">Bulanan</option>
                </select>

            </div>
            <h4 class="h4-pendapatan-harian d-none">Pendapatan Harian : <span class="span-pendapatan-harian"></span>
            </h4>
            <h4 class="h4-pendapatan-bulanan d-none">Pendapatan Bulanan : <span class="span-pendapatan-bulanan"></span>
            </h4>


            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Pegawai</th>
                        <th scope="col">Nama Pembeli</th>
                        <th scope="col">Total Pembayaran</th>
                        <th scope="col">Kode Meja</th>
                        <th scope="col">Status</th>
                        <th scope="col">Tanggal</th>


                    </tr>
                </thead>
                <tbody class="v-dataTrx">


                </tbody>
            </table>
        </div>

    </section>

</div>
</div>



</div>

<?= $this->endSection() ?>