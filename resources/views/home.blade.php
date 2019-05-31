@extends('layouts.layout')
@section('content')
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Nombre</th>
                <th scope="col">#</th>
                <th scope="col">Localidad</th>
                <th scope="col">Provinica</th>
                <th scope="col">Latitud</th>
                <th scope="col">Longitud</th>
                <th scope="col">Altura</th>
                <th scope="col">Ubicaciòn</th>
                <th scope="col">Tipo</th>
            </tr>            
        </thead>
        <tbody>
            @foreach ($stations as $station)
                <tr>
                    <th scope="col">{{ $station->name }}</th>
                    <th scope="col"><a href="{{ route('in_construction', $station->id) }}" class=""> Ver histórico</a></th>
                    <th scope="col">{{ $station->locality }}</th>
                    <th scope="col">{{ $station->province }}</th>
                    <th scope="col">{{ $station->latitude }}</th>
                    <th scope="col">{{ $station->longitude }}</th>
                    <th scope="col">{{ $station->height }}</th>
                    <th scope="col">{{ $station->location }}</th>
                    <th scope="col">{{ $station->type }}</th>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $stations->links() }}
@endsection
                    


