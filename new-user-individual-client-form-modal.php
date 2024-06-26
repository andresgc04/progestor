<div class="modal fade" id="newUserIndividualClientFormModal">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Registrarse</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="newUserIndividualClientForm" name="newUserIndividualClientForm" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <p class="text-bold">Datos Básicos:</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="nombreClienteClienteIndividual">Nombres Del Cliente:</label>
                                <input type="text" id="nombreClienteClienteIndividual" name="nombreClienteClienteIndividual" class="form-control" placeholder="Ingrese el nombre del cliente.">
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="apellidoClienteClienteIndividual">Apellidos Del Cliente:</label>
                                <input type="text" id="apellidoClienteClienteIndividual" name="apellidoClienteClienteIndividual" class="form-control" placeholder="Ingrese los apellidos del cliente.">
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="sexoIDClienteIndividual">Sexo:</label>
                                <select id="sexoIDClienteIndividual" name="sexoIDClienteIndividual" class="form-control select2" style="width: 100%;"></select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="cedulaClienteIndividual">Cedula:</label>
                                <input type="text" id="cedulaClienteIndividual" name="cedulaClienteIndividual" class="form-control" data-inputmask='"mask": "999-9999999-9"' data-mask>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="fechaNacimientoClienteIndividual">Fecha De Nacimiento:</label>
                                <div class="input-group date" data-target-input="nearest">
                                    <input id="fechaNacimientoClienteIndividual" name="fechaNacimientoClienteIndividual" type="text" class="form-control datetimepicker-input" data-target="#fechaNacimientoClienteIndividual" />
                                    <div class="input-group-append" data-target="#fechaNacimientoClienteIndividual" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="nacionalidadIDClienteIndividual">Nacionalidad:</label>
                                <select id="nacionalidadIDClienteIndividual" name="nacionalidadIDClienteIndividual" class="form-control select2" style="width: 100%;"></select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <p class="text-bold">Datos De Contactos:</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="telefonoClienteIndividual">Télefono:</label>
                                <input type="text" id="telefonoClienteIndividual" name="telefonoClienteIndividual" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="correoElectronicoClienteIndividual">Correo Electr&oacute;nico:</label>
                                <input type="text" id="correoElectronicoClienteIndividual" name="correoElectronicoClienteIndividual" class="form-control" placeholder="Ingrese el correo electronico.">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <p class="text-bold">Datos De Dirección:</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-3 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="paisIDClienteIndividual">Pa&iacute;s:</label>
                                <select id="paisIDClienteIndividual" name="paisIDClienteIndividual" class="form-control select2" style="width: 100%;"></select>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="provinciaIDClienteIndividual">Provincia:</label>
                                <select id="provinciaIDClienteIndividual" name="provinciaIDClienteIndividual" class="form-control select2" style="width: 100%;"></select>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="ciudadIDClienteIndividual">Ciudad:</label>
                                <select id="ciudadIDClienteIndividual" name="ciudadIDClienteIndividual" class="form-control select2" style="width: 100%;"></select>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="direccionClienteIndividual">Direcci&oacute;n:</label>
                                <input type="text" id="direccionClienteIndividual" name="direccionClienteIndividual" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <p class="text-bold">Datos Del Usuario:</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="nuevoNombreUsuarioClienteIndividual">Nombre De Usuario:</label>
                                <input type="text" id="nuevoNombreUsuarioClienteIndividual" name="nuevoNombreUsuarioClienteIndividual" class="form-control" placeholder="Ingrese el nombre de usuario.">
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="nuevoPasswordClienteIndividual">Password:</label>
                                <input type="password" id="nuevoPasswordClienteIndividual" name="nuevoPasswordClienteIndividual" class="form-control" placeholder="Ingrese el password.">
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="confirmarNuevoPasswordClienteIndividual">Confirmar Password:</label>
                                <input type="password" id="confirmarNuevoPasswordClienteIndividual" name="confirmarNuevoPasswordClienteIndividual" class="form-control" placeholder="Ingrese la confirmación del password.">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="mr-2">Cancelar</span><span><i class="fas fa-times-circle"></i></span></button>
                    <button type="submit" class="btn btn-primary"><span class="mr-2">Guardar</span><span><i class="fas fa-save"></i></span></button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->