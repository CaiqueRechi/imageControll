@extends('layouts.app', ['pageSlug' => 'dashboard'])

<?php $userName = auth()->user()->name;
?>

@section('content')
    <div class="sku-item d-flex justify-content-between mb-2">
        <form action="{{ url('update/'.$sku->id) }}" method="post" style="width: 40%">
            @csrf
            @method('PUT')
            <div class="d-flex justify-content-between">
                <div class="d-flex align-items-center">
                    <label class="mr-2"> SKU: </label>
                    <input type="number" value="{{$sku->id}}" name="id">
                    <label class="mr-2"> NOME: </label>
                    <input type="text" value="{{$sku->name}}" name="name">
                    <input type="hidden" value="{{$userName}}" name="user_name">
                </div>
                <div>
                    <button class="text-white btn btn-fill btn-primary">salvar</button>
                </div>
            </div>
        </form>
        <a href="{{url('delete/'.$sku->id)}}" class="text-white btn btn-fill btn-primary" style="height: fit-content;">Deletar</a>
    </div>

    <div id="sku-img">
        <form enctype="multipart/form-data" method="post" action="{{ url('image/'.$sku->id) }}">
            @csrf
            <input type="file" name="img[]" id="img" class="form-control" multiple>
            <input type="hidden" name="id" value="{{$sku->id}}">
            <input type="hidden" value="{{$userName}}" name="user_name">
            <button class="text-white btn btn-fill btn-primary">Enviar Imagem</button>
        </form>
        <div class="img-container">
            <?php
                $imgs = DB::table('img_galeries')->where('sku', $sku->id)->get();
            foreach ($imgs as $img) {
                $src = $img->img;
            ?>

            <div class="image-product d-flex flex-column">
                <a class="btn-remove bi bi-trash-fill" href="{{url('deleteImage/'.$img->id)}}"></a>
                <img src="{{url('img/skus/'.$src)}}">
                <a class="text-white mt-3" href="{{url('img/skus/'.$src)}}">Link da Imagem</a>
                <br>
                <p>{{url('img/skus/'.$src)}}</p>
            </div>

            <?php
                }
            ?>
        </div>
    </div>
@endsection
