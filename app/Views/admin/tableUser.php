<?php if($dataUser){ ?>
<?php $no=1;foreach($dataUser as $ds){?>
<tr>
    <th scope="row"><?= $no++ ?></th>
    <td><?= $ds['nama'] ?></td>
    <td><?= $ds['username'] ?></td>
    <td>*****</td>
    <td><?= $ds['role'] ?></td>
    <td><button class="btn btn-warning btnEdit mr-3 mb-3" data-toggle="modal" data-target="#modalUser"
            data-id="<?= $ds['id_login']?>">Edit</button><button class="btn btn-danger btnHapus"
            data-id="<?= $ds['id_login']?>">Hapus</button></td>
</tr>
<?php } ?>
<?php }else{?>
<p class="text-center">Data User Kosong</p>
<?php }?>

<script>
function dataUser() {
    $.ajax({
        url: "/admin/dataUser",
        dataType: "json",
        success: function(response) {
            $(".v-dataUser").html(response.data);
        },
    });
}
$(".btnEdit").on("click", function() {
    const id = $(this).attr('data-id');

    $.ajax({
        type: "get",
        url: "/admin/dataUserByid",
        data: {
            id: id
        },
        dataType: "json",
        success: function(response) {
            $('.modal-title').html('Edit User');
            $('#id').val(response.data.id_login);
            $('#nama').val(response.data.nama);
            $('#username').val(response.data.username);

            if (response.data.role == 'kasir') {
                $('#role').val('kasir').attr("selected", "selected");
            } else if (response.data.role == 'manager') {
                $('#role').val('manager').attr("selected", "selected");
            } else {

            }


        },
    });
});
$('.btnHapus').on('click', function() {
    const id = $(this).attr('data-id');
    Swal.fire({
        title: 'Yakin Hapus User?',
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
                url: "/admin/hapusUser",
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
                        dataUser();
                    }


                },
            });
        }
    })


})
</script>