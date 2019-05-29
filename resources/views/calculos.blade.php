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
      		<option>1</option>
      		<option>2</option>
    	</select>
  	</div>
</form>

    <a href="{{ route('home') }}" class="btn btn-info"> << Volver</a>
@endsection