<?php

namespace App\Http\Controllers;
use App\Models\Sku;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class PesquisaController extends Controller
{
    public function pesquisaSku($id) {
        $skus = Sku::where('sku','LIKE',"%{$id}%")->get();
        if (!$skus){
            $notFound = "<p>Não encontrado</p>";
            echo $notFound;
        } else {
            $output = '';
            foreach ($skus as $sku) {
                $output .= "<div class='sku-item mb-2'>";
                $output .= "<div class='d-flex justify-content-between'>";
                $output .= "<div class='d-flex align-items-center col-8'>";
                $output .= "<p>ID:<span class='sku-id ml-2 mr-3'>{$sku->sku}</span>";
                $output .= "</p>";
                $output .= "<p>Nome:  <span class='sku-name mr-3 ml-2'>{$sku->name}</span></p>";
                $output .= "</div>";
                $output .= "<div>";
                $output .= "<a href='" . url('edit/' . "$sku->id") . "' class='text-white btn btn-fill btn-primary'>Editar</a>";
                $output .= "</div>";
                $output .= "</div>";
                $output .= "</div>";
            }
            echo $output;
        }
    }
}
