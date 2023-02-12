<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class InformesGestionController extends Controller
{

    public $categorias = ["PAZ", "CONTENCIOSO", "LEIV"];

    public function guardar(Request $request){
        
        $request->validate(
        [
            "tribunal" => "required",
            "funcionario" => "required",
            "nombramiento" => "required",
            "mes_evaluado" => "required"
        ],
        [
            "tribunal.required" => "Debe ingresar una sede judicial",
            "funcionario.required" => "Debe ingresar un funcionario"   
        ]);
        
        $numero_funcionarios = DB::table("sede_judicial")
        ->where("id_sede", $request->tribunal)
        ->select("numero_funcionarios_sede AS cantidad")
        ->first();

        
        $informes_ingresados = DB::table("informes_gestion")
        ->where("id_tribunal", $request->tribunal)
        ->where("mes_evaluado", $request->mes_evaluado)
        ->select(DB::raw("count(id_tribunal) as cantidad"))
        ->first();

        $informes_ingresados_funcionario = DB::table("informes_gestion")
        ->where("id_tribunal", $request->tribunal)
        ->where("id_funcionario", $request->funcionario)
        ->where("mes_evaluado", $request->mes_evaluado)
        ->select(DB::raw("count(id_tribunal) as cantidad"))
        ->first();

        //return $informes_ingresados_funcionario;
        if($informes_ingresados->cantidad == $numero_funcionarios->cantidad)
        {
            return "La sede judicial " . $request->nombre_tribunal . " ya cuenta con el/los informe/s correspondientes al mes de " . $request->mes_evaluado . "<a href='". url('informes') ."'>Volver</a>";
        }

        if($informes_ingresados_funcionario->cantidad == 1){
            return $numero_funcionarios->cantidad == 1
                ? "Ya se ha ingresado el informe de gestion correspondiente al: " . $request->nombre_tribunal . " para el mes de " . $request->mes_evaluado
                : "Ya se ha ingresado el informe de gestion correspondiente al: " . $request->nombre_tribunal . " para el mes de " . $request->mes_evaluado . " del funcionario " . $request->nombre_funcionario;
        }

        DB::table("informes_gestion")
        ->insert([
            "id_tribunal" => $request->tribunal,
            "id_funcionario" => $request->funcionario,
            "nombramiento" => $request->nombramiento,
            "mes_evaluado" => $request->mes_evaluado
        ]);

        $datos = DB::table("informes_gestion")
        ->join("sede_judicial", "sede_judicial.id_sede", "=", "informes_gestion.id_tribunal")
        ->join("funcionarios", "funcionarios.id_funcionario", "=", "informes_gestion.id_funcionario")
        ->where("id_tribunal", $request->tribunal)
        ->where("funcionarios.id_funcionario", $request->funcionario)
        ->where("mes_evaluado", $request->mes_evaluado)
        ->first();

        return view("informes_gestion.nota", compact("datos"));
    }

    public function cargarFormularioPorEspecialidad($tribunal, $funcionario, $mes_evaluado){

        $categoria_tribunal = DB::table("sede_judicial")
        ->where("id_sede", $tribunal)
        ->select("id_especialidad_sede")
        ->first();

        $datos = DB::table("informes_gestion")
        ->join("sede_judicial", "sede_judicial.id_sede", "=", "informes_gestion.id_tribunal")
        ->join("funcionarios", "funcionarios.id_funcionario", "=", "informes_gestion.id_funcionario")
        ->where("id_tribunal", $tribunal)
        ->where("funcionarios.id_funcionario", $funcionario)
        ->where("mes_evaluado", $mes_evaluado)
        ->first();

        if(in_array($categoria_tribunal->id_especialidad_sede, [17, 10, 33, 34, 35, 11, 20])){
            return view("informes_gestion.informe_uno", compact("datos"));
        }
        if(in_array($categoria_tribunal->id_especialidad_sede, ['EXTINCION', 'AMBIENTAL', 'MENORES', 'LABORAL'])){
            return view("informes_gestion.informe_dos", compact("datos"));
        }
        if(in_array($categoria_tribunal->id_especialidad_sede, ['LEPINA', 'FAMILIA'])){
            return view("informes_gestion.informe_tres", compact("datos"));
        }
        if(in_array($categoria_tribunal->id_especialidad_sede, ['SENTENCIA'])){
            return view("informes_gestion.informe_cuatro", compact("datos"));
        }
        return $tribunal;
    }

    public function buscarFuncionario($buscar){
        $funcionario = DB::table("funcionarios")
        ->where(DB::raw("concat(RTRIM(nombres), ' ', RTRIM(apellidos))"), "LIKE", '%' .$buscar. '%')
        ->get();
        
        return $funcionario;
    }

    public function buscarJudicatura($buscar){
        $judicatura = DB::table("sede_judicial")
        ->join("departamento", "departamento.id_departamento", "=", "sede_judicial.id_departamento")
        ->where("nombre_sede", "LIKE" ,'%'.$buscar.'%')
        ->get();

        return $judicatura;
    }

    public function listarInformesGestion(){
        $informes = DB::table("informes_gestion")
        ->join("funcionarios", "funcionarios.id_funcionario", "=", "informes_gestion.id_funcionario")
        ->join("sede_judicial", "sede_judicial.id_sede", "=", "informes_gestion.id_tribunal")
        ->get();

        return view("informes_gestion.lista_informes", compact("informes"));
    }

    public function buscarInformes(Request $request){
        $informes = DB::table("informes_gestion")
        ->join("funcionarios", "funcionarios.id_funcionario", "=", "informes_gestion.id_funcionario")
        ->join("sede_judicial", "sede_judicial.id_sede", "=", "informes_gestion.id_tribunal")
        ->when($request->tipo_busqueda == "funcionarios", function($query) use ($request){
            return $query->where(DB::raw('CONCAT(nombres," ", apellidos)'), 'LIKE', '%'.$request->buscar_informes.'%');
        }, function($query) use($request){
            return $query->where("nombre_sede", 'LIKE', '%'.$request->buscar_informes.'%');
        })        
        ->get();

        return view("informes_gestion.lista_informes", compact("informes"));
    }


    public function guardarInformeGestion(Request $request){

        $obtenidos = $request->except(["_token", "en_tiempo"]);

        foreach($obtenidos as $key => $value){
            if(!in_array($key, ['tribunal', 'funcionario', 'nombramiento', 'mes_evaluado', 'fecha_recepcion'])){
                $validacion[$key] = 'required|numeric|min:0';
            }
            else{
                $validacion[$key] = 'required';
            }
        }
        //return $request;
        $request->validate(
            $validacion,
        [
            "tribunal.required" => "Debe ingresar un tribunal",
            "funcionario.required" => "Debe ingresar un funcionario",
            "nombramiento.required" => "Debe seleccionar el nombramiento del funcionario",
            "fecha_recepcion.required" => "Debe colocar la fecha de ingreso",
            "mes_evaluado.required" => "Debe seleccionar el mes evaluado",
            "inicio_mes.required" => "Debe indicar el número de trámites a inicio de mes",
            "inicio_mes.numeric" => "El campo de trámite a inicio de mes debe ser numérico",
            "inicio_mes.min" => "El campo de trámite a inicio de mes debe ser igual o mayor a 0",
            "final_mes.required" => "Debe indicar el número de trámites a final de mes",
            "final_mes.numeric" => "El campo de trámite a fin de mes debe ser numérico",
            "final_mes.min" => "El campo de trámite a fin de mes debe ser igual o mayor a 0",
            "ingresados.required" => "Debe indicar el número de trámites ingresados durante el mes",
            "ingresados.numeric" => "El campo de Ingresados en el Periodo debe ser numérico",
            "ingresados.min" => "El campo de Ingresados en el Periodo debe ser igual o mayor a 0",
            "reactivados.required" => "Debe indicar el número de trámites reactivados durante el mes",
            "reactivados.numeric" => "El campo de Reactivados en el Periodo debe ser numérico",
            "reactivados.min" => "El campo de Reactivados en el Periodo debe ser igual o mayor a 0",
            "conversion.required" => "Debe indicar el número de trámites convertidos durante el mes",
            "conversion.numeric" => "El campo de Convertidos en el Periodo debe ser numérico",
            "conversion.min" => "El campo de Convertidos en el Periodo debe ser igual o mayor a 0",
            "resueltos.required" => "Debe indicar el número de trámites resueltos durante el mes",
            "resueltos.numeric" => "El campo de Resueltos en el Periodo debe ser numérico",
            "resueltos.min" => "El campo de Resueltos en el Periodo debe ser igual o mayor a 0",
            "inactivos_inicio.required" => "Debe indicar el número de trámites inactivos al inicio del mes",
            "inactivos_inicio.numeric" => "El campo de Inactivos en el Periodo debe ser numérico",
            "inactivos_inicio.min" => "El campo de Inactivos en el Periodo debe ser igual o mayor a 0",
            "inactivos_final.required" => "Debe indicar el número de trámites inactivos al final del mes",
            "inactivos_final.numeric" => "El campo de Resueltos en el Periodo debe ser numérico",
            "inactivos_final.min" => "El campo de Resueltos en el Periodo debe ser igual o mayor a 0",
            "pendientes_inicio.required" => "Debe indicar el número de trámites inactivos al final del mes",
            "pendientes_inicio.numeric" => "El campo de Resueltos en el Periodo debe ser numérico",
            "pendientes_inicio.min" => "El campo de Resueltos en el Periodo debe ser igual o mayor a 0",
            "recibidas_periodo.required" => "Debe indicar el número de trámites inactivos al final del mes",
            "recibidas_periodo.numeric" => "El campo de Resueltos en el Periodo debe ser numérico",
            "recibidas_periodo.min" => "El campo de Resueltos en el Periodo debe ser igual o mayor a 0",
            "realizadas_periodo.required" => "Debe indicar el número de trámites inactivos al final del mes",
            "realizadas_periodo.numeric" => "El campo de Resueltos en el Periodo debe ser numérico",
            "realizadas_periodo.min" => "El campo de Resueltos en el Periodo debe ser igual o mayor a 0",
            "pendientes_final.required" => "Debe indicar el número de trámites inactivos al final del mes",
            "pendientes_final.numeric" => "El campo de Resueltos en el Periodo debe ser numérico",
            "pendientes_final.min" => "El campo de Resueltos en el Periodo debe ser igual o mayor a 0",
        ]);
       
        $en_tiempo = isset($request->en_tiempo) ? $request->en_tiempo : "FUERA DE TIEMPO";

        $informe = DB::table("informes_gestion")
        ->where("id_tribunal", $request->tribunal)
        ->where("id_funcionario", $request->funcionario)
        ->where("mes_evaluado", $request->mes_evaluado)
        ->update([
            
            "nombramiento" => $request->nombramiento,
            "fecha_recepcion" => $request->fecha_recepcion,
            "tramite_inicio" => $request->inicio_mes,
            "ingresados_periodo" => $request->ingresados,
            "reactivados_periodo" => $request->reactivados,
            "convertidos_periodo" => $request->convertidos,
            "resueltos_periodo" => $request->resueltos,
            "tramite_fin" => $request->final_mes,
            "inactivos_inicio" => $request->inactivos_inicio,
            "inactivos_final" => $request->inactivos_final,
            "pendientes_inicio" => $request->pendientes_inicio,
            "recibidas_periodo" => $request->recibidas_periodo,
            "realizadas_periodo" => $request->realizadas_periodo,
            "pendientes_final" => $request->pendientes_final,
            "cumplio" => $en_tiempo
        ]);

        return back();
    }

    public function mostrarInformes(){
        return view("informes_gestion.informes_gestion");
    }
}
