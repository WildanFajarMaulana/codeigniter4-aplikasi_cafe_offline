<?php if($dataMenu){ ?>
<?php $no=1;foreach($dataMenu as $dm){?>
<tr>
    <th scope="row"><?= $no++ ?></th>
    <td><?= $dm['nama_menu'] ?></td>
    <td><img src="/img/<?= $dm['gambar_menu'] ?>" width="200"> </td>
    <td><?= $dm['stok'] ?></td>
    <td><?= $dm['harga'] ?></td>
    <td><?= $dm['kategori'] ?></td>
    <td><button class="btn btn-warning btnEdit mr-3 mb-3" data-toggle="modal" data-target="#modalMenu"
            data-id="<?= $dm['id']?>">Edit</button><button class="btn btn-danger btnHapus"
            data-id="<?= $dm['id']?>">Hapus</button></td>
</tr>
<?php } ?>
<?php }else{?>
<p class="text-center">Data User Kosong</p>
<?php }?>

<script>
function dataMenu() {
    $.ajax({
        url: "/manager/dataMenu",
        dataType: "json",
        success: function(response) {
            $(".v-dataMenu").html(response.data);
        },
    });
}
$(".btnEdit").on("click", function() {
    const id = $(this).attr('data-id');

    $.ajax({
        type: "get",
        url: "/manager/dataMenuByid",
        data: {
            id: id
        },
        dataType: "json",
        success: function(response) {
            $('.modal-title').html('Edit User');
            $('#id').val(response.data.id);
            $('#nama_menu').val(response.data.nama_menu);
            $('#gambar_lama').val(response.data.gambar_menu);
            $('#stok').val(response.data.stok);
            $('#harga').val(response.data.harga);

            if (response.data.kategori == 'makanan') {
                $('#kategori').val('makanan').attr("selected", "selected");
            } else if (response.data.kategori == 'minuman') {
                $('#kategori').val('minuman').attr("selected", "selected");
            } else {

            }


        },
    });
});
$('.btnHapus').on('click', function() {
    const id = $(this).attr('data-id');

    Swal.fire({
        title: 'Yakin Hapus Menu?',
        text: "Kamu Tidak Bisa Mengembalikannya Lagi!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya,Hapus'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "post",
                url: "/manager/hapusMenu",
                data: {
                    id: id
                },
                dataType: "json",
                success: function(response) {
                    if (response.success) {
                        swal.fire({
                            icon: "success",
                            title: "Berhasil",
                            text: response.success,
                        });
                        dataMenu();
                    }


                },
            });
        }
    })


})
</script>