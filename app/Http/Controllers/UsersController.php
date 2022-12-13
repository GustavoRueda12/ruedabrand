<?php

namespace App\Http\Controllers;

use App\DataTables\PurchasesDataTable;
use App\DataTables\UsersDataTable;
use App\Models\Clothe;
use App\Models\Purchase;
use App\Models\PurchaseLines;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function listadoUsuarios(UsersDataTable $usersDatatable)
    {
        return $usersDatatable->render('user.listadoUsuarios');
    }

    public function listadoVentas(PurchasesDataTable $pruchasesDatatable)
    {
        return $pruchasesDatatable->render('user.listadoVentas');
    }

    public function formCreateAdmin()
    {
        return view('user.formularioAniadirAdmin');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8','confirmed'],
            'password_confirmation' => ['required', 'string', 'min:8'],
        ]);

        User::create([
            'email' => $request['email'],
            'name' => $request['name'],
            'surname' => $request['surname'],
            'password' => Hash::make($request['password']),
        ])->assignRole('admin');

        return redirect()->route('home')
            ->with('message','Usuario admin creado correctamente');
    }

    public function edit(User $user)
    {
        return view('user.editUser',compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
        ]);

        $user->update($request->all());

        return redirect()->route('listadoUsuarios')
            ->with('info','El usuario fue actualizado correctamente');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('listadoUsuarios')
            ->with('secondary','Usuario desabilitado correctamente');
    }


    public function restore($id)
    {
        User::where('id', $id)->withTrashed()->restore();

        return redirect()->route('listadoUsuarios')
            ->with('message','Usuario restablecido correctamente');
    }


    public function forceDelete(User $user, Request $request)
    {
        User::where('id', $user->id)->withTrashed()->forceDelete();

        //$mensaje = new EliminarMailable($request['mensajeEliminar']);
        //Mail::to($user->email)->send($mensaje);

        return redirect()->route('listadoUsuarios')
            ->with('message','Usuario borrado correctamente');
    }

    public function updateProfile(Request $request)
    {
        $request->validate([

        ]);

        $user=Auth::user();
        $user->update($request->all());

        return back()->with('info','Perfil guardado corectamente');
    }

    public function formcambiarPassword ()
    {
        return view('user.cambiarPassword');
    }

    public function cambiarPassword (Request $request)
    {
         $request->validate([
            'oldPassword' => ['required', 'string', 'min:8'],
            'password' => ['required', 'string', 'min:8','confirmed'],
            'password_confirmation' => ['required', 'string', 'min:8'],
        ]);


        #Match The Old Password
        if(!Hash::check($request->oldPassword, auth()->user()->password)){
            return back()->with("danger", "La contraseña anterior no coincide!");   
        }


        #Update the new Password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->password)
        ]);
        return back()->with('message','La contraseña ha sido cambiada con éxito');
    }
    public function listadoProductos ($id_purchase)
    {
        $productosDeLaCompra = PurchaseLines::where('purchase_id',$id_purchase)->get();
        $ropa = Clothe::all();
        $purchase = Purchase::all();

        return view('user.productosComprados',['products'=>$productosDeLaCompra,'clothes'=>$ropa,'id_purchase'=>$id_purchase,'purchase'=>$purchase]);

    }

}
