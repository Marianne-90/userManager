<?php

use App\Controllers\User;

$session = session();
$userSession = new User; 

?>

<div class="p-4">
    <h1 class="bd-title mb-0" id="content">Es bueno verte de vuelta <?php echo $session->user_name; ?></h1>
    <h2 class="bd-title mb-6" id="content">Selecciona lo que quieras hacer</h2>
    <hr>
    <br>
    <?php




    if ($userSession->admin()) {
    ?>
        <a href=<?php echo base_url('usuarios'); ?> class="btn btn-info btn-md">IR A LISTA DE USUARIOS</a>
    <?php } ?>

    <a href=<?php echo base_url('usuarios/2/edit'); ?> class="btn btn-primary btn-md">IR EDITAR MI PERFIL</a>
    <a href=<?php echo base_url('image/' . $session->user_id ); ?> class="btn btn-warning btn-md">IR GALERÍA DE IMAGENES</a>

</div>