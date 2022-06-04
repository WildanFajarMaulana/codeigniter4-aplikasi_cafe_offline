<?php if($dataTrx){ ?>
<?php $no=1;foreach($dataTrx as $dm){?>
<tr>
    <th scope="row"><?= $no++ ?></th>
    <td><?= $dm['nama'] ?></td>
    <td><?= $dm['nama_pembeli'] ?></td>
    <td><?= $dm['total_pembayaran'] ?></td>
    <td><?= $dm['kode_meja'] ?></td>
    <td><?= $dm['status'] ?></td>
    <td><?= $dm['tanggal_tertentu'] ?></td>

</tr>
<?php } ?>
<?php }else{?>
<p class="text-center">Data Trx Kosong</p>
<?php }?>