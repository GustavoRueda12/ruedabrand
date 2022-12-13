@extends('layouts.app')

@section('content')
    <div class="contenido">
        @include('components.flash_alerts')
        <h1 class="mb-5 mt-4" style="align-items: center;display: flex;flex-direction: column;font-weight: bold;">CAMBIAR CONTRASEÑA </h1>
        <div>
            <div>
                <form method="POST" action="{{ route('cambiarPassword') }}">
                    @csrf
                    @method('PUT')

                    <div class="row mb-3 justify-content-center">
                        <div class="col-md-6">
                            <div class="form-group form-floating mb-3">
                                <input type="password" class="form-control" name="oldPassword" value="{{ old('oldPassword') }}" placeholder="Contraseña anterior">
                                <label for="floatingName">Contraseña anterior</label>
                                @if ($errors->has('oldPassword'))
                                    <span class="text-danger" style="float: left;text-align: left;">{{ $errors->first('oldPassword') }}</span>
                                    <br>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3 justify-content-center">
                        <div class="col-md-6">
                            <div class="form-group form-floating mb-3">
                                <input type="password" class="form-control" name="password" value="{{ old('password') }}" placeholder="Contraseña nueva">
                                <label for="floatingName">Contraseña nueva</label>
                                @if ($errors->has('password'))
                                    <span class="text-danger" style="float: left;text-align: left;">{{ $errors->first('password') }}</span>
                                    <br>
                                @endif
                            </div>
                        </div>
                    </div>


                    <div class="row mb-3 justify-content-center">
                        <div class="col-md-6">
                            <div class="form-group form-floating mb-3">
                                <input type="password" class="form-control" name="password_confirmation" value="{{ old('password_confirmation') }}" placeholder="Confirmar contraseña nueva">
                                <label for="floatingName">Confirmar contraseña nueva</label>
                                @if ($errors->has('password_confirmation'))
                                    <span class="text-danger" style="float: left;text-align: left;">{{ $errors->first('password_confirmation') }}</span>
                                    <br>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <button id="buttomLogin" type="submit" class="btn">
                                Cambiar contraseña
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>

    </div>
@endsection

@section('scripts')
    <script>
        var title =document.head.querySelector("title").innerHTML='CAMBIAR CONTRASEÑA - R🗲';
    </script>

@endsection
