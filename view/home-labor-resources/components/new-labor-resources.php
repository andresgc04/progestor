<div class="modal fade" id="newLaborResourcesFormModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Registrar Nuevo Recurso De Mano De Obra</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="newLaborResourcesForm" name="newLaborResourcesForm" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="recursoManoObra">Recurso De Mano De Obra:</label>
                                <input type="text" id="recursoManoObra" name="recursoManoObra" class="form-control" placeholder="Ingrese el nombre del recurso de mano de obra.">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="tipoPagoID">Tipo De Pago:</label>
                                <select id="tipoPagoID" name="tipoPagoID" class="form-control select2" style="width: 100%;"></select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="costoPagoRecursoManoObra">Costo Del Pago De Recurso De Mano De Obra:</label>
                                <input type="number" id="costoPagoRecursoManoObra" name="costoPagoRecursoManoObra" class="form-control" placeholder="Ingrese el costo del pago del recurso de mano de obra.">
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