<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Pacientes</title>
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
</head>
<body>    
	<div class="container">
            <div class="col-sm-12">
                <button id='crePaciente'type="button" class="btn btn-primary" data-toggle="modal" data-target="#crearPaciente">Crear paciente</button>
            </div>
            <div class="col-sm-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nombres</th>
                            <th>Apellidos</th>
                            <th>Direccion</th>
                            <th>Celular</th>
                            <th>Telefono</th>
                            <th>Municipio</th>
                            <th>Eps</th>
                            <th>Accion</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $pacientes = DataTable::getInstance()->getAllPacientes();
                        foreach($pacientes as $paciente){?>                        
                        <tr>
                            <td><?= $paciente['Nombre']?></td>
                            <td><?= $paciente['Apellidos']?></td>
                            <td><?= $paciente['Direccion']?></td>
                            <td><?= $paciente['Celular']?></td>
                            <td><?= $paciente['Telefono']?></td>
                            <td><?= $paciente['Municipio']?></td>
                            <td><?= $paciente['Eps']?></td>                                                                     
                            <td><a class='editPaciente' href='' data-id='<?= $paciente['id']?>' data-toggle="modal" data-target="#crearPaciente" >Editar</a></td>                                                                     
                            <td><a class='deletePaciente' href='' data-id='<?= $paciente['id']?>' data-toggle="modal" data-target="#modalDeletePaciente">Eliminar</a></td>                                                                     
                        </tr> 
                        <?php } ?>
                    </tbody>
                </table>
            </div>           
        </div>
        <div id="crearPaciente" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Crear paciente</h4>
                    </div>
                     <form id='createPaciente'>
                    <div class="modal-body">                       
                            <div class="form-group">                             
                                <input type="text" class="form-control" id="Nombre" placeholder="Nombre" name="nombre">
                            </div>
                            <div class="form-group">                             
                                <input type="text" class="form-control" id="Apellido" placeholder="Apellido" name="apellido">
                            </div>
                            <div class="form-group">                             
                                <input type="text" class="form-control" id="Direccion" placeholder="Direccion" name="direccion">
                            </div>
                            <div class="form-group col-sm-6 row pull-left">                             
                                <input type="text" class="form-control" id="Telefono" placeholder="Telefono" name="telefono">
                            </div>
                            <div class="form-group col-sm-6 row pull-right">                             
                                <input type="text" class="form-control" id="Celular" placeholder="Celular" name="celular">
                            </div>
                            
                            <div class="form-group col-sm-6 row pull-left">   
                                <SELECT NAME="departamento" class="form-control pull-left" id='departamentos'> 
                                    <OPTION VALUE="">--Seleccionar Departamento--</OPTION>                                  
                                </SELECT>                                
                            </div>
                            <div class="form-group col-sm-6 pull-right row" >   
                                <SELECT NAME="municipio" class="form-control" disabled id='municipios'> 
                                    <OPTION VALUE="">--Seleccionar Municipio--</OPTION>                             
                                </SELECT>                                
                            </div>      
                            <div class="form-group">   
                                <SELECT NAME="eps" id="eps" class="form-control"> 
                                    <OPTION VALUE="">--Seleccionar Eps--</OPTION>                                   
                                </SELECT>                                
                            </div>
                        <input type="text" class="form-control hidden" id="id-paciente" name="id">
                    </div>
                    <div class="modal-footer">
                        <div class="alert alert-success col-sm-6 text-center" id="alertPaciente" style="display:none;">El paciente ha sido guardado.</div>
                            <button type="submit" class="btn btn-primary">Guardar</button>                        
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <div id="modalDeletePaciente" class="modal fade" role="dialog" data-id=''>
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Eliminar Paciente</h4>
                    </div>
                    <div class="modal-body">
                        <p>Esta seguro de eliminar este paciente?</p>
                    </div>
                    <div class="modal-footer">
                        <div class="alert alert-danger col-sm-6 text-center" id="alertDelPaciente" style="display:none;">El paciente ha sido Eliminado.</div>
                        <button type="button" class="btn btn-danger" id='delPaciente' >Eliminar</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
</body>
</html>