<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\EmpresarioModel;

class EmpresarioController extends Controller
{

    public function buscar_empresarios(){
        $lista_empresario = EmpresarioModel::get_lista_empresario();
        return view('empresario.registros',
            array(
                'lista_empresario' => $lista_empresario
            ));
    }

    public function agregar_modificar_empresario(Request $request){
        $data = array();
        if(isset($request['id_empresario']) && $request['id_empresario'] != ''){
            $data['empresario'] = EmpresarioModel::get_empresario($request['id_empresario']);
        }
        return view('empresario.formulario',$data);
    }

    public function guardar_empresario(Request $request){
        $retorno_peticion['success'] = true;
        $retorno_peticion['msg'] = '';
        $validar_form = $this->validar_formulario($request);
        if($validar_form['success']){
            $existe_empresario = EmpresarioModel::get_empresario_clave($request['codigo']);
            $update = $request['id'] != '';
            if(($existe_empresario && $update) || (!$update && !$existe_empresario)){
                EmpresarioModel::guardar_empresario($request);
            }else{
                $retorno_peticion['success'] = false;
                $retorno_peticion['msg'] = array(
                    'Existe el empleado con esta clave'
                );
            }
        }else{
            $retorno_peticion['success'] = false;
            $retorno_peticion['msg'] = $validar_form['msg'];
        }
        echo json_encode($retorno_peticion);
        exit;
    }

    public function desactivar_empresario(Request $request){
        $retorno_peticion['success'] = true;
        $retorno_peticion['msg'] = 'Se desactivo el empresario con exito';
        if(!EmpresarioModel::desactivar_empresario($request['id_empresario'])){
            $retorno_peticion['success'] = false;
            $retorno_peticion['msg'] = 'No fue posible desactivar el empresario seleccionado';
        }
        echo json_encode($retorno_peticion);
        exit;
    }

    public function eliminar_empresario(Request $request){
        $retorno_peticion['success'] = true;
        $retorno_peticion['msg'] = 'Se eliminó el registro con exito';
        if(!EmpresarioModel::eliminar_empresario($request['id_empresario'])){
            $retorno_peticion['success'] = false;
            $retorno_peticion['msg'] = 'No fue posible eliminar el registro seleccionado';
        }
        echo json_encode($retorno_peticion);
        exit;
    }

    private function validar_formulario($request){
        \App::setLocale('es');
        $result['success'] = true;
        $result['msg'] = '';
        $array_validaciones = [
            'codigo' => 'required',
            'razonsocial' => 'required',
            'nombre' => 'required',
            'pais' => 'required',
            'tipo_moneda' => 'required',
            'estado' => 'required',
            'ciudad' => 'required',
            'telefono' => 'required',
            'correo' => 'required|email',
        ];
        $validacion = \Validator::make($request->all(),$array_validaciones);
        if($validacion->fails()){
            $result['success'] = false;
            $result['msg'] = $validacion->errors()->all();
        }
        $tipo_moneda = $this->validar_codigo_moneda($request['tipo_moneda']);
        if(!$tipo_moneda){
            $result['success'] = false;
            $result['msg'][] = 'El tipo de moneda "'.$request['tipo_moneda'].'" no es valido por el WS';
        }
        return $result;
    }

    private function validar_codigo_moneda($tipo_moneda){
        ini_set("soap.wsdl_cache_enabled", 0);
        $url_ws = 'http://fx.currencysystem.com/webservices/CurrencyServer4.asmx?WSDL';
        $opciones_ws = array(
            'licenseKey' => '',
            'currency' => $tipo_moneda
        );
        $client = new \SoapClient($url_ws);
        return $client->CurrencyExists($opciones_ws)->CurrencyExistsResult;
    }
}
