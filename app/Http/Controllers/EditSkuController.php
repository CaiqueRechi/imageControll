<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sku;
use App\Models\img_galery;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class EditSkuController extends Controller
{
    public function create(Request $request){
        $sku = new Sku();
        $sku->name = request('name');
        $sku->id = request('id');
        $sku->create_by = request('create_by');
        $sku->update_by = request('create_by');

        $input['id'] = $request->input('id');
        $rules = array('id' => 'unique:skus,id');
        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            echo 'SKU já registrada!';
        }
        else {
            $sku->save();
            return redirect('/home');
        }
    }


    public function edit($id) {
        $sku = Sku::find($id);
        return view('edit', compact('sku'));
    }

    public function update(Request $request, $id) {
        $sku = Sku::find($id);
        $sku->id = $request->input('id');
        $sku->name = $request->input('name');
        $sku->update_by = $request->input('user_name');
        if ($sku->id != $id) {
            $input['id'] = $request->input('id');
            $rules = array('id' => 'unique:skus,id');
            $validator = Validator::make($input, $rules);

            if ($validator->fails()) {
                echo 'SKU já registrada!';
            }
            else {
                $sku->update();
                return redirect('/home')->with('data', 'Salvo com sucesso!');
            }
        } else {
            $sku->update();
            return redirect('/home')->with('data', 'Salvo com sucesso!');
        }
    }

    public function delete($id) {
        $sku = Sku::find($id);
        $images = DB::table('img_galeries')->where('sku', $id)->get();

        foreach ($images as $image) {
            $path = 'img/skus/' . $image->img;
            $imageId = $image->id;
            $img = img_galery::find($imageId);
            unlink($path);
            $img->delete();
        }
        $sku->delete();
        return redirect('/home')->with('data', 'deletado com sucesso!');
    }
}


