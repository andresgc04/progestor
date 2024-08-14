<div class="modal fade" id="updateProjectActivityFormModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Modificar Actividad Del Proyecto</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="updateProjectActivityForm" name="updateProjectActivityForm" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <input type="hidden" id="modifyActividadProyectoObraCivilID" name="modifyActividadProyectoObraCivilID" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <input type="hidden" id="modifyProyectoObraCivilID" name="modifyProyectoObraCivilID" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="modifyTipoActividadID">Tipo De Actividad:</label>
                                <select id="modifyTipoActividadID" name="modifyTipoActividadID" class="form-control select2" style="width: 100%;"></select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="modifyNombreActividad">Nombre De Actividad:</label>
                                <input type="text" id="modifyNombreActividad" name="modifyNombreActividad" class="form-control" placeholder="Ingrese el nombre de la actividad.">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="modifyDescripcionActividad">Descripción De La Actividad:</label>
                                <textarea id="modifyDescripcionActividad" name="modifyDescripcionActividad" class="form-control" rows="3" placeholder="Ingrese la descripcion de la actividad."></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="modifyCostoActividad">Costo De La Actividad:</label>
                                <input type="text" id="modifyCostoActividad" name="modifyCostoActividad" class="form-control" placeholder="Ingrese el costo de la actividad.">
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