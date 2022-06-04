<?php if($dataLog){ ?>
<?php $no=1;foreach($dataLog as $ds){?>
<tr>
    <th scope="row"><?= $no++ ?></th>
    <td><?= $ds['nama'] ?></td>
    <td><?= $ds['deskripsi'] ?></td>
    <td><?= $ds['role'] ?></td>

</tr>
<?php } ?>
<?php }else{?>
<p class="text-center">Data Log Kosong</p>
<?php }?>