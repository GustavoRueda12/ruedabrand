@extends('layouts.app')

@section('content')
    @auth
        <div class="container" style="font-family: system-ui;">
            <div class="row">
                <div class="col-md-8">
                    <div>
                        @hasrole('admin')
                        <h1 class="mb-5" style="align-items: center;display: flex;flex-direction: column;font-weight: bold;">Listado Ventas</h1>
                        @else
                            <h1 class="mb-5" style="align-items: center;display: flex;flex-direction: column;font-weight: bold;">Mis Compras</h1>
                        @endhasrole
                        <div style="display: flex;align-items: center;">
                            @hasrole('admin')
                            <label style="margin-right: 4px"><b>Ventas entre</b></label>
                            @else
                            <label style="margin-right: 4px"><b>Compras entre</b></label>
                            @endhasrole
                            <input type="date" id="min" name="min">
                            <label style="margin-left: 4px;margin-right: 4px"><b>y</b></label>
                            <input type="date" id="max" name="max">
                            <button id="filter" class="btn btn-sm" style="background-color:navy;color: white;margin-left: 4px">Filtrar</button>
                        </div>

                        {{$dataTable->table()}}

                    </div>
                </div>
            </div>
        </div>
    @endauth
@endsection

@section('scripts')
    <script type="text/javascript">$(function(){window.LaravelDataTables=window.LaravelDataTables||{};window.LaravelDataTables["purchases-table"]=$("#purchases-table").DataTable({"serverSide":true,"processing":true,"ajax":{"url":"https:\/\/ruedabrand-production.up.railway.app\/es\/listado-compras","type":"GET","data":function(data) {
            for (var i = 0, len = data.columns.length; i < len; i++) {
                if (!data.columns[i].search.value) delete data.columns[i].search;
                if (data.columns[i].searchable === true) delete data.columns[i].searchable;
                if (data.columns[i].orderable === true) delete data.columns[i].orderable;
                if (data.columns[i].data === data.columns[i].name) delete data.columns[i].name;
            }
            delete data.search.regex;}},"columns":[{"data":"id","name":"id","title":"N\u00ba compra","orderable":true,"searchable":true},{"data":"direccion","name":"direccion","title":"Direccion","orderable":true,"searchable":true},{"data":"codigo_postal","name":"codigo_postal","title":"Codigo Postal","orderable":true,"searchable":true},{"data":"localidad","name":"localidad","title":"Localidad","orderable":true,"searchable":true},{"data":"pais","name":"pais","title":"Pais","orderable":true,"searchable":true},{"data":"telefono","name":"telefono","title":"Telefono","orderable":true,"searchable":true},{"data":"total_price","name":"total_price","title":"TOTAL","orderable":true,"searchable":true},{"data":"fecha_de_compra","name":"fecha_de_compra","title":"Fecha De Compra","orderable":true,"searchable":true,"className":"fechaCompra"},{"data":"action","name":"action","title":"VER PRODUCTOS","orderable":false,"searchable":false,"width":40,"className":"text-center"}],"dom":"Bfrtip","order":[[1,"desc"]],"select":{"style":"single"},"buttons":[{"extend":"excel"},{"extend":"csv"},{"extend":"pdf"},{"extend":"print"},{"extend":"reset"},{"extend":"reload"}]});});</script>
    @auth
        @hasrole('admin')
    <script>
        var title =document.head.querySelector("title").innerHTML='LISTADO VENTAS - R🗲';
    </script>
    @else
        <script>
            var title =document.head.querySelector("title").innerHTML='LISTADO COMPRAS - R🗲';
        </script>
        @endhasrole
    @endauth
    <script>
        $(document).on("click", "#filter", function(e) {
            e.preventDefault();
            var start_date = $("#min").val();
            var end_date = $("#max").val();
            if (start_date == "" || end_date == "") {
                alert("Por favor, introduzca ambas fechas");
            } else {
                var arrayFechaInicio = start_date.split("-");

                var fechaInicio = new Date(arrayFechaInicio[0],arrayFechaInicio[1],arrayFechaInicio[2]);

                var arrayFechaFin = end_date.split("-");

                var fechaFin = new Date(arrayFechaFin[0],arrayFechaFin[1],arrayFechaFin[2]);

                document.querySelectorAll('td.fechaCompra').forEach(fecha => {
                    var arrayFecha = fecha.innerText.split("/");

                   var fechaCompra = new Date(arrayFecha[2],arrayFecha[1],arrayFecha[0]);

                   console.log(fechaCompra);
                    console.log(fechaInicio);
                  if (fechaCompra.getTime()>=fechaInicio.getTime() && fechaCompra.getTime()<=fechaFin.getTime()){
                      $(fecha).parent().css('display','table-row');
                   }
                  else {
                      $(fecha).parent().css('display','none');
                   }

                })
            }
        });
    </script>
@endsection
