<div class="modal fade" id="addNewProjectRequestRequirementFormModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Agregar Nuevo Requerimiento</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="addNewProjectRequestRequirementForm" name="addNewProjectRequestRequirementForm" method="post">
                <div class="modal-body">
                    <input type="hidden" id="agregarSolicitudProyectoID" name="agregarSolicitudProyectoID" class="form-control" />
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="agregarDescripcionRequerimiento">Descripción De Requerimiento:</label>
                                <input type="text" id="agregarDescripcionRequerimiento" name="agregarDescripcionRequerimiento" class="form-control" placeholder="Ingrese la descripción del requerimiento.">
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