<div class="modal fade" id="newProjectActivitiesFormModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Registrar Nueva Actividad De Proyectos</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="newProjectActivitiesForm" name="newProjectActivitiesForm" method="post">
                <div class="modal-body">
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
                                <label for="actividadProyecto">Actividades De Los Proyectos:</label>
                                <input type="text" id="actividadProyecto" name="actividadProyecto" class="form-control" placeholder="Ingrese el nombre de la actividad de los proyectos.">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="unidadMedidaID">Unidad De Medida:</label>
                                <select id="unidadMedidaID" name="unidadMedidaID" class="form-control select2" style="width: 100%;"></select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="costoActividadProyecto">Costo De Las Actividades De Los Proyectos:</label>
                                <input type="text" id="costoActividadProyecto" name="costoActividadProyecto" class="form-control" placeholder="Ingrese el costo de la actividad de los proyectos.">
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