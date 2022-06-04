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
    <section class="table">
        <div class="judul ">
            <h4>List Tranksaksi</h4>
        </div>
        <div class="tableBox">



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
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody class="v-dataTranksaksi">


                </tbody>
            </table>
        </div>

    </section>

</div>
</div>



<!-- Modal -->
<div class="modal fade" id="modalMenu" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> Menu Pesanan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body body-pesanan">


            </div>

            </form>
        </div>
    </div>
</div>

</div>

<?= $this->endSection() ?>