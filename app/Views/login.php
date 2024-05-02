<main class="form-signin w-100 m-auto">
    <form action=<?php echo base_url('/user/login'); ?> method="post">
        <h1 class="h3 mb-3 fw-normal">Iniciar Sesión</h1>
        <?php
        if (session()->getFlashdata('error') !== null) { ?>
            <div class="alert alert-danger">
                <?= session()->getFlashdata('error'); ?>
            </div>

        <?php }; ?>
        <div class="form-floating">
            <input type="username" class="form-control" id="user_name" placeholder="user_name" name="user_name">
            <label for="floatingInput">Nombre de usuario</label>
        </div>
        <div class="form-floating">
            <input type="password" class="form-control" id="user_password" name="user_password" placeholder="contraseña">
            <label for="floatingPassword" placeholder="password">Contraseña</label>
        </div>

        <div class=" text-start my-3">
            <code>Si no tienes una cuenta favor de contactar a tu administrador</code>
        </div>
        <button class="btn btn-primary w-100 py-2" type="submit">Entrar</button>
    </form>
</main>