<!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Ticket de Compra</title>
    </head>
    <body>
    <div class="container" style="font-family: system-ui;">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div>
                        @auth
                        @hasrole('admin')
                        <img src="../public/assets/img/logo/LOGOR_page-0001.jpg" alt="logo" style="height: 90px; text-align: center">
                    <h1 class="mb-5" style="align-items: center;display: flex;flex-direction: column;font-weight: bold;">Venta {{$purchaseDate}}</h1>
                    @else
                        <img src="../public/assets/img/logo/LOGOR_page-0001.jpg" alt="logo" style="height: 90px; text-align: center">

                        <h2 class="mb-5" style="align-items: center;display: flex;flex-direction: column;font-weight: bold;">Compra {{$purchaseDate}}</h2>
                        @endhasrole
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
    @endauth
    </body>
    </html>

