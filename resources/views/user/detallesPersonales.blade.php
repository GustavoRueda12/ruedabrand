@extends('layouts.app')

@section('content')
    <div class="contenido">
    @include('components.flash_alerts')
        <h1 class="mb-5 mt-4" style="align-items: center;display: flex;flex-direction: column;font-weight: bold;">DATOS PERSONALES</h1>
        <div>
            <div>
                <form method="POST" id="miForm" action="{{ route('updateProfile') }}">
                    @csrf
                    @method('PUT')
                    <div class="row mb-3 justify-content-center">
                        <div class="col-md-6">
                            <div class="form-group form-floating mb-3">
                                <input type="text" class="form-control" name="name" value="{{ Auth::user()->name }}" placeholder="Nombre" required="required">
                                <label for="floatingName">Nombre</label>
                                @if ($errors->has('name'))
                                    <span class="text-danger" style="float: left;text-align: left;">{{ $errors->first('name') }}</span>
                                    <br>
                                @endif
                            </div>
                        </div>
                    </div>


                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div class="form-group form-floating mb-3">
                                <input type="text" class="form-control" name="surname" value="{{ Auth::user()->surname }}" placeholder="Apellidos" required="required">
                                <label for="floatingName">Apellidos</label>
                                @if ($errors->has('surname'))
                                    <span class="text-danger" style="float: left;text-align: left;">{{ $errors->first('surname') }}</span>
                                    <br>
                                @endif
                            </div>
                        </div>
                    </div>

                    <h5 class="mb-5 mt-4" style="align-items: center;display: flex;flex-direction: column;font-weight: bold;">DIRECCIÓN DE ENTREGA POR DEFECTO</h5>


                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div class="form-group form-floating mb-3">
                                <input type="text" class="limpiar form-control" name="direccion" value="{{ Auth::user()->direccion }}" placeholder="Dirección" >
                                <label for="floatingName">Dirección</label>
                                @if ($errors->has('direccion'))
                                    <span class="text-danger" style="float: left;text-align: left;">{{ $errors->first('direccion') }}</span>
                                    <br>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div class="form-group form-floating mb-3">
                                <input type="text" class="limpiar form-control" name="codigoPostal" value="{{ Auth::user()->codigoPostal }}" placeholder="Código postal" >
                                <label for="floatingName">Código postal</label>
                                @if ($errors->has('codigoPostal'))
                                    <span class="text-danger" style="float: left;text-align: left;">{{ $errors->first('codigoPostal') }}</span>
                                    <br>
                                @endif
                            </div>
                        </div>
                    </div>


                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div class="form-group form-floating mb-3">
                                <input type="text" class="limpiar form-control" name="localidad" value="{{ Auth::user()->localidad }}" placeholder="Localidad" >
                                <label for="floatingName">Localidad</label>
                                @if ($errors->has('localidad'))
                                    <span class="text-danger" style="float: left;text-align: left;">{{ $errors->first('localidad') }}</span>
                                    <br>
                                @endif
                            </div>
                        </div>
                    </div>


                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div class="form-group form-floating mb-3">
                                <input type="text" class="limpiar form-control" name="pais" value="{{ Auth::user()->pais }}" placeholder="País" >
                                <label for="floatingName">País</label>
                                @if ($errors->has('pais'))
                                    <span class="text-danger" style="float: left;text-align: left;">{{ $errors->first('pais') }}</span>
                                    <br>
                                @endif
                            </div>
                        </div>
                    </div>


                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div class="form-group form-floating mb-3">
                                <input type="text" class="limpiar form-control" name="telefono" value="{{ Auth::user()->telefono }}" placeholder="Teléfono" >
                                <label for="floatingName">Teléfono</label>
                                @if ($errors->has('telefono'))
                                    <span class="text-danger" style="float: left;text-align: left;">{{ $errors->first('telefono') }}</span>
                                    <br>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-center mb-3">
                        <div class="col-md-6">
                            <input type="button" onclick="limpiarFormulario()" id="buttomRegister" class="btn" value=" Limpiar">
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <button id="buttomLogin" type="submit" class="btn">
                                Guardar Cambios
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
        var title =document.head.querySelector("title").innerHTML='DATOS PERSONALES - R🗲';
    </script>

    <script>
        function limpiarFormulario() {
            document.querySelectorAll('.limpiar').forEach(i => {
                i.value = "";
            })
        }
    </script>
@endsection
