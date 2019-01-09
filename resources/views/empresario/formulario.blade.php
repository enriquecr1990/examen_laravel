<div class="modal" tabindex="-1" role="dialog" id="modal_formulario_empresario">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Empresario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="formulario_empresario">

                <input type="hidden" name="id" value="{{isset($empresario) ? $empresario->id : ''}}">

                <div id="contenedor_mensajes_validacion_form_empresario"></div>

                <div class="modal-body">
                    <div class="row">
                        <label class="form-group col-lg-4 col-md-6 col-sm-12">
                            Código
                        </label>
                        <div class="form-group col-lg-8 col-md-6 col-sm-12">
                            <input type="text" placeholder="Código" class="form-control" name="codigo" value="{{isset($empresario) ? $empresario->codigo : ''}}">
                        </div>

                        <label class="form-group col-lg-4 col-md-6 col-sm-12">
                            Razón social
                        </label>
                        <div class="form-group col-lg-8 col-md-6 col-sm-12">
                            <input type="text" placeholder="Razón social" class="form-control" name="razonsocial" value="{{isset($empresario) ? $empresario->razonsocial : ''}}">
                        </div>

                        <label class="form-group col-lg-4 col-md-6 col-sm-12">
                            Nombre
                        </label>
                        <div class="form-group col-lg-8 col-md-6 col-sm-12">
                            <input type="text" placeholder="Nombre de la persona" class="form-control" name="nombre" value="{{isset($empresario) ? $empresario->nombre : ''}}">
                        </div>

                        <label class="form-group col-lg-4 col-md-6 col-sm-12">
                            País
                        </label>
                        <div class="form-group col-lg-8 col-md-6 col-sm-12">
                            <input type="text" placeholder="País" class="form-control" name="pais" value="{{isset($empresario) ? $empresario->pais : ''}}">
                        </div>

                        <label class="form-group col-lg-4 col-md-6 col-sm-12">
                            Tipo de moneda
                        </label>
                        <div class="form-group col-lg-8 col-md-6 col-sm-12">
                            <input type="text" placeholder="Tipo de moneda" class="form-control mayus" name="tipo_moneda" value="{{isset($empresario) ? $empresario->tipo_moneda : ''}}">
                        </div>

                        <label class="form-group col-lg-4 col-md-6 col-sm-12">
                            Estado
                        </label>
                        <div class="form-group col-lg-8 col-md-6 col-sm-12">
                            <input type="text" placeholder="Estado" class="form-control" name="estado" value="{{isset($empresario) ? $empresario->estado : ''}}">
                        </div>

                        <label class="form-group col-lg-4 col-md-6 col-sm-12">
                            Ciudad
                        </label>
                        <div class="form-group col-lg-8 col-md-6 col-sm-12">
                            <input type="text" placeholder="Ciudad" class="form-control" name="ciudad" value="{{isset($empresario) ? $empresario->ciudad : ''}}">
                        </div>

                        <label class="form-group col-lg-4 col-md-6 col-sm-12">
                            Teléfono
                        </label>
                        <div class="form-group col-lg-8 col-md-6 col-sm-12">
                            <input type="text" placeholder="Teléfono" class="form-control" name="telefono" value="{{isset($empresario) ? $empresario->telefono : ''}}">
                        </div>

                        <label class="form-group col-lg-4 col-md-6 col-sm-12">
                            Correo
                        </label>
                        <div class="form-group col-lg-8 col-md-6 col-sm-12">
                            <input type="email" placeholder="Correo eléctronico" class="form-control" name="correo" value="{{isset($empresario) ? $empresario->correo : ''}}">
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="btn_guardar_empresario">Guardar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                </div>
            </form>

        </div>
    </div>
</div>