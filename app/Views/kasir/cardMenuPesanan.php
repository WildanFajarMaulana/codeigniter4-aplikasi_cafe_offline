<?php foreach($dataMenuPesanan as $dm){ ?>
<div class="col mb-3">
    <div class="card" style="width: 200px;">
        <img src="/img/<?= $dm['gambar_menu'] ?>" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title"><?= $dm['nama_menu'] ?></h5>
            <p class="card-text">harga:<?= $dm['harga'] ?></p>
            <p class="card-text">jumlah:<?= $dm['jumlah'] ?>x</p>
            <p class="card-text">total harga:<?= $dm['total_harga'] ?></p>
        </div>
    </div>
</div>
<?php }?>