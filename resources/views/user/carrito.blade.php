@extends('layouts.app')

@section('content')
    <div class="bg-light">
        <div class="container">

            @if($cart->isEmpty())
                @include('components.flash_alerts')
                <h1 class="mb-5" style="text-align: center">CARRITO</h1>
            <div style="text-align: center">
                <svg xmlns="http://www.w3.org/2000/svg" width="96" height="96" viewBox="0 0 96 96"><path fill="#D0D0D0" d="M83.4797 31.5228H67.1466V19.7848C67.203 17.3028 66.7556 14.8352 65.8315 12.531C64.9074 10.2267 63.5258 8.13377 61.7701 6.37848C60.0145 4.62319 57.9212 3.24202 55.6168 2.31842C53.3124 1.39482 50.8446 0.947954 48.3626 1.00482C45.881 0.948502 43.4137 1.39577 41.1098 2.31962C38.8058 3.24347 36.713 4.62472 34.9578 6.37995C33.2026 8.13519 31.8213 10.228 30.8975 12.5319C29.9736 14.8359 29.5263 17.3032 29.5826 19.7848V31.5228H13.2466L11.0056 87.5798C10.9677 88.5276 11.1216 89.4733 11.4581 90.3602C11.7946 91.2471 12.3069 92.0568 12.9641 92.7408C13.6213 93.4248 14.4099 93.969 15.2826 94.3407C16.1553 94.7124 17.0941 94.9039 18.0426 94.9038H78.8837C79.8158 94.8999 80.738 94.7117 81.5972 94.35C82.4563 93.9883 83.2355 93.4603 83.8898 92.7963C84.5441 92.1324 85.0606 91.3456 85.4097 90.4812C85.7587 89.6168 85.9334 88.692 85.9237 87.7598L83.4797 31.5228ZM34.2826 19.7848C34.2406 17.9241 34.576 16.0741 35.2686 14.3465C35.9612 12.619 36.9967 11.0497 38.3126 9.73333C39.6284 8.417 41.1974 7.38095 42.9247 6.68771C44.652 5.99447 46.5019 5.65841 48.3626 5.69982C50.2242 5.65717 52.075 5.99232 53.8034 6.68501C55.5318 7.3777 57.1018 8.41356 58.4186 9.73001C59.7354 11.0465 60.7717 12.6162 61.4649 14.3444C62.1581 16.0725 62.4938 17.9233 62.4516 19.7848V31.5228H34.2826V19.7848ZM78.8827 90.2078H18.0416C17.7254 90.2078 17.4125 90.1439 17.1216 90.0199C16.8307 89.896 16.5679 89.7145 16.3489 89.4864C16.1299 89.2584 15.9592 88.9884 15.8471 88.6927C15.735 88.397 15.6839 88.0818 15.6966 87.7658L17.7626 36.2168H29.5866V45.6078H34.2866V36.2168H62.4516V45.6078H67.1516V36.2168H78.9827L81.2317 87.8618C81.2301 88.4839 80.9821 89.08 80.5421 89.5196C80.102 89.9593 79.5047 90.2068 78.8827 90.2078Z"></path> <path fill="#D0D0D0" fill-rule="evenodd" clip-rule="evenodd" d="M45.9605 63.0655V55.5918H50.9605V63.0655H58.4342V68.0655H50.9605V75.5392H45.9605V68.0655H38.4938V63.0655H45.9605Z"></path></svg>
            </div>
                <h1>Su carrito parece que está vacío</h1>
            <p style="text-align: center">Agregue artículos a su carrito.</p>
                <a class="btn" id="buttomLogin" href="{{route('home')}}">Seguir Comprando</a>
            @else
                @include('components.flash_alerts')
                <h1 class="mb-5">CARRITO</h1>
                <div class="contenedorProducto">


                    <div>
                        @foreach($cart as $car)
                            <div  style="display:flex;">
                                <div style="width: 10%;min-width: 95px;margin-right: 18px;">
                                    <a href="{{route('clothe',$clothes->firstWhere('id',$car->clothe_id)->clothe_name)}}">
                                        <img style="width: 100%;" src="{{$clothes->firstWhere('id',$car->clothe_id)->getMedia()->first() !== null ? $clothes->firstWhere('id',$car->clothe_id)->getMedia()->first()->getFullUrl('thumb') : 'https://brunosmoda.com/wp-content/uploads/2021/01/CAMISETA-NEGRA-LISA-HOMBRE-10043675_000-5.jpg'}}">
                                    </a>

                                </div>
                                <div style="width: 100%;">
                                    <div style="display: flex;justify-content: space-between;width: 100%">
                                        <a href="{{route('clothe',$clothes->firstWhere('id',$car->clothe_id)->clothe_name)}}" style="font-size:15px;text-decoration: none;color: black"><p><b>{{$clothes->firstWhere('id',$car->clothe_id)->clothe_name}}</b></p></a>

                                        <a href="{{route('remove_from_cart',[$car->id])}}" style="color: red;font-weight: 700;text-decoration: none;font-size: 20px">X</a>
                                    </div>

                                    <div style="display: flex;">
                                        <p style="margin-right: 5%">talla = {{$car->talla}}</p>
                                        <p>cantidad = {{$car->unidades}}</p>
                                    </div>
                                    <p data-price="{{($clothes->firstWhere('id',$car->clothe_id)->price)*$car->unidades}}" class="precios" >{{($clothes->firstWhere('id',$car->clothe_id)->price)*$car->unidades}}€</p>
                                </div>

                            </div>
                            <hr class="mb-5">
                        @endforeach
                    </div>

                    <div style="width: 100%;">
                        <form method="POST" action="{{route('comprar')}}">
                            @csrf
                            @method('PUT')
                        <div class="precioTotal" style="display: flex;justify-content: space-between;width: 100%;">
                            <p style="font-size: 20px">Total</p>
                            <p style="font-size: 20px" id="precioTotal">{{$clothes->firstWhere('id',$car->clothe_id)->price}}€</p>
                        </div>
                            <input type="hidden" id="precioFinal" name="precioTotal" value="">
                        <div>
                            <button type="submit" id="buttomLogin" style="width: 100%; min-width: 194px;font-size: 17px;margin-bottom: 15px" class="finalizarComopra btn">Finalizar Pedido</button>
                        </div>
                        </form>
                    </div>


                </div>


            @endif
        </div>
    </div>
            @endsection

            @section('scripts')
                <script>
                    var title =document.head.querySelector("title").innerHTML='CARRITO - R🗲';
                </script>

                <script>
                    let resultado = 0.00;
                    document.querySelectorAll('.precios').forEach(p => {
                        resultado  += parseFloat(p.dataset.price);
                    })
                    document.querySelector('#precioTotal').innerText = resultado+'€';
                    document.querySelector('#precioFinal').value = resultado;

                </script>

@endsection
