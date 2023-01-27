<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sku;
class EditSkuController extends Controller
{
    public function edit($id) {
        $sku = Sku::find($id);
        return view('edit', compact('sku'));
    }
}


