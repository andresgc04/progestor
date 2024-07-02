<div class="modal fade" id="newUserBusinessClientFormModal">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Registrarse Como Cliente Empresarial</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="newUserBusinessClientForm" name="newUserBusinessClientForm" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <p class="text-bold">Datos Básicos:</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="nombreEmpresaClienteEmpresa">Nombre De La Empresa:</label>
                                <input type="text" id="nombreEmpresaClienteEmpresa" name="nombreEmpresaClienteEmpresa" class="form-control" placeholder="Ingrese el nombre de la empresa.">
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="rncClienteEmpresa">RNC De La Empresa:</label>
                                <input type="text" id="rncClienteEmpresa" name="rncClienteEmpresa" class="form-control" placeholder="Ingrese el rnc de la empresa.">
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="tipoClienteIDClienteEmpresa">Tipo De Cliente:</label>
                                <select id="tipoClienteIDClienteEmpresa" name="tipoClienteIDClienteEmpresa" class="form-control select2" style="width: 100%;"></select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="sectorClienteEmpresa">Sector Empresarial:</label>
                                <input type="text" id="sectorClienteEmpresa" name="sectorClienteEmpresa" class="form-control" placeholder="Ingrese el sector al que pertenece la empresa.">
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="numeroEmpleadosClienteEmpresa">Cantidad De Empleados:</label>
                                <input type="text" id="numeroEmpleadosClienteEmpresa" name="numeroEmpleadosClienteEmpresa" class="form-control" placeholder="Ingrese la cantidad de empleados.">
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
                                <label for="nombreContactoClienteEmpresa">Nombre Del Contacto:</label>
                                <input type="text" id="nombreContactoClienteEmpresa" name="nombreContactoClienteEmpresa" class="form-control"  placeholder="Ingrese el nombre del contacto."/>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="cargoContactoClienteEmpresa">Cargo Del Contacto:</label>
                                <input type="text" id="cargoContactoClienteEmpresa" name="cargoContactoClienteEmpresa" class="form-control" placeholder="Ingrese el nombre del cargo del contacto.">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="telefonoClienteEmpresa">Télefono:</label>
                                <input type="text" id="telefonoClienteEmpresa" name="telefonoClienteEmpresa" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="correoElectronicoClienteEmpresa">Correo Electr&oacute;nico:</label>
                                <input type="text" id="correoElectronicoClienteEmpresa" name="correoElectronicoClienteEmpresa" class="form-control" placeholder="Ingrese el correo electronico.">
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
                                <label for="paisIDClienteEmpresa">Pa&iacute;s:</label>
                                <select id="paisIDClienteEmpresa" name="paisIDClienteEmpresa" class="form-control select2" style="width: 100%;"></select>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="provinciaIDClienteEmpresa">Provincia:</label>
                                <select id="provinciaIDClienteEmpresa" name="provinciaIDClienteEmpresa" class="form-control select2" style="width: 100%;"></select>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="ciudadIDClienteEmpresa">Ciudad:</label>
                                <select id="ciudadIDClienteEmpresa" name="ciudadIDClienteEmpresa" class="form-control select2" style="width: 100%;"></select>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="direccionClienteEmpresa">Direcci&oacute;n:</label>
                                <input type="text" id="direccionClienteEmpresa" name="direccionClienteEmpresa" class="form-control">
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
                                <label for="nuevoNombreUsuarioClienteEmpresa">Nombre De Usuario:</label>
                                <input type="text" id="nuevoNombreUsuarioClienteEmpresa" name="nuevoNombreUsuarioClienteEmpresa" class="form-control" placeholder="Ingrese el nombre de usuario.">
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="nuevoPasswordClienteEmpresa">Password:</label>
                                <input type="password" id="nuevoPasswordClienteEmpresa" name="nuevoPasswordClienteEmpresa" class="form-control" placeholder="Ingrese el password.">
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="confirmarNuevoPasswordClienteEmpresa">Confirmar Password:</label>
                                <input type="password" id="confirmarNuevoPasswordClienteEmpresa" name="confirmarNuevoPasswordClienteEmpresa" class="form-control" placeholder="Ingrese la confirmación del password.">
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