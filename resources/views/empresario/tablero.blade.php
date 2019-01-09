@include('layout.header')

<div class="row">
    <div class="form-group col-lg-12 col-md-12 col-sm-12">
        <div class="alert alert-info">
            Empresarios
        </div>
    </div>
</div>

<div id="contenido_mensajes_sistema"></div>

<div class="row">
    <div class="form-group col-lg-12 col-md-12 col-sm-12 text-right">
        <button id="btn_buscar_empresarios" type="button" style="display: none;">Buscar</button>
        <button id="btn_agregar_nuevo_empresario" type="button" class="btn btn-info">Agregar empresario</button>
    </div>
</div>

<div id="contenido_registros_empresarios"></div>
<div id="contenido_formulario_empresaario"></div>

@include('layout.footer')