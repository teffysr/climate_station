@extends('layouts.layout')
@section('content')
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
                    <th scope="col">{{ $percentage->short_name }}</th>
                    <th scope="col">{{ $percentage->value }}</th>
                    <th scope="col">{{ $percentage->value2 }}</th>
                    <th scope="col"></th>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('percentage') }}" class="btn btn-info"> << Volver</a>
@endsection