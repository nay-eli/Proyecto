@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Genera Ordenes</h1>
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
</div>
@endsection

