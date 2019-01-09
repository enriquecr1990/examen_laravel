<div class="table-responsive">
    <table class="table table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th>Código</th>
            <th>Nombre y Razón Social</th>
            <th>País y moneda</th>
            <th>Estado/ciudad</th>
            <th>Contacto</th>
            <th>Operaciones</th>
        </tr>
        </thead>
        <tbody>
        @if(sizeof($lista_empresario) != 0)
            @foreach($lista_empresario as $index => $l)
                <tr>
                    <td>{{$index + 1}}</td>
                    <td>{{$l->codigo}}</td>
                    <td>{{$l->razonsocial}} <br> {{$l->nombre}}</td>
                    <td>{{$l->pais}} - {{$l->tipo_moneda}}</td>
                    <td>{{$l->estado}}/{{$l->ciudad}}</td>
                    <td>{{$l->telefono}}<br>{{$l->correo}}</td>
                    <td>
                        <ul style="list-style: none">
                            <li class="mb-3">
                                <button type="button" class="btn btn-primary btn_modificar_empresario" data-id_empresario="{{$l->id}}">
                                    Modificar
                                </button>
                            </li>
                            <li class="mb-3">
                                <button type="button" class="btn btn-warning btn_desactivar_empresario" data-id_empresario="{{$l->id}}">
                                    Desactivar
                                </button>
                            </li>
                            <li>
                                <button type="button" class="btn btn-danger eliminar_empresario" data-id_empresario="{{$l->id}}">
                                    Eliminar
                                </button>
                            </li>
                        </ul>
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td class="text-center" colspan="7">Sin registros encontrados</td>
            </tr>
        @endif
        </tbody>
    </table>
</div>