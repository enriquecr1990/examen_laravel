$(document).ready(function () {
    $('body').on('click','#btn_buscar_empresarios',function (e) {
        e.preventDefault();
        Empresario.obtener_tablero_empresario();
    });

    $('body').on('click','#btn_agregar_nuevo_empresario',function(e){
        e.preventDefault();
        Empresario.agregar_modificar_empresario($(this));
    });

    $('body').on('click','.btn_modificar_empresario',function(e){
        e.preventDefault();
        Empresario.agregar_modificar_empresario($(this));
    });

    $('body').on('click','#btn_guardar_empresario',function(e){
        e.preventDefault();
        Empresario.guardar_empresario($(this));
    });

    $('body').on('click','.btn_desactivar_empresario',function(e){
        e.preventDefault();
        Empresario.desactivar_empresario($(this));
    });

    $('body').on('click','.eliminar_empresario',function(e){
        e.preventDefault();
        Empresario.eliminar_empresario($(this));
    });

    $('body').on('change','.mayus',function (e) {
        e.preventDefault();
        var value = $(this).val();
        $(this).val(value.toUpperCase());
    });

    Empresario.trigger_buscar_empresario();
});

var Empresario = {

    serializar_formulario : function(id_form){
        return $('#'+id_form).serialize();
    },

    mensaje_operacion : function(type,msg,destino,time){
        $(destino).html('');
        var identificador = $.now();
        var tiempo = 6000;
        if(time != undefined && time != '' && time > 0){
            tiempo = parseInt(time);
        }
        var html_msg = '' +
            '<div class="row" id="'+identificador+'">' +
                '<div class="form-group">' +
                    '<div class="col-lg-12 col-md-12 col-sm-12">' +
                        '<div class="alert alert-'+type+'">' +
                        '' + msg + '' +
                        '</div>' +
                    '</div>' +
                '</div>' +
            '</div>';
        $(destino).html(html_msg);
        setTimeout(function () {
            $('#'+identificador).fadeOut(1000);
        },tiempo);
    },

    obtener_contenido_peticion : function (url,parametros,processor,metodo,respuesta) {
        if (!metodo) {
            metodo = "POST";
        }
        $.ajax({
            type : metodo,
            data : parametros,
            dataType: respuesta,
            url : url,
            success : function (data) {
                processor(data,true);
            },
            error : function (xhr,ajaxOptions,thrownError) {
                alert(xhr.status);
                alert(thrownError);
                processor("No se pudo establecer con el servidor",false);
            }
        });
    },

    mostrar_modal_bootstrap : function(id_modal,mostrar){
        if(mostrar){
            $('#'+id_modal).modal({backdrop: 'static', keyboard: false});
            $('#'+id_modal).modal('show');
        }else{
            $('#'+id_modal).modal('hide');
        }
    },

    trigger_buscar_empresario : function (){
        $('#btn_buscar_empresarios').trigger('click');
    },

    obtener_tablero_empresario : function (){
        $('#contenido_registros_empresarios').html('<span class="badge badge-success">Cargando...</span>');
        Empresario.obtener_contenido_peticion(
            'empresario/buscar_empresarios',{},
            function(response){
                $('#contenido_registros_empresarios').html(response);
            },
            'post',
            'html'
        );
    },

    agregar_modificar_empresario : function (btn){
        var post = {};
        if(btn.data('id_empresario') != undefined && btn.data('id_empresario') != '') {
            post = {
                id_empresario : btn.data('id_empresario')
            }
        }
        Empresario.obtener_contenido_peticion(
            'empresario/agregar_modificar',post,
            function(respuesta){
                $('#contenido_formulario_empresaario').html(respuesta);
                Empresario.mostrar_modal_bootstrap('modal_formulario_empresario',true);
            },
            'post',
            'html'
        );
    },

    btn_guardar_disabled : function(btn_lnk){
        btn_lnk.attr('disabled',true);
        btn_lnk.html('Procesando...');
    },

    btn_guardar_enable : function(btn_lnk,html){
        btn_lnk.removeAttr('disabled');
        var html_buton = 'Guardar';
        if(html != undefined && html != ''){
            html_buton = html;
        }
        btn_lnk.html(html_buton);
    },

    guardar_empresario : function(btn){
        Empresario.btn_guardar_disabled(btn);
        var post = Empresario.serializar_formulario('formulario_empresario');
        Empresario.obtener_contenido_peticion(
            'empresario/guardar',post,
            function(respuesta){
                if(respuesta.success){
                    Empresario.mostrar_modal_bootstrap('modal_formulario_empresario',false);
                    Empresario.mensaje_operacion('success','Se guardo la información con exito','#contenido_mensajes_sistema',10000);
                    Empresario.trigger_buscar_empresario();
                }else{
                    var msg_validacion = '';
                    for(var i = 0; i < respuesta.msg.length; i ++){
                        msg_validacion += '<li>'+respuesta.msg[i]+'</li>';
                    }
                    Empresario.mensaje_operacion('danger',msg_validacion,'#contenedor_mensajes_validacion_form_empresario',10000);
                }
                Empresario.btn_guardar_enable(btn,'Guardar');
            },
            'post',
            'json'
        );
    },

    desactivar_empresario : function(btn){
        var confirmacion = confirm('¿Desea desactivar el empresario seleccionado?');
        if(confirmacion){
            var post = {
                id_empresario : btn.data('id_empresario')
            }
            Empresario.obtener_contenido_peticion(
                'empresario/desactivar',post,
                function(respuesta){
                    if(respuesta.success){
                        Empresario.mensaje_operacion('success',respuesta.msg,'#contenido_mensajes_sistema');
                        Empresario.trigger_buscar_empresario();
                    }else{
                        Empresario.mensaje_operacion('danger',respuesta.msg,'#contenido_mensajes_sistema');
                    }
                },
                'post',
                'json'
            );
        }
    },

    eliminar_empresario : function(btn){
        var confirmacion = confirm('¿Desea eliminar el registro seleccionado?');
        if(confirmacion){
            var post = {
                id_empresario : btn.data('id_empresario')
            }
            Empresario.obtener_contenido_peticion(
                'empresario/eliminar',post,
                function(respuesta){
                    if(respuesta.success){
                        Empresario.mensaje_operacion('success',respuesta.msg,'#contenido_mensajes_sistema');
                        Empresario.trigger_buscar_empresario();
                    }else{
                        Empresario.mensaje_operacion('danger',respuesta.msg,'#contenido_mensajes_sistema');
                    }
                },
                'post',
                'json'
            );
        }
    }

}