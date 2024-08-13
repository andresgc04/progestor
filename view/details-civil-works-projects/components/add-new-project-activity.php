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
                            <input type="hidden" id="proyectoObraCivilID" name="proyectoObraCivilID" class="form-control">
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
                                <label for="nombreActividad">Nombre De Actividad:</label>
                                <input type="text" id="nombreActividad" name="nombreActividad" class="form-control" placeholder="Ingrese el nombre de la actividad.">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="descripcionActividad">Descripción De La Actividad:</label>
                                <textarea id="descripcionActividad" name="descripcionActividad" class="form-control" rows="3" placeholder="Ingrese la descripcion de la actividad."></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="costoActividad">Costo De La Actividad:</label>
                                <input type="text" id="costoActividad" name="costoActividad" class="form-control" placeholder="Ingrese el costo de la actividad.">
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