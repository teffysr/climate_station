@extends('layouts.layout')
@section('content')
<form method="POST" action="{{ route('storecalculo') }}">
  <button type="submit" class="btn btn-primary">Procesar información</button>
  @csrf
	<div class="form-group">
		<label for="station">Seleccione Estación</label>
    	<select class="form-control" id="station" name="station">
        @foreach($stations as $s)
      		<option value="{{ $s->id }}">{{ $s->name }}</option>
        @endforeach  
    	</select>
  </div>
    <div class="row form-group">
      <div class="col-md-6">
        <label for="">Factor 1</label>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <label class="input-group-text" for="inputGroupSelect01">F1</label>
          </div>
          <select class="custom-select" id="inputGroupSelect01" name="f1">
            <option selected>Seleccione...</option>
            @foreach($f1 as $factor1)
            <option value="{{ $factor1->id }}" {!! $request['f1']==$factor1->id?'selected':'' !!}>{{ $factor1->name }}</option>
            @endforeach 
          </select>
        </div>
        <div class="card">
            <div class="card-header">Valores Factor 1</div>
            <div class="card-body">
              <table class="table">
                <tbody>
                  @if(!empty($data))
                    @foreach($data['f1'] as $key => $f1)
                      <tr>
                        <td>{!! $key !!}</td>
                        <td>{{ $f1 }}</td>
                      </tr>
                    @endforeach
                  @endif
                </tbody>
              </table>
            </div>
        </div>
      </div>

      <div class="col-md-6">
        <label for="station">Factor 2</label>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <label class="input-group-text" for="inputGroupSelect02">F2</label>
          </div>
          <select class="custom-select" id="inputGroupSelect02" name="f2">
            <option selected>Seleccione...</option>
             @foreach($f2 as $factor2)
            <option value="{{ $factor2->id }}" {!! $request['f2']==$factor2->id?'selected':'' !!}>{{ $factor2->name }}</option>
            @endforeach
          </select>
        </div>
        <div class="card">
            <div class="card-header">Valores Factor 2</div>
            <div class="card-body">
              <table class="table">
                <tbody>
                  @if(!empty($data))
                    @foreach($data['f2'] as $key => $f2)
                      <tr>
                        <td>{!! $key !!}</td>
                        <td>{{ $f2 }}</td>
                      </tr>
                    @endforeach
                  @endif
                </tbody>
              </table>
            </div>
        </div>
      </div>
    </div>
    <div class="row form-group">
      <div class="col-md-12">
        <div class="card">
            <div class="card-header">Tabla de Probabilidad</div>

            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                          <th scope="col">P(+x|U1,U2)</th>
                          @foreach($data['tdp'][0] as $key => $value)
                            <th scope="col">{!! $value !!}</th>
                          @endforeach
                        </tr>            
                    </thead>
                    <tbody>
                        @foreach($data['tdp'] as $key => $value)
                          @if($key != '0')
                            <tr>
                              <td>{!! $key !!}</td>
                              @foreach($value as $v1)
                                <td>{{ $v1 }}</td>
                              @endforeach
                            </tr>
                          @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-5">
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-default">Y1</span>
          </div>
          <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
        </div>
      </div>

      <div class="col-md-5">
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-default">Y2</span>
          </div>
          <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
        </div>
      </div>

      <div class="col-md-2">
        <div class="input-group mb-3">
          <button type="button" class="btn btn-primary">Calcular Y</button>
        </div>
      </div>
    </div>

    <div class="row form-group">
      <div class="col-md-6">
        <div class="card">
            <div class="card-header">Tabla de Factor1</div>

            <div class="card-body">
              <table class="table">
                <tbody>
                  <tr>
                    <td>Temperatura_Suelo_10cm_Media</td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>Valor Desviación</td>
                    <td>5.816648141124853</td>
                  </tr>
                  <tr>
                    <td>Valor Z1</td>
                    <td>-2.84</td>
                  </tr>
                  <tr>
                    <td>Valor Media:</td>
                    <td>17.543789819595645</td>
                  </tr>
                </tbody>
              </table>
            </div>
        </div>
      </div>

      <div class="col-md-6">
        <div class="card">
            <div class="card-header">Tabla de Factor2</div>

            <div class="card-body">
              <table class="table">
                <tbody>
                  <tr>
                    <td>Temperatura_Suelo_10cm_Media</td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>Valor Desviación</td>
                    <td>5.816648141124853</td>
                  </tr>
                  <tr>
                    <td>Valor Z1</td>
                    <td>-2.84</td>
                  </tr>
                  <tr>
                    <td>Valor Media:</td>
                    <td>17.543789819595645</td>
                  </tr>
                </tbody>
              </table>
            </div>
        </div>
      </div>

    </div>

        <div class="row form-group">
      <div class="col-md-6">
        <div class="card">
            <div class="card-header">Tabla de zeta</div>

            <div class="card-body">
              <table class="table">
                <tbody>
                  <tr>
                    <td>Temperatura_Suelo_10cm_Media</td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>ZETA 1</td>
                    <td>5.816648141124853</td>
                  </tr>
                  <tr>
                    <td>ZETA 2</td>
                    <td>-2.84</td>
                  </tr>
                  <tr>
                    <td>PORCENTAJE</td>
                    <td>17.8 %</td>
                  </tr>
                </tbody>
              </table>
            </div>
        </div>
      </div>
    </div>
</form>

    <a href="{{ route('home') }}" class="btn btn-info"> << Volver</a>
@endsection