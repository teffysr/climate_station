@extends('layouts.layout')
@section('content')
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Nombre</th>
                <th scope="col">#</th>
                <th scope="col">#</th>
                <th scope="col">#</th>
            </tr>            
        </thead>
        <tbody>
            @foreach ($stations as $station)
                <tr>
                    <th scope="col">{{ $station->name }}</th>
                    <th scope="col"><a href="{{ route('in_construction', $station->id) }}" class=""> Ver histórico</a></th>
                    <th scope="col">-</th>
                    <th scope="col">-</th>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $stations->links() }}
@endsection
                    


