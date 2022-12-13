<?php

use App\Http\Controllers\PDFController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
Route::get('/', function () {
    return view('welcome');
});
*/


Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/es/politica-de-envios', [App\Http\Controllers\HomeController::class, 'envios'])->name('envios');

Route::get('/es/politica-de-cookies', [App\Http\Controllers\HomeController::class, 'cookies'])->name('cookies');

Route::get('/es/contacto', [App\Http\Controllers\HomeController::class, 'contacto'])->name('contacto');

Route::get('/es/condiciones-de-venta', [App\Http\Controllers\HomeController::class, 'condicionesDeVenta'])->name('condicionesDeVenta');

Route::get('/es/aviso-legal', [App\Http\Controllers\HomeController::class, 'avisoLegal'])->name('avisoLegal');

Route::get('/es/política-de-privacidad', [App\Http\Controllers\HomeController::class, 'politicaDePrivacidad'])->name('politicaDePrivacidad');

Route::get('/es/tallas', [App\Http\Controllers\HomeController::class, 'tallas'])->name('tallas');

Route::get('/es/recomendaciones-de-cuidado', [App\Http\Controllers\HomeController::class, 'recomendacionesDeCuidado'])->name('recomendacionesDeCuidado');

Route::get('/es/cuenta', [App\Http\Controllers\HomeController::class, 'cuenta'])->name('cuenta');

Route::get('/es/datos-personales', [App\Http\Controllers\HomeController::class, 'detallesPersonales'])->name('detallesPersonales');

Route::get('/es/coleccion-{collection_name}', [App\Http\Controllers\HomeController::class, 'coleccion'])->name('coleccion');

Route::get('/es/formulario-añadir-coleccion', [App\Http\Controllers\CollectionController::class, 'form'])->name('form_add_Collection');

Route::resource('collection', App\Http\Controllers\CollectionController::class);

Route::get('/es/borrar-coleccion/{collection}', [App\Http\Controllers\CollectionController::class,'destroy'])->name('destroyCollection');

Route::get('/habilitar-coleccion/{collection}', [App\Http\Controllers\CollectionController::class,'restore'])->name('restoreCollection');

Route::get('/es/editar-coleccion-{collection_name}', [App\Http\Controllers\CollectionController::class, 'editCollection'])->name('editCollection');

Route::get('/es/clothe-{clothe_name}', [App\Http\Controllers\CollectionController::class, 'clothe'])->name('clothe');

Route::get('/es/formulario-añadir-producto/{collection_name}', [App\Http\Controllers\ClotheController::class, 'form'])->name('form_add_Clothe');

Route::get('/es/borrar-producto/{clothe}/{collection_name}', [App\Http\Controllers\ClotheController::class,'destroy'])->name('destroyClothe');

Route::get('/habilitar-producto/{clothe}/{collection_name}', [App\Http\Controllers\ClotheController::class,'restore'])->name('restoreClothe');

Route::get('/es/editar-producto-{clothe_name}/{collection_name}', [App\Http\Controllers\ClotheController::class, 'editClothe'])->name('editClothe');

Route::get('/es/formulario-añadir-stock/{clothe_name}', [App\Http\Controllers\ClotheController::class, 'formStock'])->name('form_add_Stock');

Route::post('/es/formulario-añadir-stock', [App\Http\Controllers\ClotheController::class, 'stock'])->name('add_stock');

Route::resource('clothe', App\Http\Controllers\ClotheController::class);

Route::get('/es/carrito', [App\Http\Controllers\ClotheController::class, 'cart'])->name('cart');

Route::get('/es/añadir-producto-al-carrito-{clothe_name}', [App\Http\Controllers\ClotheController::class, 'add_to_cart'])->name('add_to_cart');

Route::get('/es/eliminar-producto-del-carrito-{cart_id}', [App\Http\Controllers\ClotheController::class, 'remove_from_cart'])->name('remove_from_cart');

Route::put('/es/comprar', [App\Http\Controllers\ClotheController::class,'comprar'])->name('comprar');

Route::get('/es/comprar/', [App\Http\Controllers\ClotheController::class,'comprar']);

Route::get('/es/relaizar-compra', [App\Http\Controllers\ClotheController::class,'realizar_compra'])->name('realizar_compra');

Route::get('/es/añadir-admin', [App\Http\Controllers\UsersController::class, 'formCreateAdmin'])->name('create_admin');

Route::get('/es/listado-usuarios', [App\Http\Controllers\UsersController::class, 'listadoUsuarios'])->name('listadoUsuarios');

Route::get('/es/listado-compras', [App\Http\Controllers\UsersController::class, 'listadoVentas'])->name('listadoVentas');

Route::get('/es/listado-productos/{idCompra}', [App\Http\Controllers\UsersController::class, 'listadoProductos'])->name('listadoProductos');

Route::get('/es/deshabiltar-Usuario/{user}', [App\Http\Controllers\UsersController::class,'destroy'])->name('destroy');

Route::get('/es/habilitar-Usuario/{user}', [App\Http\Controllers\UsersController::class,'restore'])->name('restore');

Route::delete('/es/borrar-Usuario/{user}', [App\Http\Controllers\UsersController::class,'forceDelete'])->name('forceDelete');

Route::get('/es/editar-Usuario/{user}', [App\Http\Controllers\UsersController::class,'edit'])->name('edit');

Route::put('/es/update-Usuario/{user}', [App\Http\Controllers\UsersController::class,'update'])->name('update');

Route::put('/es/update-Perfil', [App\Http\Controllers\UsersController::class,'updateProfile'])->name('updateProfile');

Route::get('/es/autenticacion/cambiar-la-contraseña', [App\Http\Controllers\UsersController::class, 'formcambiarPassword'])->name('formcambiarPassword');

Route::put('/es/cambiando-la-contraseña', [App\Http\Controllers\UsersController::class,'cambiarPassword'])->name('cambiarPassword');

Route::resource('user', App\Http\Controllers\UsersController::class);

Route::get('pdf/generar-ticket-de-compra/{id}', [PDFController::class, 'generatePDF'])->name('pdf.generate');

Route::get('pdf/generar-listado-usuarios', [PDFController::class, 'generatePDFListadoUsuarios'])->name('pdf.generateListadoUsuarios');

Route::get('pdf/preview', [PDFController::class, 'preview'])->name('pdf.preview');




