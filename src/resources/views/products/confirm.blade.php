@extends('layouts.app')

@section('css')
   <link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
@endsection

@section('content')
<div class="container">
    <h1>商品登録確認</h1>

    <form action="{{ route('products.create') }}" method="POST">
    @csrf

    <input type="hidden" name="name" value="{{ $products['name'] }}">
    <input type="hidden" name="price" value="{{ $products['price'] }}">
    <input type="hidden" name="image" value="{{ $products['image'] }}">
    <input type="hidden" name="description" value="{{ $products['description'] }}">

    <div class="form-group">
        <strong>商品名:</strong> {{ $product['name'] }}
        <input type="text" name="name" value="{{ $product['name'] }}" readonly>
    </div>

    <div class="form-group">
        <strong>価格:</strong> ¥{{ number_format($product['price']) }}
        <input type="text" name="price" value="{{ $product['price'] }}" readonly>
    </div>

    <div class="form-group">
        <strong>商品画像:</strong><br>
        <img src="{{ asset('storage/' . $product['image_path']) }}" alt="商品画像" class="product-image">
        <input type="text" name="image_path" value="{{ $product['image_path'] }}" readonly>
    </div>

    <div class="form-group">
        <strong>季節:</strong>
        @foreach($seasons as $season)
            <span class="season-name">{{ $season->name }}</span>
            <input type="text" name="season_id[]" value="{{ $season->id }}" readonly>
        @endforeach
    </div>

    <div class="form-group">
        <strong>商品説明:</strong>
        <p>{{ $product['description'] }}</p>
        <input type="text" name="description" value="{{ $product['description'] }}" readonly>
    </div>

    <div class="form-buttons">
        <a href="{{ route('products.register') }}" class="btn btn-back">戻る</a>
        <button type="submit" class="btn btn-submit">登録する</button>
    </div>
    </form>
</div>
@endsection



