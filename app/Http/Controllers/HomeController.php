<?php

    namespace App\Http\Controllers;

    use App\Models\Categorie;
    use App\Models\Product;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\DB;

    class HomeController extends Controller
    {

        public function index()
        {

            $categories = Categorie::where('status', 'active')->get();
            $products = DB::table('products as p')
                ->join('categories as c', 'c.category_id', '=', 'p.category_id')
                ->join('stocks as s', 's.product_id', '=', 'p.product_id')
                ->select(
                    'p.product_id',
                    'p.product_name',
                    'p.price',
                    'p.image',
                    'p.description',
                    'p.status',
                    'c.category_name',
                    's.total_qty_in_stock'
                )
                ->where('p.status', '=', 'active')
                ->get();

//            dd($products);


            return view('home.index',compact('products','categories'));
        }
    }
