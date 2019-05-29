@extends('layouts.layout')
@section('content')

@if(!empty($save_ok) && $save_ok == 1)
    <div class="alert alert-success"> Se han actualizado los valores con éxito </div>
@endif
<form action="/porcentajes/{{ $station }}/update" method="POST">
        @csrf
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Estación</th>
                <th scope="col">Valor A</th>
                <th scope="col">Valor B</th>
                <th scope="col"></th>
            </tr>            
        </thead>
        <tbody>
            @foreach ($station_percentage as $percentage)
                <tr>
                    <input type="hidden" name="id[]" value="{{ $percentage->id }}">
                    <th scope="col"><input type="text" name="{{ $percentage->id.'_name' }}" value="{{ $percentage->short_name }}" readonly="true" style="border: none;"></th>
                    <th scope="col"><input type="text" name="{{ $percentage->id.'_a' }}" value="{{ $percentage->value }}" style="border: none;"></th>
                    <th scope="col"><input type="text" name="{{ $percentage->id.'_b' }}" value="{{ $percentage->value2 }}" style="border: none;"></th>
                    <th scope="col"></th>
                </tr>
            @endforeach
        </tbody>
    </table>
    <button type="submit" class="btn btn-primary">Guardar</button>
</form>
    <a href="{{ route('percentage') }}" class="btn btn-info mt-5"> << Volver</a>
@endsection