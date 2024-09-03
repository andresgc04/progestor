<div class="modal fade" id="newLaborResourcesFormModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Agregar Nuevo Recurso De Mano De Obra Del Proyecto</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="newLaborResourcesForm" name="newLaborResourcesForm" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <input type="hidden" id="addLaborResourcesProyectoObraCivilID" name="addLaborResourcesProyectoObraCivilID" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="faseProyectoIDRecursoManoObra">Fase Del Proyecto:</label>
                                <select id="faseProyectoIDRecursoManoObra" name="faseProyectoIDRecursoManoObra" class="form-control select2" style="width: 100%;"></select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="recursoManoObraID">Recurso De Mano De Obra:</label>
                                <select id="recursoManoObraID" name="recursoManoObraID" class="form-control select2" style="width: 100%;"></select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="tipoPagoID">Tipo De Pago:</label>
                                <input type="text" id="tipoPagoID" name="tipoPagoID" class="form-control" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="cantidadRecursosManosObras">Cantidad A Necesitar:</label>
                                <input type="text" id="cantidadRecursosManosObras" name="cantidadRecursosManosObras" class="form-control" placeholder="Ingrese la cantidad a necesitar de este recurso de mano de obra.">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="costoRecursoManoObra">Costo Unitario Del Recurso De Mano De Obra:</label>
                                <input type="text" id="costoRecursoManoObra" name="costoRecursoManoObra" class="form-control" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="costoTotalRecursoManoObra">Costo Total:</label>
                                <input type="text" id="costoTotalRecursoManoObra" name="costoTotalRecursoManoObra" class="form-control" readonly>
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