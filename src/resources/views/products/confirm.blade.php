@extends('layouts.app')

@section('css')
   <link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
@endsection

@section('content')
<div class="container">
    <h1 class="page-title">商品登録</h1>

    <form action="{{ route('products.store') }}" method="POST">
    @csrf

    <div class="form-group">
      <div class="form-label">
        <strong>商品名</strong> 
        <span class="form__label--required">必須</span>
      </div>
        <input type="text" name="name" value="{{ $products['name'] }}" readonly>
    </div>

    <div class="form-group">
      <div class="form-label">
        <strong>価格:</strong> 
        <span class="form__label--required">必須</span>
      </div>
        <input type="text" name="price" value="{{ $products['price'] }}" readonly>
    </div>

    <div class="form-group">
      <div class="form-label">
        <strong>商品画像</strong><br>
        <span class="form__label--required">必須</span>
      </div>
        <img src="{{ asset('storage/' . $products['image']) }}" alt="商品画像" class="product-image">
         <input type="hidden" name="image" value="{{ $products['image'] }}">
    </div>

   <div class="form-group">
    <div class="form-label">
      <strong>季節</strong>
      <span class="form__label--required">必須</span>
      <p class="form__label--selection">複数選択可</p>
    </div>
    <div class="checkbox-group">
        @foreach($seasons as $season)
            <label>
                <input 
                    type="checkbox" 
                    name="season_id[]" 
                    value="{{ $season->id }}"
                    {{ in_array($season->id, $products['season_id'] ?? []) ? 'checked' : '' }} 
                    disabled>
                {{ $season->name }}
            </label>
        @endforeach

        {{-- hiddenで選択された値を送信する --}}
        @foreach($products['season_id'] ?? [] as $id)
            <input type="hidden" name="season_id[]" value="{{ $id }}">
        @endforeach
    </div>
</div>


    <div class="form-group">
      <div class="form-label">
        <strong>商品説明</strong>
        <span class="form__label--required">必須</span>
      </div>
        <input type="text" name="description" value="{{ $products['description'] }}" readonly>
    </div>

    <div class="form-buttons">
        <a href="{{ route('products.register') }}" class="btn btn-back">戻る</a>
        <button type="submit" class="btn btn-submit">登録する</button>
    </div>
  </form>
</div>
@endsection



