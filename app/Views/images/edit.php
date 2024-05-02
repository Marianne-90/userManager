<h3 class="my-3">Actualizar Imagen</h3>
<?php
if (session()->getFlashdata('error') !== null) { ?>
    <div class="alert alert-danger">
        <?= session()->getFlashdata('error'); ?>
    </div>
<?php }; ?>

<form action=<?php echo base_url("image/" . $user['user_id'] . '/' . $image['image_id']); ?> class="row g-3" method="post" autocomplete="off">

    <input type="hidden" name="image_id" value="<?php echo $image['image_id']; ?>">
    <input type="hidden" name="_method" value="PUT">
    <div class="col-xl-2 col-lg-2 col-md-6 mb-4">
        <div class="bg-white rounded shadow-sm">
            <img src=<?php echo base_url('images/' . $user['user_login'] . '/' . $image['image_dir']); ?> alt=<?php echo $image['image_name']; ?> class="img-fluid card-img-top">
        </div>
    </div>
    <div class="col-md-8">
        <label for="image_name" class="form-label">Título</label>
        <p><code>titulo de la imagen</code></p>
        <input type="text" class="form-control" id="image_name" name="image_name" value="<?php echo set_value('image_name', $image['image_name']); ?>" required autofocus>
    </div>

    <div>
        <button type="submit" class="btn btn-primary col-6">Actualizar</button>
    </div>
    <div>
        <a href=<?php echo base_url("image/" . $user['user_id']); ?> class="btn btn-secondary col-3">Regresar</a>
    </div>
</form>