<div class="modal fade" id="newProjectActivityFormModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Agregar Nueva Actividad Del Proyecto</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="newProjectActivityForm" name="newProjectActivityForm" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <input type="hidden" id="addActivityProyectoObraCivilID" name="addActivityProyectoObraCivilID" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="faseProyectoID">Fase Del Proyecto:</label>
                                <select id="faseProyectoID" name="faseProyectoID" class="form-control select2" style="width: 100%;"></select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="tipoActividadID">Tipo De Actividad:</label>
                                <select id="tipoActividadID" name="tipoActividadID" class="form-control select2" style="width: 100%;"></select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="actividadProyectoID">Actividad Del Proyecto:</label>
                                <select id="actividadProyectoID" name="actividadProyectoID" class="form-control select2" style="width: 100%;"></select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="unidadMedida">Unidad De Medida:</label>
                                <input type="text" id="unidadMedida" name="unidadMedida" class="form-control" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="cantidadActividades">Cantidad A Necesitar:</label>
                                <input type="text" id="cantidadActividades" name="cantidadActividades" class="form-control" placeholder="Ingrese la cantidad a necesitar de esta actividad.">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="costoActividadProyecto">Costo Unitario De La Actividad:</label>
                                <input type="text" id="costoActividadProyecto" name="costoActividadProyecto" class="form-control" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="subTotal">Sub-Total:</label>
                                <input type="text" id="subTotal" name="subTotal" class="form-control" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="itbis">ITBIS:</label>
                                <input type="text" id="itbis" name="itbis" class="form-control" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="costoTotalActividad">Costo Total:</label>
                                <input type="text" id="costoTotalActividad" name="costoTotalActividad" class="form-control" readonly>
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