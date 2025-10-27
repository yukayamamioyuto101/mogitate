@extends('layouts.app')

@section('css')
   <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content') 
  <div class="header-container">
        <!-- タイトル -->
        <h1 class="title">商品一覧</h1>

        <!-- 右端のボタン -->
        <div class="header-actions">
            <a href="{{ route('products.register') }}" class="add-product-btn">＋商品を追加</a>
        </div>
    </div>

  <!-- 商品一覧のコンテンツ -->
  <div class="products-content">
    <div class="products-controls">
        <!-- 検索フォーム -->
        <form action="{{ route('products.index') }}" method="GET" class="search-form">
            <input type="text" name="keyword" placeholder="商品名で検索" class="search-input" value="{{ request('keyword') }}">
            <button type="submit" class="search-btn">検索</button>
        </form>

        <!-- 並び替えセレクト -->
        <form action="{{ route('products.index') }}" method="GET" class="sort-form">
            <p class="sort-form-content">価格順で表示</p>
            <select name="sort" onchange="this.form.submit()" class="sort-select">
                <option value="">並び替え</option>
                <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>価格が安い順</option>
                <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>価格が高い順</option>
            </select>
        </form>
    </div>

    <!-- 商品カードの表示 -->
    <div class="card-container">
        @foreach ($products as $product)
        <a href="{{ route('products.show', $product->id) }}" class="card-link">
            <div class="card">
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="card-img">
                <div class="card-content">
                    <p class="card-title">
                        {{ $product->name }}
                    </p>
                    <p class="card-text">
                        ¥{{ number_format($product->price) }}
                    </p>
                </div>
            </div>
        </a>
        @endforeach
    </div>
</div>
   <!-- ページネーション -->
    <div class="pagination">
        {{ $products->links() }}
    </div>
@endsection



