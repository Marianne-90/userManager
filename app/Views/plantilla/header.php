<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php

            use App\Controllers\User;

            echo esc($title) ?></title>
    <link href="css/estilo.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="d-flex flex-column h-100">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href=<?php echo base_url("/"); ?>>User Manager</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <?php
                $session = session();
                $userSession = new User;
                if ($userSession->validator()) { ?>
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href=<?php echo base_url('usuarios/' . $session->user_id . '/edit'); ?>>Editar Mi Perfil</a>
                        </li>

                        <?php
                        if ($userSession->admin()) {
                        ?>
                            <li class="nav-item">
                                <a class="nav-link" href=<?php echo base_url('/usuarios'); ?>>Lista de Usuarios</a>
                            </li>
                        <?php } ?>
                        <li class="nav-item">
                            <a class="nav-link"  href=<?php echo base_url('image/' . $session->user_id ); ?>>Mis Imagenes</a>
                        </li>
                    </ul>
                    <form action=<?php echo base_url('user/logout'); ?> class="d-flex" role="search">
                        <button class="btn btn-outline-danger" type="submit">LogOut</button>
                    </form>
                <?php }; ?>
            </div>
        </div>
    </nav>
    <main class="flex-shrink-0">
        <div class="container">