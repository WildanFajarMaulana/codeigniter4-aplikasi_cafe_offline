<?php if($dataMeja){ ?>
<?php $no=1;foreach($dataMeja as $dm){?>
<tr>
    <th scope="row"><?= $no++ ?></th>
    <td><?= $dm['kode_meja'] ?></td>
    <td><?= $dm['status'] ?></td>
    <td><button class="btn btn-warning btnEdit mr-3 mb-3" data-toggle="modal" data-target="#modalMeja"
            data-id="<?= $dm['id']?>">Edit</button><button class="btn btn-danger btnHapus"
            data-id="<?= $dm['id']?>">Hapus</button></td>
</tr>
<?php } ?>
<?php }else{?>
<p class="text-center">Data Meja Kosong</p>
<?php }?>

<script>
function dataMeja() {
    $.ajax({
        url: "/manager/dataMeja",
        dataType: "json",
        success: function(response) {
            $(".v-dataMeja").html(response.data);
        },
    });
}
$(".btnEdit").on("click", function() {
    const id = $(this).attr('data-id');

    $.ajax({
        type: "get",
        url: "/manager/dataMejaByid",
        data: {
            id: id
        },
        dataType: "json",
        success: function(response) {
            $('.modal-title').html('Edit Meja');
            $('#id').val(response.data.id);
            $('#kode_meja').val(response.data.kode_meja);


            if (response.data.status == 0) {
                $('#status').val('0').attr("selected", "selected");
            } else if (response.data.status == 1) {
                $('#status').val('1').attr("selected", "selected");
            } else {

            }


        },
    });
});
$('.btnHapus').on('click', function() {
    const id = $(this).attr('data-id');

    Swal.fire({
        title: 'Yakin Hapus Meja?',
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
                url: "/manager/hapusMeja",
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
                        dataMeja();
                    }


                },
            });
        }
    })


})
</script>