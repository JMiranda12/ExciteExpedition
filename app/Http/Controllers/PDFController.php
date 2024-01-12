<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//mesmo tendo na config app.php : 'PDF' => Barryvdh\DomPDF\Facade::class, estava a dar erro
use Barryvdh\DomPDF\Facade\Pdf;

class PDFController extends Controller
{
    public function generatePDF(){
        $data = [
            'title' => 'ExciteExpedition'
        ];
        $pdf = PDF::loadView('myPDF', $data);
        return $pdf->download('mypdf.pdf');
    }
}
