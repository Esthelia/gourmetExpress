<?php

namespace App\Http\Controllers\Site\Accueil;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AccueilController extends Controller
{
    public function getShow() {

        $date = date('d/m/Y');
        $jourIndex = date('N') - 1;
        $jour = Helper::getDayName($jourIndex);
        $menu = Helper::menu();

        // Récupérer les produits pour le jour actuel via le helper
        $products = Helper::getProductsForToday();

      //dd($products->all());
      return view('pages.site.accueil.show',compact('date','jour','menu','products'));  
    }


    public function getIndex()
    {
        $products = Product::all();
        // dd($products);
        return view('pages.site.accueil.index', compact('products'));
    }

    public function getCreate()
    {
      
      return view('pages.site.accueil.create');
    }


    public function postStore(Request $request) {

        $image = $request->file('image');
        $path_image = $image->store('accueil', "public");
        
        $product = new Product();
        $product->firstOrCreate([
            'image' => $path_image,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'day' => $request->day,
        ]);
        
        return redirect()->route('Site-AccueilGetShow');
    }

    public function getEdit(Product $product)
    {

      return view('pages.site.accueil.edit', compact('product'));
    }

    public function postUpdate(Request $request, Product $product)
    {
      $image = $request->file('image');
      $path_image = $image->store('accueil', "public");


      $product->image = $path_image;
      $product->name = $request->name;
      $product->price = $request->price;
      $product->description = $request->description;
      $product->stock = $request->stock;
      $product->day = $request->day;

      $product->save();

      return redirect()->route('Site-AccueilGetIndex');
    }

    public function postDestroy($id)
    {
      $product = Product::findOrFail($id);

      if ($product) {
        $product->delete();
      }

      return redirect()->route('Site-AccueilGetIndex');
    }

  
}
