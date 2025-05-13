<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariants;
use App\Models\Wishlist;
use App\Models\ProductReview;
use App\Models\HomeBanner;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
		$HomeBanner = HomeBanner::where('status', 'Active')->get();
					
		$PopularProduct = Product::with(['category_data','sub_category_data','sub_category2_data','images_data'])
					->whereNull('deleted_at')
					->where('status', 'Active')
					->orderBy('rating','desc')
					->take(8)
					->get();
					
		foreach($PopularProduct as $pdata){
			$pdata->review_count = ProductReview::where('product_id', $pdata->id)->count();
		}
		
		$LatestArrival = Product::with(['category_data','sub_category_data','sub_category2_data','images_data'])
					->whereNull('deleted_at')
					->where('status', 'Active')
					->orderBy('created_at','desc')
					->take(4)
					->get();
		foreach($LatestArrival as $pdata){
			$pdata->review_count = ProductReview::where('product_id', $pdata->id)->count();
		}
		
		$featured = Product::with(['category_data','sub_category_data','sub_category2_data','images_data'])
					->whereNull('deleted_at')
					->where('status', 'Active')
					->where('is_featured', '1')
					->orderBy('created_at','desc')
					->first();
		if(isset($featured) && !empty($featured)){
			//pruduct images
			$featured->image  = asset('uploads/default_images/default_image.png');
			if(isset($featured->images_data) && count($featured->images_data) > 0){
				if(file_exists($featured->images_data[0]->big_image)){ $featured->image = asset($featured->images_data[0]->big_image);  }
			}
		}

		$categoty = Category::select('id', 'name', 'slug', 'image', 'banner_img')
		->where('parent_id', null)
		->where('level', 0)
		->where('status', 'Active')
		->orderBy('name', 'ASC')
		->limit(4)->get();
		
					
        return view('front.home', compact('HomeBanner', 'PopularProduct', 'LatestArrival', 'featured', 'categoty'));
    }
}
