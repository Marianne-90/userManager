<h3 class="my-3">Añadir nueva imagen</h3>
<?php
if (session()->getFlashdata('error') !== null) { ?>
    <div class="alert alert-danger">
        <?= session()->getFlashdata('error'); ?>
    </div>
<?php }; ?>

<form action=<?php echo base_url("image/" . $id); ?> class="row g-3" method="post" autocomplete="off" enctype="multipart/form-data">

    <div class="col-md-8">
        <label for="image_name" class="form-label">Título</label>
        <p><code>titulo de la imagen</code></p>
        <input type="text" class="form-control" id="image_name" name="image_name" value="<?php echo set_value('image_name'); ?>" required autofocus>
    </div>

    <div class="col-md-6">
        <label for="image_file" class="form-label">Selecciona una imagen</label>
        <input class="form-control" type="file" name="image_file" id="image_file" accept="image/jpeg, image/png">
    </div>
    <div>
        <button type="submit" class="btn btn-primary col-6">Crear</button>
    </div>
    <div>
        <a href=<?php echo base_url("image/" . $id); ?> class="btn btn-secondary col-3">Regresar</a>
    </div>
</form>