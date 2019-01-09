<?php
/**
 * Created by PhpStorm.
 * User: enriq
 * Date: 08/01/2019
 * Time: 06:33 PM
 */

namespace App\Http\Models;

use App\Http\Entities\EmpresariosEntity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class EmpresarioModel extends Model
{

    function __construct()
    {

    }

    public static function get_lista_empresario(){
        $empresario_entity =  new EmpresariosEntity();
        $lista_empreario = $empresario_entity
            ->where('activo','si')
            ->get();
        return $lista_empreario;
    }

    public static function get_empresario($id_empresario){
        $empresario_entity =  new EmpresariosEntity();
        return $empresario_entity
            ->where('id',$id_empresario)
            ->get()->first();
    }

    public static function guardar_empresario($empresario){
        $empresario_entity = new EmpresariosEntity();
        if(!is_null($empresario['id']) && $empresario['id'] != 0){
            $empresario_entity = EmpresariosEntity::find($empresario['id']);
        }
        $empresario_entity->id = $empresario['id'];
        $empresario_entity->codigo = $empresario['codigo'];
        $empresario_entity->razonsocial = $empresario['razonsocial'];
        $empresario_entity->nombre = $empresario['nombre'];
        $empresario_entity->pais = $empresario['pais'];
        $empresario_entity->tipo_moneda = $empresario['tipo_moneda'];
        $empresario_entity->estado = $empresario['estado'];
        $empresario_entity->ciudad = $empresario['ciudad'];
        $empresario_entity->telefono = $empresario['telefono'];
        $empresario_entity->correo = $empresario['correo'];
        $empresario_entity->activo = 'si';
        $empresario_entity->save();
        return true;
    }

    public static function desactivar_empresario($id_empresario){
        $empresario_entity = EmpresariosEntity::find($id_empresario);
        $empresario_entity->id = $id_empresario;
        $empresario_entity->activo = 'no';
        $empresario_entity->save();
        return true;
    }

    public static function eliminar_empresario($id_empresario){
        $empresario = EmpresariosEntity::find($id_empresario);
        return $empresario->delete();
    }

    public static function get_empresario_clave($clv){
        $existe = false;
        $empresario_entity =  new EmpresariosEntity();
        $empresario = $empresario_entity
            ->where('codigo',$clv)
            ->get();
        if(!$empresario->isEmpty()){
            $existe = true;
        }
        return $existe;
    }

}