@extends('layouts.app')

@section('css')
   <link rel="stylesheet" href="{{ asset('css/show.css') }}">
@endsection

@section('content')
<div class="product-edit-container">
    <!-- ページタイトル -->
   <div class="product-edit-title">
    <a href="{{ route('products.index') }}" class="product-content">商品一覧</a>
    <p class="product-name"><{{ $product->name }}</p>
   </div>

    <!-- 更新フォーム -->
    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

    <!-- 画像と商品情報を横並びに -->
    <div class="form-horizontal">
      <div class="form-group-image">
        @if($product->image)
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="current-image">
        @endif
          <div class="form-group-file">
            <label for="image">ファイルを選択</label>
            <input type="file" id="image" name="image" >
          </div>
            @if ($errors->has('image'))
            <div class="text-danger">
              @foreach ($errors->get('image') as $message)
              <p>{{ $message }}</p>
              @endforeach
            </div>
            @endif
       </div>

    <div class="form-group-content">
        <!-- 商品名・価格・季節 -->
        <div class="form-group-name">
            <label for="name">商品名</label>
            <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}" class="text" >
          @if($errors->has('name'))
           <div class="text-danger">
            @foreach($errors->get('name') as $message)
            <p>{{ $message }}</p>
            @endforeach
           </div>
          @endif

        </div>

        <div class="form-group-price">
            <label for="price">価格</label>
            <input type="text" id="price" name="price" value="{{ old('price', $product->price) }}"class="text">
            @if($errors->has('price'))
           <div class="text-danger">
            @foreach($errors->get('price') as $message)
            <p>{{ $message }}</p>
            @endforeach
           </div>
          @endif
        </div>

        <div class="form-group-season">
            <label>季節</label>
            <div class="checkbox-group">
                @foreach($seasons as $season)
                    <label>
                        <input 
                            type="checkbox" 
                            name="season_id[]" 
                            value="{{ $season->id }}"
                            {{ $product->seasons->contains($season->id) ? 'checked' : '' }}>
                        {{ $season->name }}
                    </label>
                @endforeach
            </div>
              @if($errors->has('season_id'))
                <div class="text-danger">
                  @foreach($errors->get('season_id') as $message)
                  <p>{{ $message }}</p>
                 @endforeach
                </div>
              @endif
        </div>
    </div>
</div>

<!-- 商品説明 -->
<div class="form-group-description">
    <label for="description">商品説明</label>
    <textarea id="description" name="description" rows="5" >{{ old('description', $product->description) }}</textarea>
          @if($errors->has('description'))
           <div class="text-danger">
            @foreach($errors->get('description') as $message)
            <p>{{ $message }}</p>
            @endforeach
           </div>
          @endif

</div>
     <!-- 戻る & 保存 -->
        <div class="form-buttons">
            <a href="{{ route('products.index') }}" class="btn-back">戻る</a>
            <button type="submit" class="btn-save">変更を保存</button>
        </div>
    </form>

    <!-- 削除フォーム（別） -->
    <div class="form-button-delete">
        <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('本当に削除しますか？');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn-delete">
                🗑️
            </button>
        </form>
    </div>
</div>
@endsection
