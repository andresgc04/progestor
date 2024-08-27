<div class="modal fade" id="newResourcesMaterialFormModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Agregar Nuevo Recurso Material Del Proyecto</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="newResourcesMaterialForm" name="newResourcesMaterialForm" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <input type="hidden" id="addResourceMaterialProyectoObraCivilID" name="addResourceMaterialProyectoObraCivilID" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="faseProyectoIDRecursoMaterial">Fase Del Proyecto:</label>
                                <select id="faseProyectoIDRecursoMaterial" name="faseProyectoIDRecursoMaterial" class="form-control select2" style="width: 100%;"></select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="proveedorID">Proveedor:</label>
                                <select id="proveedorID" name="proveedorID" class="form-control select2" style="width: 100%;"></select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="tipoRecursoMaterialID">Tipo De Recurso Material:</label>
                                <select id="tipoRecursoMaterialID" name="tipoRecursoMaterialID" class="form-control select2" style="width: 100%;"></select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="recursoMaterialID">Recurso Material:</label>
                                <select id="recursoMaterialID" name="recursoMaterialID" class="form-control select2" style="width: 100%;"></select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="unidadMedidaRecursoMaterial">Unidad De Medida:</label>
                                <input type="text" id="unidadMedidaRecursoMaterial" name="unidadMedidaRecursoMaterial" class="form-control" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="cantidadRecursosMateriales">Cantidad A Necesitar:</label>
                                <input type="text" id="cantidadRecursosMateriales" name="cantidadRecursosMateriales" class="form-control" placeholder="Ingrese la cantidad a necesitar de este recurso material.">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="costoRecursoMaterial">Costo Unitario Del Recurso Material:</label>
                                <input type="text" id="costoRecursoMaterial" name="costoRecursoMaterial" class="form-control" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="subTotalRecursoMaterial">Sub-Total:</label>
                                <input type="text" id="subTotalRecursoMaterial" name="subTotalRecursoMaterial" class="form-control" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="itbisRecursoMaterial">ITBIS:</label>
                                <input type="text" id="itbisRecursoMaterial" name="itbisRecursoMaterial" class="form-control" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="costoTotalRecursoMaterial">Costo Total:</label>
                                <input type="text" id="costoTotalRecursoMaterial" name="costoTotalRecursoMaterial" class="form-control" readonly>
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