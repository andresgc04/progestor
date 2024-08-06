<div class="modal fade" id="newUserClientFormModal">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Registrarse</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="newUserClientForm" name="newUserClientForm" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <p class="text-bold">Datos Básicos:</p>
                        </div>
                    </div>
                    <div class="row">
                        <div id="tipoClienteSection" class="col-xl-4 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="tipoClienteID">Tipo De Cliente:</label>
                                <select id="tipoClienteID" name="tipoClienteID" class="form-control select2" style="width: 100%;"></select>
                            </div>
                        </div>
                        <div id="nombreClienteSection" class="col-xl-4 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="nombreCliente">Nombre Del Cliente:</label>
                                <input type="text" id="nombreCliente" name="nombreCliente" class="form-control" placeholder="Ingrese el nombre del cliente.">
                            </div>
                        </div>
                        <div id="sexoSection" class="col-xl-4 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="sexoID">Sexo:</label>
                                <select id="sexoID" name="sexoID" class="form-control select2" style="width: 100%;"></select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div id="tipoDocumentoSection" class="col-xl-4 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="tipoDocumentoID">Tipo De Documento De Identidad:</label>
                                <select id="tipoDocumentoID" name="tipoDocumentoID" class="form-control select2" style="width: 100%;"></select>
                            </div>
                        </div>
                        <div id="documentoIdentidadSection" class="col-xl-4 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="documentoIdentidad">Documento De Identidad:</label>
                                <input type="text" id="documentoIdentidad" name="documentoIdentidad" class="form-control">
                            </div>
                        </div>
                        <div id="nacionalidadSection" class="col-xl-4 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="nacionalidadID">Nacionalidad:</label>
                                <select id="nacionalidadID" name="nacionalidadID" class="form-control select2" style="width: 100%;"></select>
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
                                <label for="telefono">Télefono:</label>
                                <input type="text" id="telefono" name="telefono" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="correoElectronico">Correo Electr&oacute;nico:</label>
                                <input type="text" id="correoElectronico" name="correoElectronico" class="form-control" placeholder="Ingrese el correo electronico.">
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
                                <label for="paisID">Pa&iacute;s:</label>
                                <select id="paisID" name="paisID" class="form-control select2" style="width: 100%;"></select>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="provinciaID">Provincia:</label>
                                <select id="provinciaID" name="provinciaID" class="form-control select2" style="width: 100%;"></select>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="ciudadID">Ciudad:</label>
                                <select id="ciudadID" name="ciudadID" class="form-control select2" style="width: 100%;"></select>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="direccion">Direcci&oacute;n:</label>
                                <input type="text" id="direccion" name="direccion" class="form-control">
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
                                <label for="nuevoNombreUsuario">Nombre De Usuario:</label>
                                <input type="text" id="nuevoNombreUsuario" name="nuevoNombreUsuario" class="form-control" placeholder="Ingrese el nombre de usuario.">
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="nuevoPassword">Password:</label>
                                <input type="password" id="nuevoPassword" name="nuevoPassword" class="form-control" placeholder="Ingrese el password.">
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="confirmarNuevoPassword">Confirmar Password:</label>
                                <input type="password" id="confirmarNuevoPassword" name="confirmarNuevoPassword" class="form-control" placeholder="Ingrese la confirmación del password.">
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