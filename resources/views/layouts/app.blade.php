<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>R🗲</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="icon" href="logoR" />


    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>





    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])


    <style>

        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .navbar {
            width: 250px;
            height: 100vh;
            position: fixed;
            margin-left: -300px;
            background-color: navy;
            transition: 0.4s;
            z-index: -1;
        }

        .navbar-nav.w-100{
            display: flex;
            flex-direction: column;
            padding: 19px;
        }

        .nav-link{
            font-size: 1.25em;
        }

        .nav-link:active,.nav-link:focus,.nav-link:hover{
                background-color: rgba(0, 58, 128, 0.87);
        }

        .container{
            transition: 0.4s;
            margin-top: 20px;
        }

        .active-nav{
            margin-left: 0;
            z-index: 3;
        }

        ul.navbar-nav.d-flex.flex-colum.w-100 {
            padding-top: 98px;
        }

        .active-cont{
            filter: opacity(0.5);
        }



        #buttomLogin{
            background-color: navy;
            border-radius: 6px;
            color:honeydew;
            font-weight: bold;
            width: 100%;
            font-size: 152%;
        }

        #buttomLogin:hover{
            background-color: transparent;
            border-color: navy;
            color:navy;
        }

        #buttomRegister{
            border-radius: 6px;
            color:navy;
            border-color: navy;
            font-weight: bold;
            width: 100%;
            font-size: 152%;
        }

        #buttomRegister:hover{
            background-color: navy;
            border-radius: 6px;
            color:honeydew;
            font-weight: bold;
            width: 100%;
            font-size: 152%;
        }
        body{
            min-height: 100vh;
        }

        .lbl-menu{
            margin-left: 6px;
            width: 45px;
            height: 20px;
            position: relative;
            cursor: pointer;
            transform: scale(0.9);
        }
        .lbl-menu #spn1,#spn2,#spn3{
            position: absolute;
            content: '';
            background:#ffff;
            width: 30px;
            height: 2.2px;
            border-radius: 5px;
            transition: 0s;
        }

        #spn1{
            top: 4px;
        }
        #spn2{
            top: 12px;
        }
        #spn3{
            top: 20px;
        }
        #btn-menu{
            display: none;
        }
        #btn-menu:checked ~ .lbl-menu #spn1{
            transform: rotate(50deg);
            transform-origin: right;
            transition: 0.0s;
            width: 27px;
            top: 21px;
        }
        #btn-menu:checked ~ .lbl-menu #spn2{
            opacity: 0;
        }
        #btn-menu:checked ~ .lbl-menu #spn3{
            transform: rotate(-50deg);
            transition: 0.0s;
            transform-origin: right;
            width: 27px;
            top: 0;
        }

        .btn.btn-link{
            color: black;
            text-decoration: none;
        }

        .col-sm, .col-sm-4{
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 10px;
            position: relative;
        }

        .info{
            opacity: 1;
            transition: 0.4s;
        }

        .info h1{
           font-family: system-ui;
            max-width: 100%;
            font-size: 20px;
            height: 3em;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: black;
        }

        .infobox{
            position:relative;
            text-align: center;
        }



        .layoutFooter__inner{
            display: grid;
            align-items: baseline;
            padding-top: 54px;
        }

        @media only screen and (max-width: 1199px){
            .layoutFooter {
                padding-top: 2.5em;
                padding-bottom: 1em;
            }

            .layoutFooter__inner {
                grid-row-gap: 2.25em;
                row-gap: 2.25em;
            }

            .contenido{
                width: 80%;
            }
        }


        .layoutFooter__pages {
            display: grid;
            font-size: .75em;
            padding-left: 2rem;
            padding-right: 2rem;
        }

        @media only screen and (max-width: 659px){
            .layoutFooter__pages,.pago {
                text-align: center;
            }

        }

        @media only screen and (min-width: 660px) and (max-width: 899px){
            .layoutFooter__pages {
                grid-template-columns: repeat(3,1fr);
            }
            .pago{
                text-align: center;
            }
        }

        @media only screen and (min-width: 900px) and (max-width: 1199px){
            .layoutFooter__pages {
                grid-template-columns: repeat(5,1fr);
            }
            .pago{
                text-align: center;
            }

            .row{
                justify-content: center;
            }
        }

        @media only screen and (min-width: 1200px){
            .layoutFooter {
                padding-top: 2em;
                padding-bottom: 2em;
            }

            .row{
                justify-content: center;
            }

            .layoutFooter__pages {
                grid-template-columns: repeat(5,1fr);
            }

            .contenido {
                padding-left: 6.375em;
                padding-right: 6.375em;
                width: 80%;
            }

            .infobox{
                position:absolute;
                top:34%;
                left: 30%;
            }

            .info{
                background-color: white;
                opacity: 0;
            }

            .col-sm-4:hover .info{
                opacity: 1;
            }

            .info h1{
                width: 7em;
                height: 5em;
            }

            .contenedorProducto{
                display: flex;
                justify-content: space-between
            }

            .infoProcuto{
                padding-left: 186px;
            }

            .precioTotal,.finalizarComopra{
                margin-left: 15%;
            }

            .direccionDeEntrega{
                width: 818px;
            }


        }

@media only screen and (min-width: 1400px){
.infobox{
    position:absolute;
    top:34%;
    left: 33%;
}
    .row{
        justify-content: center;
    }
}




.layoutFooter__pages li {
overflow: hidden;
text-overflow: ellipsis;
white-space: nowrap;
padding: 0.375em 1em;
}

.layoutFooter__pages li a{
color: navy;
text-decoration: none;
}

.layoutFooter__item{
text-align: center;
}

.layoutFooter__copyright {
font-size: .75em;
text-align: center;
grid-row: 2;
color: navy;
}


main{
font-family: system-ui;
min-height: 100vh;
display: flex;
justify-content: center;
padding-top: 7.5rem !important;
padding-bottom: 1.5rem !important;
}

.imagen{
text-decoration: none;
}

.seleccionado{
    text-decoration: underline;
    text-underline-color: navy;
    font-weight: 700;
}

        .infoProcuto button.btn.agotado{
            color: #718096;
            background-color: #a0aec0;
            pointer-events: none;
        }

.tallas p{
    cursor: pointer;
}

.infoProcuto button.btn{
    background-color: navy;
    border-radius: 6px;
    color: honeydew;
    font-weight: bold;
}

.infoProcuto button.btn:hover{
    color: honeydew;
    background-color: navy;
}

        .infoProcuto button.btn:active{
            color: honeydew;
            background-color: #2323ec;
        }

        .infoProcuto button.btn.agotado:hover{
            color: #718096;
            background-color: #a0aec0;
        }

        .infoProcuto ul li a{
            text-decoration: none;
            font-weight: 700;
            color: black;
        }


</style>
</head>
<body>
    <div id="app">
        @include('design.partials.navbar')
        @include('design.partials.sidebar')
        <main class="mainContent">
            @yield('content')
        </main>
    </div>
    @include('design.partials.footer')
<script>


    var menu_btn = document.querySelector(".checar")
    var sidebar = document.querySelector("#sidebar")
    var container = document.querySelector(".mainContent")
    var footer = document.querySelector(".layoutContainer")

    menu_btn.addEventListener("click", () => {
        sidebar.classList.toggle("active-nav")
        container.classList.toggle("active-cont")
        footer.classList.toggle("active-cont")
    })

    container.addEventListener("click", () => {
        sidebar.classList.remove("active-nav")
        container.classList.remove("active-cont")
        footer.classList.remove("active-cont")
        menu_btn.checked = false
    })

    footer.addEventListener("click", () => {
        sidebar.classList.remove("active-nav")
        container.classList.remove("active-cont")
        footer.classList.remove("active-cont")
        menu_btn.checked = false
    })




</script>
@yield('scripts')
</body>
</html>
