<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Clothe;
use App\Models\Collection;
use App\Models\Purchase;
use App\Models\PurchaseLines;
use App\Models\Size;
use App\Models\TypeSize;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClotheController extends Controller
{
    public function form($collection_name)
    {
        $collection = Collection::where('collection_name',$collection_name)->withTrashed()->first();
        return view('design.clothe.formularioAniadirProducto',['collection'=>$collection]);
    }

    public function formStock($clothe_name)
    {
        $clothe = Clothe::where('clothe_name',$clothe_name)->withTrashed()->first();
        return view('design.clothe.formularioAniadirStock',['clothe'=>$clothe]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'clothe_name' => ['required', 'string', 'max:255','unique:clothes'],
            'price' => ['required', 'numeric', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'avatar1' => ['required'],
            'avatar2' => ['required'],
        ]);

        Clothe::create([
            'collection_id' => $request['collection_id'],
            'clothe_name' => $request['clothe_name'],
            'description' => $request['description'],
            'price' => $request['price'],
        ]);

        if($request->hasFile('avatar1') && $request->file('avatar1')->isValid() && $request->hasFile('avatar2') && $request->file('avatar2')->isValid()){
            Clothe::where('clothe_name',$request['clothe_name'])->withTrashed()->first()->addMedia($request['avatar1'])->toMediaCollection();
            Clothe::where('clothe_name',$request['clothe_name'])->withTrashed()->first()->addMedia($request['avatar2'])->toMediaCollection();
        }


        return redirect()->route('coleccion',$request['collection_name'])
            ->with('message','Producto creado correctamente');
    }

    public function stock(Request $request)
    {
        $request->validate([
            'unidadesTallaS' => ['nullable','numeric'],
            'unidadesTallaM' => ['nullable','numeric'],
            'unidadesTallaL' => ['nullable','numeric'],
            'unidadesTallaXL' => ['nullable','numeric'],
        ]);



            if (!is_null($request['unidadesTallaS']) && is_null(Size::where('clothe_id',$request['clothe_id'])->where('type_size_id',1)->first()))
            Size::create([
                'clothe_id' => $request['clothe_id'],
                'stock' => $request['unidadesTallaS'],
                'type_size_id' => 1,
            ]);
            else{
                if (!is_null($request['unidadesTallaS'])){
                Size::where('clothe_id', $request['clothe_id'])->where('type_size_id',1)->first()->increment('stock',$request['unidadesTallaS']);
                }

            }


            if (!is_null($request['unidadesTallaM']) && is_null(Size::where('clothe_id',$request['clothe_id'])->where('type_size_id',2)->first()))
            Size::create([
                'clothe_id' => $request['clothe_id'],
                'stock' => $request['unidadesTallaM'],
                'type_size_id' => 2,
            ]);
            else{
                if (!is_null($request['unidadesTallaM'])){
                    Size::where('clothe_id', $request['clothe_id'])->where('type_size_id',2)->first()->increment('stock',$request['unidadesTallaM']);
                }

            }


            if (!is_null($request['unidadesTallaL']) && is_null(Size::where('clothe_id',$request['clothe_id'])->where('type_size_id',3)->first()))
                Size::create([
                    'clothe_id' => $request['clothe_id'],
                    'stock' => $request['unidadesTallaL'],
                    'type_size_id' => 3,
                ]);
            else{
                if (!is_null($request['unidadesTallaL'])){
                    Size::where('clothe_id', $request['clothe_id'])->where('type_size_id',3)->first()->increment('stock',$request['unidadesTallaL']);
                }

            }


            if (!is_null($request['unidadesTallaXL'])&& is_null(Size::where('clothe_id',$request['clothe_id'])->where('type_size_id',4)->first()))
            Size::create([
                'clothe_id' => $request['clothe_id'],
                'stock' => $request['unidadesTallaXL'],
                'type_size_id' => 4,
            ]);
            else{
                if (!is_null($request['unidadesTallaXL'])){
                    Size::where('clothe_id', $request['clothe_id'])->where('type_size_id',4)->first()->increment('stock',$request['unidadesTallaXL']);
                }

            }





        return redirect()->route('clothe',$request['clothe_name'])
            ->with('message','Stock añadido correctamente');
    }

    public function destroy(Clothe $clothe,$collection_name)
    {
        $clothe->delete();
        return redirect()->route('coleccion',$collection_name)
            ->with('message','Producto deshabilitado correctamente');
    }

    public function restore($id,$collection_name)
    {
        Clothe::where('id', $id)->withTrashed()->restore();

        return redirect()->route('coleccion',$collection_name)
            ->with('message','Producto restablecido correctamente');
    }

    public function editClothe($clothe_name,$collection_name)
    {
        $clothe = Clothe::where('clothe_name',$clothe_name)->withTrashed()->first();
        return view('design.clothe.editarProducto',['clothe'=>$clothe,'collection_name'=>$collection_name]);
    }


    public function update(Request $request,$clothe_name)
    {

        if ($request['clothe_name'] != $clothe_name){
            $request->validate([
                'clothe_name' => ['required', 'string', 'max:255','unique:clothes'],
                'price' => ['required', 'numeric', 'max:255'],
                'description' => ['required', 'string', 'max:255'],
            ]);
        }
        else{
            $request->validate([
                'clothe_name' => ['required', 'string', 'max:255'],
                'price' => ['required', 'numeric', 'max:255'],
                'description' => ['required', 'string', 'max:255'],
            ]);
        }

        if($request->hasFile('avatar1') && $request->file('avatar1')->isValid() && $request->hasFile('avatar2') && $request->file('avatar2')->isValid()){
            Clothe::where('clothe_name',$request['clothe_name'])->withTrashed()->first()->clearMediaCollection();
            Clothe::where('clothe_name',$request['clothe_name'])->withTrashed()->first()->addMedia($request['avatar1'])->toMediaCollection();
            Clothe::where('clothe_name',$request['clothe_name'])->withTrashed()->first()->addMedia($request['avatar2'])->toMediaCollection();
        }

        $clothe = Clothe::where('clothe_name',$clothe_name)->withTrashed()->first();

        $clothe->update($request->all());

        return redirect()->route('coleccion',$request['collection_name'])
            ->with('info','El producto fue actualizado correctamente');
    }


    public function add_to_cart($clothe_name,Request $request)
    {
        $clothe = Clothe::where('clothe_name',$clothe_name)->first();


        if ($request['talla'] == 'S')
        Size::where('clothe_id', $clothe->id)->where('type_size_id',1)->first()->decrement('stock',1);
        if ($request['talla'] == 'M')
        Size::where('clothe_id', $clothe->id)->where('type_size_id',2)->first()->decrement('stock',1);
        if ($request['talla'] == 'L')
        Size::where('clothe_id', $clothe->id)->where('type_size_id',3)->first()->decrement('stock',1);
        if ($request['talla'] == 'XL')
        Size::where('clothe_id', $clothe->id)->where('type_size_id',4)->first()->decrement('stock',1);


        $user_id = Auth::user()->id;
        $cartVacio = Cart::where('user_id', $user_id)->first();


        if ($cartVacio == null){
            Cart::create([
                'clothe_id' => $clothe->id,
                'user_id' => $user_id,
                'unidades' => 1,
                'talla' => $request['talla'],
            ]);
        }
        else{
              $existePrendas =  Cart::where('clothe_id',$clothe->id)->where('talla',$request['talla'])->first();
                  if ($existePrendas != null){
                      $existePrendas->increment('unidades',1);
                  }
                  else{
                      Cart::create([
                          'clothe_id' => $clothe->id,
                          'user_id' => $user_id,
                          'unidades' => 1,
                          'talla' => $request['talla'],
                      ]);
                  }
        }


        return redirect()->route('cart')
            ->with('message','El producto fue añadido correctamente');
    }

    public function cart()
    {
        $user_id = Auth::user()->id;
        $cart = Cart::where('user_id', $user_id)->get();
        $ropa = Clothe::all();
        $collection = Collection::all();

        return view('user.carrito',['clothes'=>$ropa,'cart'=>$cart,'collection'=>$collection]);
    }

    public function remove_from_cart($carID)
    {
        $fila = Cart::where('id', $carID)->first();

        if ($fila->talla == 'S'){
            Size::where('clothe_id', $fila->clothe_id)->where('type_size_id',1)->first()->increment('stock',$fila->unidades);
        }
        if ($fila->talla == 'M'){
            Size::where('clothe_id', $fila->clothe_id)->where('type_size_id',2)->first()->increment('stock',$fila->unidades);
        }
        if ($fila->talla == 'L'){
            Size::where('clothe_id', $fila->clothe_id)->where('type_size_id',3)->first()->increment('stock',$fila->unidades);
        }
        if ($fila->talla == 'XL'){
            Size::where('clothe_id', $fila->clothe_id)->where('type_size_id',4)->first()->increment('stock',$fila->unidades);
        }

        $fila->delete();

        return redirect()->route('cart')
            ->with('message','Producto eliminado del carrito correctamente');

    }

    public function comprar(Request $request){
        $precioTotal = $request['precioTotal'];

        return view('design.compra.realizarCompra',['precioTotal'=>$precioTotal]);
    }

    public function realizar_compra(Request $request){
        $user_id = Auth::user()->id;
        $clothe = Clothe::all();
        $cart = Cart::where('user_id', $user_id)->get();
        
         $request->validate([
            'email' => ['required', 'email', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'direccion' => ['required', 'string', 'max:255'],
            'codigoPostal' => ['required', 'string', 'min:4','max:9'],
            'localidad' => ['required', 'string', 'max:255'],
            'pais' => ['required', 'string', 'max:255'],
            'telefono' => ['required', 'numeric','digits:9'],
        ]);

        $purchase = Purchase::create([
            'user_id'=>$user_id,
            'total_price'=>$request['precioTotal'],
            'direccion'=>$request['direccion'],
            'codigo_postal'=>$request['codigoPostal'],
            'pais'=>$request['pais'],
            'localidad'=>$request['localidad'],
            'telefono'=>$request['telefono'],
            'fecha_de_compra'=>Carbon::now()->format('d/m/Y'),
        ]);

        foreach ($cart as $car){

            PurchaseLines::create([
                'purchase_id'=>$purchase->id,
                'user_id'=>$user_id,
                'clothe_id'=>$clothe->where('id',$car->clothe_id)->first()->id,
                'size'=>$car->talla,
                'amount'=>$car->unidades,
                'unitary_price'=>$clothe->where('id',$car->clothe_id)->first()->price,
            ]);

            Cart::where('id', $car->id)->delete();
        }


        return redirect()->route('home')
            ->with('message','Compra realizada correctamente');
    }
}
