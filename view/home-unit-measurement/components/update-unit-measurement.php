<div class="modal fade" id="updateUnitMeasurementFormModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Modificar Unidad De Medida</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="updateUnitMeasurementForm" name="updateUnitMeasurementForm" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <input type="hidden" id="unidadMedidaID" name="unidadMedidaID" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="modificarUnidadMedida">Unidad De Medida:</label>
                                <input type="text" id="modificarUnidadMedida" name="modificarUnidadMedida" class="form-control" placeholder="Ingrese el nombre de la unidad de medida.">
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