@extends('layouts.app')

@section('css')
   <link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="container">
    <h1 class="page-title">商品登録</h1>

    <form action="{{ route('products.confirm') }}" method="POST" enctype="multipart/form-data" class="product-form">
        @csrf

        <!-- 商品名 -->
        <div class="form-group">
            <label for="name">商品名 <span class="required">*</span></label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" ><span class="form__label--required">必須</span>
            @if($errors->has('name'))
           <div class="text-danger">
            @foreach($errors->get('name') as $message)
            <p>{{ $message }}</p>
            @endforeach
           </div>
          @endif
        </div>

        <!-- 価格 -->
        <div class="form-group">
            <label for="price">価格 <span class="required">*</span></label>
            <input type="number" name="price" id="price" value="{{ old('price') }}"><span class="form__label--required">必須</span>
            @if($errors->has('price'))
           <div class="text-danger">
            @foreach($errors->get('price') as $message)
            <p>{{ $message }}</p>
            @endforeach
           </div>
          @endif
        </div>

        <!-- 商品画像 -->
        <div class="form-group">
            <label for="image">商品画像 <span class="required">*</span></label>
           <span class="form__label--required">必須</span>
           <input type="file" name="image" id="image" accept=".png,.jpeg">

            @if ($errors->has('image'))
            <div class="text-danger">
              @foreach ($errors->get('image') as $message)
              <p>{{ $message }}</p>
              @endforeach
            </div>
            @endif
        </div>

        <!-- 季節 -->
        <!-- 季節 -->
    < class="form-group">
      <label>季節 <span class="required">*</span></label>
      <span class="form__label--required">必須</span>
      <div class="checkbox-group">
        @foreach($seasons as $season)
            <label>
                <input 
                    type="checkbox" 
                    name="season_id[]" 
                    value="{{ $season->id }}"
                    {{ (is_array(old('season_id')) && in_array($season->id, old('season_id'))) ? 'checked' : '' }}
                >
                {{ $season->name }}
            </label>
        @endforeach

          @if($errors->has('season_id'))
           <div class="text-danger">
            @foreach($errors->get('season_id') as $message)
            <p>{{ $message }}</p>
            @endforeach
           </div>
          @endif
       </div>        

       <!-- 商品説明 -->
        <div class="form-group">
            <label for="description">商品説明 <span class="required">*</span></label>
            <span class="form__label--required">必須</span>
            <textarea name="description" id="description" rows="4" >{{ old('description') }}</textarea>
            
           @if($errors->has('description'))
           <div class="text-danger">
            @foreach($errors->get('description') as $message)
            <p>{{ $message }}</p>
            @endforeach
           </div>
          @endif
        </div>

        <!-- ボタン -->
        <div class="form-buttons">
            <a href="{{ route('products.index') }}" class="btn btn-back">戻る</a>
            <button type="submit" class="btn btn-submit">登録</button>
        </div>
    </form>
</div>
@endsection