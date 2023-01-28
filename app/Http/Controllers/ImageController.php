<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\img_galery;
use Illuminate\Support\Facades\Validator;

class imageController extends Controller
{
    public function create(Request $request, $id){
        $id = $request->input('id');
            $data = $request->validate([
                'img' => 'required|array'
            ]);

            $img = [];

            foreach ($data['img'] as $file) {
                $image = new img_galery();
                $image->sku = $id;
                $requestImg = $file;
                $imageName = $id . $requestImg->getClientOriginalName();

                $input['img'] = $imageName;
                $rules = array('img' => 'unique:img_galeries,img');
                $validator = Validator::make($input, $rules);
                if ($validator->fails()) {
                    echo 'SKU já registrada!';
                }
                else {
                    $image->img = $imageName;
                    $file->move(public_path('/img/skus'), $imageName);
                    $image->save();
                }
            }
           return redirect('/edit/'.$id);
    }

    public function delete($id){
        $img = img_galery::find($id);
        $skuid = $img->sku;
        $path = 'img/skus/' . $img->img;
        if (File_exists($path)) {
            unlink($path);
            $img->delete();
            return redirect('/edit/'.$skuid);
        }
    }
}
