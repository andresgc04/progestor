<div class="modal fade" id="newUserGovernmentClientFormModal">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Registrarse Como Cliente Gubernamental</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="newUserGovernmentClientForm" name="newUserGovernmentClientForm" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <p class="text-bold">Datos Básicos:</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="nombreEmpresaClienteEmpresaGubernamental">Nombre De La Empresa:</label>
                                <input type="text" id="nombreEmpresaClienteEmpresaGubernamental" name="nombreEmpresaClienteEmpresaGubernamental" class="form-control" placeholder="Ingrese el nombre de la empresa.">
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="rncClienteEmpresaGubernamental">RNC De La Empresa:</label>
                                <input type="text" id="rncClienteEmpresaGubernamental" name="rncClienteEmpresaGubernamental" class="form-control" placeholder="Ingrese el rnc de la empresa.">
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="tipoClienteIDClienteEmpresaGubernamental">Tipo De Cliente:</label>
                                <select id="tipoClienteIDClienteEmpresaGubernamental" name="tipoClienteIDClienteEmpresaGubernamental" class="form-control select2" style="width: 100%;"></select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="sectorClienteEmpresaGubernamental">Sector Empresarial:</label>
                                <input type="text" id="sectorClienteEmpresaGubernamental" name="sectorClienteEmpresaGubernamental" class="form-control" placeholder="Ingrese el sector al que pertenece la empresa.">
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="presupuestoAnualClienteEmpresaGubernamental">Presupuesto Anual:</label>
                                <input type="text" id="presupuestoAnualClienteEmpresaGubernamental" name="presupuestoAnualClienteEmpresaGubernamental" class="form-control" placeholder="Ingrese el presupuesto anual destinado.">
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
                                <label for="nombreContactoClienteEmpresaGubernamental">Nombre Del Contacto:</label>
                                <input type="text" id="nombreContactoClienteEmpresaGubernamental" name="nombreContactoClienteEmpresaGubernamental" class="form-control" placeholder="Ingrese el nombre del contacto." />
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="cargoContactoClienteEmpresaGubernamental">Cargo Del Contacto:</label>
                                <input type="text" id="cargoContactoClienteEmpresaGubernamental" name="cargoContactoClienteEmpresaGubernamental" class="form-control" placeholder="Ingrese el nombre del cargo del contacto.">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="telefonoClienteEmpresaGubernamental">Télefono:</label>
                                <input type="text" id="telefonoClienteEmpresaGubernamental" name="telefonoClienteEmpresaGubernamental" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="correoElectronicoClienteEmpresaGubernamental">Correo Electr&oacute;nico:</label>
                                <input type="text" id="correoElectronicoClienteEmpresaGubernamental" name="correoElectronicoClienteEmpresaGubernamental" class="form-control" placeholder="Ingrese el correo electronico.">
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
                                <label for="paisIDClienteEmpresaGubernamental">Pa&iacute;s:</label>
                                <select id="paisIDClienteEmpresaGubernamental" name="paisIDClienteEmpresaGubernamental" class="form-control select2" style="width: 100%;"></select>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="provinciaIDClienteEmpresaGubernamental">Provincia:</label>
                                <select id="provinciaIDClienteEmpresaGubernamental" name="provinciaIDClienteEmpresaGubernamental" class="form-control select2" style="width: 100%;"></select>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="ciudadIDClienteEmpresaGubernamental">Ciudad:</label>
                                <select id="ciudadIDClienteEmpresaGubernamental" name="ciudadIDClienteEmpresaGubernamental" class="form-control select2" style="width: 100%;"></select>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="direccionClienteEmpresaGubernamental">Direcci&oacute;n:</label>
                                <input type="text" id="direccionClienteEmpresaGubernamental" name="direccionClienteEmpresaGubernamental" class="form-control">
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
                                <label for="nuevoNombreUsuarioClienteEmpresaGubernamental">Nombre De Usuario:</label>
                                <input type="text" id="nuevoNombreUsuarioClienteEmpresaGubernamental" name="nuevoNombreUsuarioClienteEmpresaGubernamental" class="form-control" placeholder="Ingrese el nombre de usuario.">
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="nuevoPasswordClienteEmpresaGubernamental">Password:</label>
                                <input type="password" id="nuevoPasswordClienteEmpresaGubernamental" name="nuevoPasswordClienteEmpresaGubernamental" class="form-control" placeholder="Ingrese el password.">
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="confirmarNuevoPasswordClienteEmpresaGubernamental">Confirmar Password:</label>
                                <input type="password" id="confirmarNuevoPasswordClienteEmpresaGubernamental" name="confirmarNuevoPasswordClienteEmpresaGubernamental" class="form-control" placeholder="Ingrese la confirmación del password.">
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