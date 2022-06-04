<?php foreach($dataMenu as $dm){ ?>
<div class="col mb-3">
    <div class="card" style="width: 200px; min-height:200px">
        <img src="/img/<?= $dm['gambar_menu'] ?>" class="card-img-top" alt="..." width="200" height="200">
        <div class="card-body">
            <h5 class="card-title"><?= $dm['nama_menu'] ?></h5>
            <p class="card-text"><?= $dm['harga'] ?></p>
            <a href="#" class="btn btn-primary btn-showMenu" data-toggle="modal" data-target="#modalMenu"
                data-id="<?= $dm['id'] ?>">Tambahkan Menu</a>
        </div>
    </div>
</div>
<?php }?>


<script>
$('.btn-showMenu').on('click', function() {
    const id = $(this).attr('data-id');
    console.log(id)

    $.ajax({
        type: "get",
        url: "/kasir/getMenuByid",
        data: {
            id: id
        },
        dataType: "json",
        success: function(response) {
            console.log(response.data)

            $('.nama_menu_modal').html(response.data.nama_menu);
            $('.gambar_menu_modal').attr('src', `/img/${response.data.gambar_menu}`);
            $('.stok_menu_modal').html(response.data.stok);
            $('#id_menu').val(response.data.id);
            // $('#id').val(response.data.id);
            // $('#nama').val(response.data.nama);
            // $('#username').val(response.data.username);

            // if (response.data.role == 'kasir') {
            //     $('#role').val('kasir').attr("selected", "selected");
            // } else if (response.data.role == 'manager') {
            //     $('#role').val('manager').attr("selected", "selected");
            // } else {

            // }


        },
    });
})
</script>