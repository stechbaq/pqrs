<?php
    session_start();

    if (!$_SESSION['ID']) {
		header("Location: ../");
    }

    include('../API/services/pqrs/list.php');
    include('../API/services/account/users.php');
    
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>PQRS App</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">	
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="../css/style_owner.css">
    <style type="text/css">
        .sending {
			display: none;
		}

		.success {
			display: none;
		}
	</style>
</head>
<body>
	
    <ul class="nav justify-content-end bg-main pt-3 pb-3">
        <li class="nav-item">
            <span class="nav-link"><b><?php session_start(); echo $_SESSION['FULLNAME']; ?></b></span>
        </li>
        <li class="nav-item">
            <button id="btnLogout" class="nav-link mr-1 btn btn-danger btn-sm">Salir</button>
        </li>
    </ul>

    <?php if ($_SESSION['ROLE'] == 'ADMIN') { ?>
    <div class="m-3">
        <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#pqrFormModal">Nuevo PQR</button>
    </div>
    <?php } ?>

    <!-- Modal PQR Save -->
    <div class="modal fade" id="pqrFormModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Formulario PQR</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form id="pqrSaveForm" class="customized-form" action="" method="POST">
                        <div class="form-group">
                            <span class="text-secondary font-weight-bold">Tipo:</span>
                            <select id="pqr_type" class="form-control form-control-sm" required>
                                <option value="">--Seleccione una opción--</option>
                                <option value="PETICION">Petición</option>
                                <option value="QUEJA">Queja</option>
                                <option value="RECLAMO">Reclamo</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <span class="text-secondary font-weight-bold">Asunto:</span>
                            <input type="text" class="form-control form-control-sm" placeholder="Escriba un asunto..." id="issue" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                            <span class="text-secondary font-weight-bold">Usuario:</span>
                            <select id="pqr_user" class="form-control form-control-sm" required>
                                <option value="">--Seleccione un usuario--</option>
                                <?php 
                                    if (count($users) > 0) {
                                        foreach($users as $u) {
                                ?>
                                    <option value="<?php echo $u['id']; ?>"><?php echo $u['username']; ?></option>
                                <?php 
                                        }
                                    } 
                                ?>
                            </select>
                        </div>
                        

                        <div class="alert alert-primary sending" role="alert">
                            <i class="fa fa-spinner girar" style="font-size: 120%"></i> Enviando información...
                        </div>

                        <div class="alert alert-success success" role="alert">
                            <i class="fa fa-check" style="font-size: 120%"></i> Los datos fueron guardados con éxito.
                        </div>

                        <div class="pt-3 text-right actions-block">
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
                            <input type="submit" value="Guardar cambios" class="btn btn-primary btn-sm" />
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- Modal PQR Edit -->
    <div class="modal fade" id="pqrEditModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar PQR</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form id="pqrEditForm" class="customized-form" action="" method="POST">
                        <div class="form-group">
                            <span class="text-secondary font-weight-bold">Estado actual:</span>
                            <div id="pqr_current_status"></div>
                        </div>
                        <div class="form-group">
                            <span class="text-secondary font-weight-bold">Nuevo estado:</span>
                            <select id="pqr_new_status" class="form-control form-control-sm" required></select>
                        </div>

                        <input type="hidden" id="pqr_id">

                        <div class="alert alert-primary sending" role="alert">
                            <i class="fa fa-spinner girar" style="font-size: 120%"></i> Enviando información...
                        </div>

                        <div class="alert alert-success success" role="alert">
                            <i class="fa fa-check" style="font-size: 120%"></i> Los datos fueron guardados con éxito.
                        </div>

                        <div class="pt-3 text-right actions-block">
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
                            <input type="submit" value="Guardar cambios" class="btn btn-primary btn-sm" />
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- Modal PQR Edit -->
    <div class="modal fade" id="pqrDeleteModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger">Eliminar PQR</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form id="pqrDeleteForm" class="customized-form" action="" method="POST">
                                    
                        <div class="form-group">
                            <span class="text-danger font-weight-bold">¿Está seguro que quiere eliminar este PQR?</span>
                        </div>

                        <input type="hidden" id="pqr_id">

                        <div class="alert alert-primary sending" role="alert">
                            <i class="fa fa-spinner girar" style="font-size: 120%"></i> Enviando información...
                        </div>

                        <div class="alert alert-success success" role="alert">
                            <i class="fa fa-check" style="font-size: 120%"></i> El PQR fue eliminado.
                        </div>

                        <div class="pt-3 text-right actions-block">
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
                            <input type="submit" value="Eliminar" class="btn btn-danger btn-sm" />
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

    <div class="mt-3 ml-3 mr-3">
        <table class="table table-bordered table-hover" style="font-size: 80%;">
            <thead class="thead-light">
                <tr>
                    <th scope="col" class="text-left">Tipo</th>
                    <th scope="col" class="text-left">Asunto</th>
                    <th scope="col" class="text-left">Usuario</th>
                    <th scope="col" class="text-center">Estado</th>
                    <th scope="col" class="text-center">Fecha Creación</th>
                    <th scope="col" class="text-center">Fecha Límite</th>
                    <?php if ($_SESSION['ROLE'] == 'ADMIN') { ?>
                        <th scope="col" class="text-center">Acciones</th>
                    <?php } ?>
                </tr>
            </thead>
            <?php if (count($pqrs) > 0) { ?>
            <tbody>
                <?php foreach($pqrs as $pqr) { ?>
                <tr class="text-center">
                    <td class="text-left"><?php echo $pqr['type']; ?></td>
                    <td class="text-left"><?php echo $pqr['issue']; ?></td>
                    <td class="text-left"><?php echo $pqr['username']; ?></td>
                    <td>
                        <?php if ($pqr['status'] == 'NEW') { ?>
                            <span class="badge badge-success">Nuevo</span>
                        <?php } elseif ($pqr['status'] == 'EXECUTION') { ?>
                            <span class="badge badge-warning">En ejecución</span>
                        <?php } elseif ($pqr['status'] == 'CLOSED') { ?>
                            <span class="badge badge-danger">Cerrado</span>
                        <?php } ?>
                    </td>
                    <td class="text-center"><?php echo $pqr['createdAt']; ?></td>
                    <td class="text-center"><?php echo $pqr['limitDate']; ?></td>
                    <?php if ($_SESSION['ROLE'] == 'ADMIN') { ?>
                    <td class="text-center">
                        <?php 
                            if ($pqr['status'] !== 'CLOSED') { ?>
                            <a class="mr-2" title="Editar PQR" data-toggle="modal" data-target="#pqrEditModal" data-id="<?php echo $pqr['id']; ?>" data-status="<?php echo $pqr['status']; ?>"><i class="fa fa-pencil" style="font-size: 125%; color: #F58609; cursor: pointer;" aria-hidden="true"></i></a>
                            <a title="Eliminar PQR" data-toggle="modal" data-target="#pqrDeleteModal" data-id="<?php echo $pqr['id']; ?>"><i class="fa fa-trash" style="font-size: 125%; color: red; cursor: pointer;" aria-hidden="true"></i></a>
                        <?php } ?>
                    </td>
                    <?php } ?>
                </tr>
                <?php } ?>
            </tbody>
            <?php } ?>
        </table>
    </div>

	<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="../js/principal.js"></script>
    <script src="../js/logout.js"></script>
</body>
</html>