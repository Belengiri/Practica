<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <style>
        .clientes {
                width: 300px; 
                margin: 0 auto; 
                padding: 5px;
        }
        .form-control {
                font-size: 14px; 
                padding: 5px;
        }
        .btn {
                width: 100%; 
        }
        .table-custom {
                width: 800px; 
                margin: 0 auto;
                padding: 10px;
        }
        .table td, .table th {
                padding: 5px; 
        }
        .navbar{
            background-color: #a8e6cf;
            padding: 5px;
        }
    </style>
    <title>Clientes</title>
</head>
<body>
    <nav class="navbar bg-body-tertiary">
        <div class="container-fluid">
            <h1 class="navbar-brand text-primary">Clientes</h1>
            <form class="d-flex" >
                <a class="btn btn-secondary"  href="<?php echo site_url("clientes/salir"); ?>">Salir</a>
            </form>
        </div>
    </nav>

    <form class="clientes my-4" method="POST" action="<?php echo site_url("clientes/guardar");?>">
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" require>
        </div>
        <div class="mb-3">
            <label for="apellido" class="form-label">Apellido</label>
            <input type="text" class="form-control" id="apellido" name="apellido" require>
        </div>
        <div class="mb-3">
            <label for="telefono" class="form-label">Telefono</label>
            <input type="text" class="form-control" id="telefono" name="telefono" require>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" require>
        </div>
        <button type="submit" class="btn btn-success">Guardar</button>
    </form>

    <table class="table table-sm table-custom">
        <thead class="table-success table-striped">
            <tr>
            <th scope="col">Nombre</th>
            <th scope="col">Apellido</th>
            <th scope="col">Telefono</th>
            <th scope="col">Email</th>
            <th scope="col">Acciones</th> 
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($clientes)) { ?>
                <?php foreach ($clientes as $cliente) { ?>
                    <tr>
                        <td><?php echo $cliente['nombre']; ?></td>
                        <td><?php echo $cliente['apellido']; ?></td>
                        <td><?php echo $cliente['telefono']; ?></td>
                        <td><?php echo $cliente['email']; ?></td>
                        <td>
                            <a href="<?php echo site_url('clientes/eliminar/' . $cliente['id_cliente']); ?>" onclick="return confirm('¿Estás seguro de eliminar este cliente?');">
                                <i class="bi bi-trash-fill text-danger"></i>
                            </a>
                            <br>
                            <a href="<?php echo site_url('clientes/modificar/' . $cliente['id_cliente']); ?>" onclick="return confirm('¿Estás seguro de modificar este cliente?');">
                                <i class="bi bi-pencil-fill text-warning"></i>
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            <?php }else { ?>
                <tr>
                    <td colspan="4" class="text-center">No hay datos disponibles</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</body>
</html>