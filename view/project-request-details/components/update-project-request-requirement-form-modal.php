<div class="modal fade" id="updateProjectRequestRequirementFormModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Modificar Requerimiento</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="updateProjectRequestRequirementForm" name="updateProjectRequestRequirementForm" method="POST">
                <div class="modal-body">
                    <input type="hidden" id="modificarSolicitudProyectoID" name="modificarSolicitudProyectoID" class="form-control" />
                    <input type="hidden" id="modificarRequerimientoSolicitudProyectoID" name="modificarRequerimientoSolicitudProyectoID" class="form-control" />
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="modificarDescripcionRequerimiento">Descripción De Requerimiento:</label>
                                <input type="text" id="modificarDescripcionRequerimiento" name="modificarDescripcionRequerimiento" class="form-control" placeholder="Ingrese la descripción del requerimiento.">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="mr-2">Cancelar</span><span><i class="fas fa-times-circle"></i></span></button>
                    <button type="button" onclick="validateAddNewProjectRequestRequirement()" class="btn btn-primary"><span class="mr-2">Guardar</span><span><i class="fas fa-save"></i></span></button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->