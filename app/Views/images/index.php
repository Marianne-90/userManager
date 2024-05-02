<?php
$session = session();
?>

<div class="container-fluid">
    <div class="px-lg-5">

        <!-- For demo purpose -->
        <div class="pt-5 row">
            <div class="col-lg-12 mx-auto" style="background-color: #a770ef;">
                <div class="text-white p-3 shadow-sm rounded banner">
                    <h1 class="display-4">Galería de imágenes de <?php echo $user['user_name']; ?></h1>
                    <p class="lead">Añade edita o elimina imágenes.</p>
                </div>
            </div>
        </div>
        <?php if ($session->getFlashdata('mensaje')) { ?>
            <div class="alert alert-success" role="alert">
                <?php echo $session->getFlashdata('mensaje'); ?>
            </div>
        <?php }; ?>
        <?php if ($session->getFlashdata('delete')) { ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $session->getFlashdata('delete'); ?>
            </div>
        <?php }; ?>
        <div class="pb-5 text-right"><a href=<?php echo base_url('image/new/' . $user['user_id']); ?> class="btn btn-dark px-5 py-3 text-uppercase">Añadir Nueva</a></div>
        <!-- End -->

        <div class="row">
            <?php
            foreach ($images as $img) {
            ?>

                <!-- Gallery item -->
                <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                    <div class="bg-white rounded shadow-sm"><img src=<?php echo base_url('images/' . $user['user_login'] . '/' . $img['image_dir']); ?> alt="" class="img-fluid card-img-top">

                        <div class="p-4">
                            <h5 class="text-dark"><?php echo $img['image_name']; ?></h5>
                            <div class="d-flex align-items-center justify-content-between rounded-pill bg-light px-3 py-2 mt-4">

                                <a href=<?php echo base_url('image/' . $user['user_id'] . '/' . $img['image_id']); ?> class="btn btn-info btn-sm me-2" >Ver</a>
                                <a href=<?php echo base_url('image/edit/' . $user['user_id'].'/' . $img['image_id']); ?> class="btn btn-primary btn-sm me-2">Editar</a>
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#eliminaModal" data-bs-url="<?php echo base_url('image/' . $user['user_id'] . '/' . $img['image_id']); ?>">Eliminar</button>

                                <div class="badge badge-danger px-3 rounded-pill font-weight-normal">New</div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End -->

            <?php } ?>
        </div>

        <div class="modal fade" id="eliminaModal" tabindex="-1" aria-labelledby="eliminaModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="eliminaModalLabel">Aviso</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>¿Desea eliminar esta imagen?</p>
                    </div>
                    <div class="modal-footer">
                        <form id="form-elimina" action="" method="post">
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>