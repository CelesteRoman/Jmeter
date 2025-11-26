<?php
include __DIR__ . "/conecta.php";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Usuarios</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container py-4">

    <!-- TITULO Y BOTÓN -->
    <div class="d-flex flex-wrap justify-content-between gap-3 mb-3">
        <h3 class="m-0">Usuarios</h3>

        <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalCrearUsuario">
            <i class="bx bx-plus"></i> Nuevo Usuario
        </a>
    </div>

    <!-- BUSCADOR -->
    <div class="search-bar mb-3">
        <input type="search" id="search" class="form-control" placeholder="Buscar usuario...">
    </div>

    <!-- TABLA -->
    <div class="card">
        <div class="card-body">

            <div class="table-responsive table-centered">
                <table class="table text-nowrap mb-0 table-bordered table-striped">
                    <thead class="bg-light">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>A. Paterno</th>
                            <th>A. Materno</th>
                            <th>Correo</th>
                            <th>Nickname</th>
                            <th>Rol</th>
                            <th>Género</th>
                            <th>Cargo</th>
                            <th>Unidad Adm.</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                    <?php foreach ($usuarios as $u): ?>
                        <tr>
                            <td><?= $u['id'] ?></td>
                            <td><?= $u['nombre'] ?></td>
                            <td><?= $u['apellido_paterno'] ?></td>
                            <td><?= $u['apellido_materno'] ?></td>
                            <td><?= $u['correo'] ?></td>
                            <td><?= $u['nickname'] ?></td>
                            <td><?= $u['rol'] ?></td>
                            <td><?= $u['genero'] ?></td>
                            <td><?= $u['cargo'] ?></td>
                            <td><?= $u['unidad_administrativa'] ?></td>
                            <td>
                                <a href="editar.php?id=<?= $u['id'] ?>" class="btn btn-sm btn-secondary">Editar</a>
                                <a href="eliminar.php?id=<?= $u['id'] ?>" class="btn btn-sm btn-danger"
                                   onclick="return confirm('¿Eliminar este usuario?')">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>

                </table>
            </div>

        </div>
    </div>

</div>

<!-- ====================================
   MODAL CREAR USUARIO
==================================== -->
<div class="modal fade" id="modalCrearUsuario" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <form method="POST" action="">
                <div class="modal-body">

                    <div class="row g-3">

                        <div class="col-md-6">
                            <label class="form-label">Nombre</label>
                            <input type="text" name="nombre" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Apellido Paterno</label>
                            <input type="text" name="apellido_paterno" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Apellido Materno</label>
                            <input type="text" name="apellido_materno" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Correo</label>
                            <input type="email" name="correo" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Nickname</label>
                            <input type="text" name="nickname" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Rol</label>
                            <select name="id_rol" class="form-select" required>
                                <option selected disabled>Selecciona un rol</option>
                                <?php foreach ($roles as $r): ?>
                                    <option value="<?= $r['id'] ?>"><?= $r['descripcion'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Género</label>
                            <select name="id_genero" class="form-select" required>
                                <option selected disabled>Selecciona un género</option>
                                <?php foreach ($generos as $g): ?>
                                    <option value="<?= $g['id'] ?>"><?= $g['descripcion'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Cargo</label>
                            <select name="id_cargo" class="form-select" required>
                                <option selected disabled>Selecciona un cargo</option>
                                <?php foreach ($cargos as $c): ?>
                                    <option value="<?= $c['id'] ?>"><?= $c['nombre'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-md-12">
                            <label class="form-label">Unidad Administrativa</label>
                            <select name="id_unidad_administrativa" class="form-select" required>
                                <option selected disabled>Selecciona una unidad administrativa</option>
                                <?php foreach ($unidades as $u): ?>
                                    <option value="<?= $u['id'] ?>"><?= $u['nombre'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                    </div><!-- row -->

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar Usuario</button>
                </div>

            </form>

        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
