<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ReporteController extends Controller
{
    public $mensajes_validacion = [];
    public $arreglo = array();

    

    public $ponderaciones_criterios = [
        "eps_1_1" => 5.0,
        "eps_1_2" => 1.0,
        "eps_2_1" => 2.0,
        "eps_2_2" => 1.0,
        "eps_3_1" => 1.0,
        "eps_3_2" => 5.0,
        "eps_3_3" => 1.0,
        "eps_4_1" => 1.0,
        "eps_4_2" => 1.0,
        "eps_5_1" => 5.0,
        "eps_5_2" => 1.0,
        "eps_6_1" => 2.0,
        "eps_6_2" => 2.0,
        "eps_6_3" => 2.0
    ];

    public $criterios = [
        "evaluado_criterio_1" => 6, 
        "evaluado_criterio_2" => 3, 
        "evaluado_criterio_3" => 7, 
        "evaluado_criterio_4" => 2, 
        "evaluado_criterio_5" => 6, 
        "evaluado_criterio_6" => 6
    ];

    public function evaluacion(){
        return view("evaluacion.evaluacion-en-sede");
    }
    

    public function puntosAcumuladosCriteriosSinEvaluar($request){
        $noestan = array();
        
        foreach($this->criterios as $criterio => $ponderacion){
            if(!isset($request->$criterio)){
                $noestan[$criterio] = $ponderacion;
            }
        }
        
        return $noestan;
    }

    

    public function reasignarPuntosCriterios($array){
        $no_estan = $array;
        $puntos_acumulados = array_sum($no_estan);
        $diferencia = 30 - $puntos_acumulados;
        $criterios = $this->criterios;

        foreach($criterios as $criterio => $poderacion){
            if(!array_key_exists($criterio, $no_estan)){
                $d[$criterio] = round($poderacion + ($puntos_acumulados * ($poderacion / $diferencia)), 2);;
            }
        }
        
        return $d;
    }

    public function guardarCriterioEPA1(Request $request){
        return $this->evaluarSubCriterios($request);
        //return $this->puntosAcumuladosCriteriosSinEvaluar($request);
        return $this->reasignarPuntosCriterios($this->puntosAcumuladosCriteriosSinEvaluar($request));
        $reglas_validacion = array();
        
        
        if(isset($request->evaluado_criterio_1)){
            if(isset($request->evaluado_criterio_1_1)){
                $reglas_validacion['eps_1_1'] = 'required|numeric|max:5.0|min:0.0';
                $this->generarMensajesValidacion("eps_1_1", "El subcriterio 1.1 ", $reglas_validacion['eps_1_1']);
            }
              
            if(isset($request->evaluado_criterio_1_2)){
                $reglas_validacion['eps_1_2'] = 'required|numeric|max:1.0|min:0.0';
                $this->generarMensajesValidacion("eps_1_2", "El subcriterio 1.2 ", $reglas_validacion['eps_1_2']);
            }

        }

        if(isset($request->evaluado_criterio_2)){
            if(isset($request->evaluado_criterio_2_1)){
                $reglas_validacion['eps_2_1'] = 'required|numeric|max:2.0|min:0.0';
                $this->generarMensajesValidacion("eps_2_1", "El subcriterio 2.1 ", $reglas_validacion['eps_2_1']);
            }
              
            if(isset($request->evaluado_criterio_2_2)){
                $reglas_validacion['eps_2_2'] = 'required|numeric|max:1.0|min:0.0';
                $this->generarMensajesValidacion("eps_2_2", "El subcriterio 2.2 ", $reglas_validacion['eps_2_2']);
            }
      
        }

        if(isset($request->evaluado_criterio_3)){
            if(isset($request->evaluado_criterio_3_1)){
                $reglas_validacion['eps_3_1'] = 'required|numeric|max:1.0|min:0.0';
                $this->generarMensajesValidacion("eps_3_1", "El subcriterio 3.1 ", $reglas_validacion['eps_3_1']);
            }
              
            if(isset($request->evaluado_criterio_3_2)){
                $reglas_validacion['eps_3_2'] = 'required|numeric|max:5.0|min:0.0';
                $this->generarMensajesValidacion("eps_3_2", "El subcriterio 3.2 ", $reglas_validacion['eps_3_2']);
            }

            if(isset($request->evaluado_criterio_3_3)){
                $reglas_validacion['eps_3_3'] = 'required|numeric|max:1.0|min:0.0';
                $this->generarMensajesValidacion("eps_3_3", "El subcriterio 3.3 ", $reglas_validacion['eps_3_3']);
            }
      
        }

        
        $request->validate(
            $reglas_validacion,
            $this->mensajes_validacion
        );

        return "OK";
        
    }

    public function evaluarSubCriterios($request){
        $arreglo = $this->arreglo;

        //Evaluamos las posibilidades en el primer Criterio
        if(!isset($request->evaluado_criterio_1_1) and isset($request->evaluado_criterio_1_2)){
            $arreglo['eps_1_2'] = $request->eps_1_2 + $this->ponderaciones_criterios['eps_1_1'];
        }
        if(!isset($request->evaluado_criterio_1_2) and isset($request->evaluado_criterio_1_1)){
            $arreglo['eps_1_1'] = $request->eps_1_1 + $this->ponderaciones_criterios['eps_1_2'];
        }
        if(isset($request->evaluado_criterio_1_2) and isset($request->evaluado_criterio_1_1)){
            $arreglo['eps_1_1'] = $request->eps_1_1;
            $arreglo['eps_1_2'] = $request->eps_1_2;
        }

        //Evaluamos las posibilidades en el segundo criterio
        if(!isset($request->evaluado_criterio_2_1) and isset($request->evaluado_criterio_2_2)){
            $arreglo['eps_2_2'] = $request->eps_2_2 + $this->ponderaciones_criterios['eps_2_1'];
        }
        if(!isset($request->evaluado_criterio_2_2) and isset($request->evaluado_criterio_2_1)){
            $arreglo['eps_2_1'] = $request->eps_2_1 + $this->ponderaciones_criterios['eps_2_2'];
        }
        if(isset($request->evaluado_criterio_2_2) and isset($request->evaluado_criterio_2_1)){
            $arreglo['eps_2_1'] = $request->eps_2_1;
            $arreglo['eps_2_2'] = $request->eps_2_2;
        }

        //Evaluamos las posibilidades en el tercer criterio
        if(!isset($request->evaluado_criterio_3_1)){
            if(isset($request->evaluado_criterio_3_2) and !isset($request->evaluado_criterio_3_3)){  
                $arreglo['eps_3_2'] = $this->ponderaciones_criterios['eps_3_1'] + $this->ponderaciones_criterios['eps_3_3'] + $request->eps_3_2;
            }
            if(!isset($request->evaluado_criterio_3_2) and isset($request->evaluado_criterio_3_3)){  
                $arreglo['eps_3_3'] = $this->ponderaciones_criterios['eps_3_1'] + $this->ponderaciones_criterios['eps_3_2'] + $request->eps_3_3;
            }
            if(isset($request->evaluado_criterio_3_2) and isset($request->evaluado_criterio_3_3)){  
                $peso = $this->ponderaciones_criterios['eps_3_1'] / ($this->ponderaciones_criterios['eps_3_2'] + $this->ponderaciones_criterios['eps_3_3']);
                $arreglo['eps_3_2'] = round($request->eps_3_2 + ($peso * $this->ponderaciones_criterios['eps_3_2']), 2);
                $arreglo['eps_3_3'] = round($request->eps_3_3 + ($peso * $this->ponderaciones_criterios['eps_3_3']), 2);
            }
        }

        if(isset($request->evaluado_criterio_3_1)){
            if(isset($request->evaluado_criterio_3_2) and !isset($request->evaluado_criterio_3_3)){  
                $peso = $this->ponderaciones_criterios['eps_3_3'] / ($this->ponderaciones_criterios['eps_3_2'] + $this->ponderaciones_criterios['eps_3_1']);
                $arreglo['eps_3_1'] = round($request->eps_3_1 + ($peso * $this->ponderaciones_criterios['eps_3_1']), 2); 
                $arreglo['eps_3_2'] = round($request->eps_3_2 + ($peso * $this->ponderaciones_criterios['eps_3_2']), 2); 
            }
            if(!isset($request->evaluado_criterio_3_2) and isset($request->evaluado_criterio_3_3)){  
                $peso = $this->ponderaciones_criterios['eps_3_2'] / ($this->ponderaciones_criterios['eps_3_1'] + $this->ponderaciones_criterios['eps_3_3']);
                $arreglo['eps_3_1'] = round($request->eps_3_1 + ($peso * $this->ponderaciones_criterios['eps_3_1']), 2); 
                $arreglo['eps_3_2'] = round($request->eps_3_3 + ($peso * $this->ponderaciones_criterios['eps_3_3']), 2); 
            }
            if(isset($request->evaluado_criterio_3_2) and isset($request->evaluado_criterio_3_3)){  
                $arreglo['eps_3_1'] = $request->eps_3_1;
                $arreglo['eps_3_2'] = $request->eps_3_2;
                $arreglo['eps_3_3'] = $request->eps_3_3;
            }
            if(!isset($request->evaluado_criterio_3_2) and !isset($request->evaluado_criterio_3_3)){ 
                $arreglo['eps_3_1'] = $this->ponderaciones_criterios['eps_3_2'] + $this->ponderaciones_criterios['eps_3_3'] + $request->eps_3_1;
            }
        }
       
        return $arreglo;
    }

    public function generarMensajesValidacion($criterio, $mensaje, $reglas_validacion){
        $reglas = explode("|", $reglas_validacion);
                
        foreach($reglas as $regla){
            if($regla == "required"){
                $this->mensajes_validacion[$criterio.".required"] = $mensaje . "es obligatorio";
            }
            if($regla == "numeric"){
                $this->mensajes_validacion[$criterio.".numeric"] = $mensaje . "debe ser un número";
            }
            if(str_contains($regla, "max")){
                $max = explode(":", $regla);
                $this->mensajes_validacion[$criterio.".max"] = $mensaje . " no debe ser mayor a " . $max[1];
            }
            if(str_contains($regla, "min")){
                $min = explode(":", $regla);
                $this->mensajes_validacion[$criterio.".min"] = $mensaje . " no debe ser menor a " . $min[1];
            }
        }
        return $this->mensajes_validacion;
    }


}
