@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">&nbsp;</div>
        <div class="panel-body">
          {!! Form::open( [
              'url'     => action( 'RoutesController@update', [
                'id'      => ''
              ] ),
              'method'  => 'POST',
              'class'   => 'form-horizontal',
            ] ) !!}

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
              {!! Form::label( 'email', 'Cantidad de conductores y clientes', [
                'class' => 'col-md-4 control-label'
              ] ) !!}

              <div class="col-md-6">
                {!! Form::number( 'driver', old( 'driver' ), [
                  'id'        => 'driver',
                  'class'     => 'form-control',
                  'required'  => 'required',
                  'autofocus' => 'autofocus',
                  'min'       => '1',
                  'max'       => '100',
                  'step'      => '1',
                ] ) !!}

                @if ( $errors->has( 'email' ) )
                  <span class="help-block">
                    <strong>{{ $errors->first( 'email' ) }}</strong>
                  </span>
                @endif
              </div>
            </div>

            <div class="form-group{{ $errors->has( 'password' ) ? ' has-error' : '' }}">
              {!! Form::label( 'password', 'Password', [
                'class' => 'col-md-4 control-label'
              ] ) !!}

              <div class="col-md-6">
                {!! Form::password( 'password', [
                  'id'        => 'password',
                  'class'     => 'form-control',
                  'required'  => 'required'
                ] ) !!}

                @if ( $errors->has( 'password' ) )
                  <span class="help-block">
                    <strong>{{ $errors->first( 'password' ) }}</strong>
                  </span>
                @endif
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-8 col-md-offset-4">
                {!! Form::submit( 'Iniciar', [
                  'class' => 'btn btn-primary'
                ] ) !!}

                {!! Form::button( 'Pausar', [
                  'class' => 'btn btn-secondary'
                ] ) !!}
              </div>
            </div>
          {!! Form::close() !!}
          <table class="table table-striped">

          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
