<div class="modal fade" id="updateMaterialResourcesFormModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Modificar Recurso Material</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="updateMaterialResourcesForm" name="updateMaterialResourcesForm" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <input type="hidden" id="updateTipoRecursoMaterialID" name="updateTipoRecursoMaterialID" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <input type="hidden" id="updateRecursoMaterialID" name="updateRecursoMaterialID" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="modificarTipoRecursoMaterialID">Tipo De Recurso Material:</label>
                                <select id="modificarTipoRecursoMaterialID" name="modificarTipoRecursoMaterialID" class="form-control select2" style="width: 100%;"></select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="modificarNombreRecursoMaterial">Recurso Material:</label>
                                <input type="text" id="modificarNombreRecursoMaterial" name="modificarNombreRecursoMaterial" class="form-control" placeholder="Ingrese el nombre del recurso material.">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="modificarUnidadMedidaID">Unidad De Medida:</label>
                                <select id="modificarUnidadMedidaID" name="modificarUnidadMedidaID" class="form-control select2" style="width: 100%;"></select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="mr-2">Cancelar</span><span><i class="fas fa-times-circle"></i></span></button>
                    <button type="submit" class="btn btn-primary"><span class="mr-2">Modificar</span><span><i class="fas fa-save"></i></span></button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->