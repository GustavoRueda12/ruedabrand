@extends('layouts.app')

@section('content')
    <div class="bg-light">
        <div class="container">
                @include('components.flash_alerts')
                <h1 class="mb-5">PRODUCTOS COMPRADOS</h1>
                <div class="contenedorProducto">

                    <div>
                        <div style="display:flex;">
                            <a href="{{ route('pdf.generate',$id_purchase) }}" class="mb-4">
                                <svg width="30" height="30" x="0" y="0" viewBox="0 0 482.14 482.14" class="">

                                    <path d="M142.024,310.194c0-8.007-5.556-12.782-15.359-12.782c-4.003,0-6.714,0.395-8.132,0.773v25.69c1.679,0.378,3.743,0.504,6.588,0.504C135.57,324.379,142.024,319.1,142.024,310.194z" fill="#000000" data-original="#000000" class=""></path>
                                    <path d="M202.709,297.681c-4.39,0-7.227,0.379-8.905,0.772v56.896c1.679,0.394,4.39,0.394,6.841,0.394c17.809,0.126,29.424-9.677,29.424-30.449C230.195,307.231,219.611,297.681,202.709,297.681z" fill="#000000" data-original="#000000" class=""></path>
                                    <path d="M315.458,0H121.811c-28.29,0-51.315,23.041-51.315,51.315v189.754h-5.012c-11.418,0-20.678,9.251-20.678,20.679v125.404
                                                    c0,11.427,9.259,20.677,20.678,20.677h5.012v22.995c0,28.305,23.025,51.315,51.315,51.315h264.223
                                                    c28.272,0,51.3-23.011,51.3-51.315V121.449L315.458,0z M99.053,284.379c6.06-1.024,14.578-1.796,26.579-1.796
                                                    c12.128,0,20.772,2.315,26.58,6.965c5.548,4.382,9.292,11.615,9.292,20.127c0,8.51-2.837,15.745-7.999,20.646
                                                    c-6.714,6.32-16.643,9.157-28.258,9.157c-2.585,0-4.902-0.128-6.714-0.379v31.096H99.053V284.379z M386.034,450.713H121.811
                                                    c-10.954,0-19.874-8.92-19.874-19.889v-22.995h246.31c11.42,0,20.679-9.25,20.679-20.677V261.748
                                                    c0-11.428-9.259-20.679-20.679-20.679h-246.31V51.315c0-10.938,8.921-19.858,19.874-19.858l181.89-0.19v67.233
                                                    c0,19.638,15.934,35.587,35.587,35.587l65.862-0.189l0.741,296.925C405.891,441.793,396.987,450.713,386.034,450.713z
                                                     M174.065,369.801v-85.422c7.225-1.15,16.642-1.796,26.58-1.796c16.516,0,27.226,2.963,35.618,9.282
                                                    c9.031,6.714,14.704,17.416,14.704,32.781c0,16.643-6.06,28.133-14.453,35.224c-9.157,7.612-23.096,11.222-40.125,11.222
                                                    C186.191,371.092,178.966,370.446,174.065,369.801z M314.892,319.226v15.996h-31.23v34.973h-19.74v-86.966h53.16v16.122h-33.42
		                                            v19.875H314.892z" fill="#000000" data-original="#000000" class=""></path>
                                </svg>
                            </a>
                            <p style="font-size: 19px;font-weight: 300;">Descargar ticket de compra</p>
                        </div>

                        @foreach($products as $product)
                            <div  style="display:flex;">
                                <div style="width: 10%;min-width: 95px;margin-right: 18px;">
                                    <a href="{{route('clothe',$clothes->firstWhere('id',$product->clothe_id)->clothe_name)}}">
                                        <img style="width: 100%;" src="{{$clothes->firstWhere('id',$product->clothe_id)->getMedia()->first() !== null ? $clothes->firstWhere('id',$product->clothe_id)->getMedia()->first()->getFullUrl('thumb') : 'https://brunosmoda.com/wp-content/uploads/2021/01/CAMISETA-NEGRA-LISA-HOMBRE-10043675_000-5.jpg'}}">
                                    </a>

                                </div>
                                <div style="width: 100%;">
                                    <div style="display: flex;justify-content: space-between;width: 100%">
                                        <a href="{{route('clothe',$clothes->firstWhere('id',$product->clothe_id)->clothe_name)}}" style="font-size:15px;text-decoration: none;color: black"><p><b>{{$clothes->firstWhere('id',$product->clothe_id)->clothe_name}}</b></p></a>
                                    </div>

                                    <div style="display: flex;">
                                        <p style="margin-right: 5%">talla = {{$product->size}}</p>
                                        <p>cantidad = {{$product->amount}}</p>
                                    </div>
                                    <p data-price="{{($product->unitary_price)*$product->amount}}" class="precios" >Precio Unidad = {{$product->unitary_price}}€</p>
                                    <p data-price="{{($product->unitary_price)*$product->amount}}" class="precios" >Precio Conjunto = {{($product->unitary_price)*$product->amount}}€</p>
                                </div>

                            </div>
                            <hr class="mb-5">
                        @endforeach
                            <p class="precios"> <b>PRECIO TOTAL</b> = {{$purchase->firstWhere('id',$id_purchase)->total_price}}€</p>
                    </div>
                </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        var title =document.head.querySelector("title").innerHTML='PRODUCTOS COMPRADOS - R🗲';
    </script>

@endsection
