@extends('layouts.app', ['pageSlug' => 'dashboard'])

{{
    $user = DB::table('users')->where('id', '$sku->id')->first();
}}
@section('content')
<div class="sku-item mb-2">
    <div class="d-flex justify-content-between">
        <div class="d-flex align-items-center">
            <label class="mr-2"> SKU: </label>
            <input type="text" value="{{$sku->id}}">
            <label class="mr-2"> NOME: </label>
            <input type="text" value="{{$sku->name}}">
        </div>
        <div>
            <a href="{{ url("edit/$sku->id") }}" class="text-white btn btn-fill btn-primary">Editar</a>
        </div>
    </div>
</div>
@endsection
