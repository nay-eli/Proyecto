@extends('layouts.app')
@section('content')
@php
function mesesTexto($nmes){
    $meses = [
        '1' => 'ENERO',
        '2' => 'FEBRERO',
        '3' => 'MARZO',
        '4' => 'ABRIL',
        '5' => 'MAYO',
        '6' => 'JUNIO',
        '7' => 'JULIO',
        '8' => 'AGOSTO',
        '9' => 'SEPTIEMBRE',
        '10' => 'OCTUBRE',
        '11' => 'NOVIEMBRE',
        '12' => 'DICIEMBRE'
    ];
    return isset($meses[$nmes]) ? $meses[$nmes] : 'Mes no válido';
}
@endphp
<script>
    $(document).on("click",".btn_delete",function(){
       if (confirm("Seguro desea eliminar?")){
        const secuencial=$(this).attr("secuencial");
        $("#secuencial").val(secuencial);
        $("#frmEliminar").submit();

     
       }
        
    })
</script>
<form action="{{route('eliminarOrden')}}"method="POST" id="frmEliminar">
    @csrf
    <input type="text" name="secuencial" id="secuencial" valvue="0">
</form>

<div class="container">
    <h1 class="text-center">Genera Ordenes</h1>
    <form action="{{route ('genera_ordenes') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col">
                <select name="anl_id" id="anl_id" class="form-control">
                    @foreach ($periodos as $p)
                    <option value="{{$p->id}}">{{$p->anl_descripcion}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col">
                <select name="jor_id" id="jor_id" class="form-control">
                    @foreach ($jornadas as $j)
                    <option value="{{$j->id}}">{{$j->jor_descripcion}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col">
                <select name="mes" id="mes" class="form-control">
                    @foreach ($meses as $key=>$m)
                    <option value="{{$key}}">{{$m}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col">
                <button type="submit" class="btn btn-primary">Generar</button>
            </div>
        </div>
    </form>

    <table class="table">
                    <tr>
                        <th>Ordenes Generadas</th>
                    </tr>
                    <tr>
                        <th>Secuencial</th>
                        <th>Fecha</th>
                        <th>Año Lectivo</th>
                        <th>Jornada</th>
                        <th>Mes</th>
                        <th>Acciones</th>
                    </tr>
                    @foreach($ordenes as $o )
                    <tr>
                        <td> {{$o->secuencial}} </td>
                        <td> {{$o->fecha_registro}} </td>
                        <td> {{$o->anl_descripcion}} </td>
                        <td> {{$o->jor_descripcion}} </td>
                        <td> {{mesesTexto($o->mes)}} </td>
                        <td>
                        <a hreaf="" class="btn btn-info btn-sm">Ver</a>
                    <a hreaf="" class="btn btn-danger btn-sm btn_delete" secuencial="{{$o->secuencial }}">Eliminar</a>
</td>
                    </tr>
                   

                    @endforeach    
     </table>

</div>
@endsection

