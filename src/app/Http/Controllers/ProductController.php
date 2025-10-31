<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Season;
use App\Models\Product_Season;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->filled('keyword')) {
            $query->where('name', 'like', '%' . $request->keyword . '%');
        }

        if ($request->sort === 'price_asc') {
            $query->orderBy('price', 'asc');
        } elseif ($request->sort === 'price_desc') {
            $query->orderBy('price', 'desc');
        }

        $products = $query->paginate(6)->appends($request->query());
        $seasons = Season::all();

        return view('products.index', compact('products', 'seasons'));
    }

       public function create(){
      $seasons=Season::all();
      return view('products.register',compact('seasons'));
   }

    public function show($id)
   {
    $product = Product::with('seasons')->findOrFail($id);
    $seasons = Season::all(); // 全ての季節を取得
    return view('products.show', compact('product', 'seasons'));
   }

    public function update(ProductRequest $request, $id)
    {       
      $product = Product::findOrFail($id);

      //リクエストで得られたデータに置き換える
      $product->name = $request->name;
      $product->price = $request->price;
      $product->seasons()->sync($request->season_id);
      $product->description = $request->description;

    // ファイルが選択された場合に storage に保存
      if($request->hasFile('image')) {
        // storage/app/public/images に保存
      $path = $request->file('image')->store('images', 'public');
      $product->image = str_replace('public/', '', $path);
      }
      $product->save();//データベースにupdateされる
      return redirect()->route('products.index')->with('success', '商品を更新しました');
    }

   //削除
   public function destroy($id)
   {
    // ① 削除対象の商品を取得
     $product = Product::findOrFail($id);

    // ② 画像ファイルが存在していれば、storageから削除
      if ($product->image) {
      $imagePath = storage_path('app/public/' . $product->image);
      if (file_exists($imagePath)) {
            unlink($imagePath);
        }
      }

    // ③ データベースからレコード削除
    $product->delete();

    // ④ 一覧ページにリダイレクト
    return redirect()->route('products.index')->with('success', '商品を削除しました');
   }
   
   public function confirm(ProductRequest $request)
{
    // 画像を一時保存
    $path = $request->file('image')->store('images/tmp', 'public');

    // データと一緒にセッションに保存
    session([
        'tmp_product' => [
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'image' => $path,
            'season_id' => $request->season_id,
        ]
    ]);

    $seasons = Season::all();

    return view('products.confirm', [
        'products' => session('tmp_product'),
        'seasons' => $seasons
    ]);
}

public function store()
{
    $tmp = session()->pull('tmp_product'); // 取り出すと同時にセッション削除

    if (!$tmp || !Storage::disk('public')->exists($tmp['image'])) {
        return redirect()->route('products.register')->with('error', '画像が見つかりません');
    }

    $newPath = str_replace('images/tmp/', 'images/', $tmp['image']);
    Storage::disk('public')->move($tmp['image'], $newPath);

    $product = Product::create([
        'name' => $tmp['name'],
        'price' => $tmp['price'],
        'description' => $tmp['description'],
        'image' => $newPath,
    ]);

    $product->seasons()->sync($tmp['season_id'] ?? []);

    return redirect()->route('products.index')->with('success', '商品を登録しました');
}
}


