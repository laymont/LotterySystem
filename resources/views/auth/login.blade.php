@extends('layouts.login')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-lg-4 mx-auto">
      <div class="card">
        <div class="card-header bg-info text-white"><h3> Acceso </h3></div>
        <div class="card-body">
          {!! Form::open(['route'=> 'login','method'=>'POST']) !!}

          <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
            {!! Form::label('email', 'Email', ['class'=>'control-label']) !!}
            {!! Form::email('email', null, ['class'=>'form-control','placeholder'=>'Email']) !!}
            @if ($errors->has('email'))
            <span class="help-block">
              <strong>{{ $errors->first('email') }}</strong>
            </span>
            @endif
          </div>

          <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
            {!! Form::label('password', 'Password', ['class'=>'control-label']) !!}
            {!! Form::password('password', ['class'=>'form-control']) !!}
            @if ($errors->has('password'))
            <span class="help-block">
              <strong>{{ $errors->first('password') }}</strong>
            </span>
            @endif
          </div>

          <div class="form-group">
            <div class="checkbox">
              <label>
                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Recuerdame
              </label>
            </div>
          </div>

          <div class="form-group">
            <button type="submit" class="btn btn-primary">
              Ingresar
            </button>

            {{-- <a class="btn btn-link" href="{{ route('password.request') }}">
              Olvido su Clave?
            </a> --}}
          </div>
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
