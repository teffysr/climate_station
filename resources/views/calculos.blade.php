@extends('layouts.layout')
@section('content')
<form>
  <!--<div class="form-group">
    <label for="exampleFormControlInput1">Email address</label>
    <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
  </div>-->
	<div class="form-group">
		<label for="station">Seleccione Estación</label>
    	<select class="form-control" id="station">
        @foreach($stations as $s)
      		<option value="{{ $s->id }}">{{ $s->name }}</option>
        @endforeach  
    	</select>
  	</div>
    <div class="row">
      <div class="col-md-6">
        <label for="station">Factor 1</label>
        <div class="input-group input-group-sm mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-sm">F1</span>
          </div>
          <input type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
        </div>
      </div>
      <div class="col-md-6">
        <label for="station">Factor 2</label>
        <div class="input-group input-group-sm mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-sm">F2</span>
          </div>
          <input type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
        </div>
      </div>
    </div>
</form>

    <a href="{{ route('home') }}" class="btn btn-info"> << Volver</a>
@endsection