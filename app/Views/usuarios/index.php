<?php
$session = session();
?>



<div class="p-4">
    <h1 class="bd-title mb-0" id="content">Listado de Usuarios</h1>
    <?php if ($session->getFlashdata('mensaje')) { ?>
        <div class="alert alert-success" role="alert">
            <?php echo $session->getFlashdata('mensaje'); ?>
        </div>
    <?php }; ?>
    <?php if ($session->getFlashdata('error')) { ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $session->getFlashdata('error'); ?>
        </div>
    <?php }; ?>


    <a href=<?php echo base_url('usuarios/new'); ?> class="btn btn-info btn-lg">Crear Nuevo</a>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Nombre</th>
                <th scope="col">Login</th>
                <th scope="col">Contraseña</th>
                <th scope="col">Admin</th>
                <th scope="col">Acciones</th>
                <th scope="col">Galería</th>
            </tr>
        </thead>
        <tbody>
            <?php

            foreach ($users as $user) {
            ?>
                <tr>
                    <td><?php echo $user['user_name']; ?></td>
                    <td><?php echo $user['user_login']; ?></td>
                    <td><?php echo $user['user_password']; ?></td>
                    <td><?php echo $user['user_admin'] ? "SI" : "No"; ?></td>
                    <td>
                        <a href=<?php echo base_url('usuarios/' . $user['user_id'] . '/edit'); ?> class="btn btn-primary btn-sm me-2">Editar</a>
                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#eliminaModal" data-bs-url="<?php echo base_url('usuarios/' . $user['user_id']); ?>">Eliminar</button>
                    </td>
                    <td><a href=<?php echo base_url('image/' . $user['user_id'] ); ?> class="btn btn-success btn-sm">Ir a galería de <?php echo $user['user_name'];?></a></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <div class="modal fade" id="eliminaModal" tabindex="-1" aria-labelledby="eliminaModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="eliminaModalLabel">Aviso</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>¿Desea eliminar este usuario?</p>
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

</div>