<?php

namespace App\Http\Controllers;
use App\DataTables\UsersDataTable;
use App\Models\Clothe;
use App\Models\Purchase;
use App\Models\PurchaseLines;
use App\Models\User;
use PDF;

class PDFController extends Controller
{

    public function generatePDF($id_purchase)
    {
        $productosDeLaCompra = PurchaseLines::where('purchase_id',$id_purchase)->get();
        $ropa = Clothe::all();
        $purchase = Purchase::all();
        $purchaseDate = $purchase->firstWhere('id',$id_purchase)->fecha_de_compra;

        $data = [
            'title' => 'Ticket de compra',
            'date' => $purchaseDate,
            'products' => $productosDeLaCompra,
            'purchaseDate' => $purchaseDate,
            'purchase' => $purchase,
            'clothes' => $ropa,
            'id_purchase' => $id_purchase,
        ];

        $pdf = PDF::loadView('user.myPDF', $data);

        return $pdf->download('ticketDeCompra.pdf');
    }

    public function generatePDFListadoUsuarios()
    {

       $users = User::all();
        $data = [
            'users' => $users
            ];

        $pdf = PDF::loadView('user.myPDFListadoUsuarios', $data);

        return $pdf->download('listadoUsuarios.pdf');
    }
}
