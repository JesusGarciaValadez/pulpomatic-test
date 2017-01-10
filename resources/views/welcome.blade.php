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
                'request' => '',
                'id'      => ''
              ] ),
              'method'  => 'POST',
              'class'   => 'form-horizontal',
            ] ) !!}

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
              {!! Form::label( 'email', 'E-Mail Address', [
                'class' => 'col-md-4 control-label'
              ] ) !!}

              <div class="col-md-6">
                {!! Form::email( 'email', old( 'email' ), [
                  'id'        => 'email',
                  'class'     => 'form-control',
                  'required'  => 'required',
                  'autofocus' => 'autofocus'
                ] ) !!}

                @if ( $errors->has( 'email' ) )
                  <span class="help-block">
                    <strong>{{ $errors->first( 'email' ) }}</strong>
                  </span>
                @endif
              </div>
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
              {!! Form::label( 'password', 'Password', [
                'class' => 'col-md-4 control-label'
              ] ) !!}

              <div class="col-md-6">
                {!! Form::password( 'password', '', [
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
              <div class="col-md-6 col-md-offset-4">
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="remember" {{ old( 'remember' ) ? 'checked' : '' }}> Remember Me
                  </label>
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-8 col-md-offset-4">
                {!! Form::submit( 'Login', '', [
                  'class' => 'btn btn-primary'
                ] ) !!}

                <a class="btn btn-link" href="{{ url( '/password/reset' ) }}">
                  Forgot Your Password?
                </a>
              </div>
            </div>
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
