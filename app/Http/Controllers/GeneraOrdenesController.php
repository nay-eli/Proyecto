<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GeneraOrdenes;
use DB;
use Auth;

class GeneraOrdenesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $rq)

    {
        $periodos=DB::select("SELECT * FROM aniolectivo");
        $jornadas=DB::select("SELECT * FROM jornadas");
        $ordenes=DB::select("SELECT o.secuencial,o.fecha_registro,j.jor_descripcion,o.mes,a.anl_descripcion
                             FROM ordenes_generadas o
                             JOIN matriculas m ON m.id=o.mat_id
                             JOIN jornadas j ON j.id=m.jor_id
                             JOIN aniolectivo a ON a.id=m.anl_id
                             GROUP BY o.secuencial,
                             o.fecha_registro,
                             j.jor_descripcion,
                             o.mes,
                             a.anl_descripcion
                             ORDER BY o.secuencial 
                             ");
        $meses=$this->meses();

        return view('generaordenes.index')
        ->with('periodos',$periodos)
        ->with('jornadas',$jornadas)
        ->with('meses',$meses)
        ->with('ordenes',$ordenes)

    

        ;


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function meses(){
        return [
        '1'=>'ENERO',
        '2'=>'FEBRERO',
        '3'=>'MARZO',
        '4'=>'ABRIL',
        '5'=>'MAYO',
        '6'=>'JUNIO',
        '7'=>'JULIO',
        '8'=>'AGOSTO',
        '9'=>'SEPTIEMBRE',
        '10'=>'OCTUBRE',
        '11'=>'NOVIEMBRE',
        '12'=>'DICIEMBRE',



        ];
    }
    public function mesesLetra($nmes){
        $result="";
        switch($nmes){
            case 1: $result="E"; break;
            case 2: $result="F"; break;
            case 3: $result="M"; break;
            case 4: $result="A"; break;
            case 5: $result="MY"; break;
            case 6: $result="J"; break;
            case 7: $result="JL"; break;
            case 8: $result="AG"; break;
            case 9: $result="S"; break;
            case 10: $result="O"; break;
            case 11: $result="N"; break;
            case 12: $result="D"; break;
            return $result;    


        }
       // $nmes==1?$result="E":"";
       // $nmes==2?$result="F":"";
        //$nmes==3?$result="M":"";
       


        //if($nmes==1){
           // $result="E";

       // }

    }
    public function genera_ordenes(Request $rq){
        $datos = $rq->all();
        $anl_id = $datos['anl_id']; /// año lectivo
        $jor_id = $datos['jor_id']; /// jornadas
        $mes = $datos['mes']; /// mes
        $nmes=$this->mesesLetra($mes);
        $campus="G";

        $validar = DB::select("
        SELECT * FROM ordenes_generadas AS o
        JOIN matriculas AS m ON m.id = o.mat_id
        WHERE m.anl_id = $anl_id
        AND m.jor_id = $jor_id
        AND o.mes = $mes
    ");
    
if(empty($validar)){

    $secuenciales = DB::selectone("SELECT max(secuencial)as secuencial from ordenes_generadas");
    $sec=$secuenciales->secuencial+1;
    $estuidantes = DB::select("SELECT *, m.id as mat_id FROM matriculas m
                           JOIN estudiantes e ON m.est_id = e.id
                           JOIN jornadas j ON m.jor_id = j.id
                           JOIN cursos c ON m.cur_id = c.id
                           JOIN especialidades es ON m.esp_id = es.id
                           WHERE m.anl_id =$anl_id 
                           AND m.jor_id = $jor_id 
                           AND m.mat_estado = 1
                           ");
        $valor_pagar=75;
        foreach($estuidantes as $e)
        {
                                $input['mat_id']=$e->mat_id;      ///ID de la matricula
                                $input['codigo']=$nmes.$campus.$e->jor_obs.$e->cur_obs.$e->esp_obs.'-'.$e->mat_id;      ///MGM3IF-6546
                                $input['fecha_registro']=date('Y-m-d');   
                                $input['valor_pagar']=$valor_pagar;
                                $input['fecha_pago']=null;
                                $input['valor_pagado']=0;
                                $input['estado']=0;     ///pendiente->0  pagado->1
                                $input['mes']=$mes;
                                $input['responsable']=Auth::user()->id;
                                $input['secuencial']=$sec; ///secuencial de la orden 
                                $input['documento']=null; 
                                GeneraOrdenes::create($input);
        }
        return Redirect(route('genera_ordenes.index'));
}else{
    dd("ya existe una orden generada con estos datos");

}
                             

    }
    public function eliminarOrden(Request $rq){
        $dt=$rq->all();
        $secuencial=$dt['secuencial'];
        $ordenes=GeneraOrdenes::where('secuencial',$secuencial)->delete();
        
        return Redirect(route('genera_ordenes.index'));
        

    }
}    