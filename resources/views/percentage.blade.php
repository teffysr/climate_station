@extends('layouts.layout')
@section('content')
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Estación</th>
                <th scope="col">Ver porcentajes</th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>            
        </thead>
        <tbody>
            @foreach ($stations as $station)
                <tr>
                    <th scope="col">{{ $station->name }}</th>
                    <th scope="col"><a href="{{ route('percentage_value',$station->id) }}">Ver valores</a></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $stations->links() }}
@endsection