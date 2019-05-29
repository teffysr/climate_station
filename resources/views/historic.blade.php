@extends('layouts.layout')
@section('content')
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Fecha</th>
                <th scope="col">##</th>
                <th scope="col">##</th>
                <th scope="col">##</th>
            </tr>            
        </thead>
        <tbody>
            @foreach ($stationValue as $value)
                <tr>
                    <th scope="col">{{ $value->id }}</th>
                    <th scope="col">##</th>
                    <th scope="col">##</th>
                    <th scope="col">##</th>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('home') }}" class="btn btn-info"> << Volver</a>
@endsection