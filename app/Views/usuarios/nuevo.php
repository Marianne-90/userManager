



<h3 class="my-3">Crear Nuevo Usuario</h3>
<?php 
if (session()->getFlashdata('error') !== null) {?>
<div class="alert alert-danger">
    <?= session()->getFlashdata('error');?>
</div>
<?php }; ?>

<form action=<?php echo base_url('usuarios'); ?> class="row g-3" method="post" autocomplete="off">

    <div class="col-md-6">
        <label for="user_name" 
        class="form-label">Nombre</label>
        <p><code>Ingresa el nombre</code></p>
        <input
         type="text" 
         class="form-control" 
         id="user_name" 
         name="user_name" 
         value="<?php echo set_value('user_name');?>"
         required autofocus>
    </div>

    <div class="col-md-6">
        <label for="user_login" 
        class="form-label">Login</label>
        <p><code>Ingresa el usuario, debe ser único</code></p>
        <input 
        type="text" 
        class="form-control" 
        id="user_login" 
        name="user_login" 
        value="<?php echo set_value('user_login');?>"
        required>
    </div>

    <div class="col-md-4">
        <label for="user_password" 
        class="form-label">Clave</label>
        <p><code>Ingresa la contraseña entre 5 y 10 caracteres </code></p>
        <input 
        type="text" 
        class="form-control" 
        id="user_password" 
        name="user_password" 
        value="<?php echo set_value('user_password');?>"
        required>
    </div>
    <div class="col-md-4">
        <label for="user_admin" class="form-label">Administrador</label>
        <p><code>¿El usuario dentrá permisos de administrador?</code></p>
        <select class="form-select" 
        id="user_admin" 
        name="user_admin" 
        value="<?php echo set_value('user_admin');?>"
        required>
            <option value="">Seleccionar</option>
            <option value="1">Sí</option>
            <option value="0">No</option>
        </select>
    </div>

    <div class="col-12">
        <a href=<?php echo base_url("usuarios"); ?> class="btn btn-secondary">Regresar</a>

        <button type="submit" class="btn btn-primary">Crear</button>
    </div>



</form>