<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Carbon\Carbon;

use App\Models\Category;

class CategoriesController extends Controller
{
    public function categories(Request $request) {

        $success = false;
        $message = __("messages.exception_error");
        $data = array();
		
		$validator = Validator::make($request->all(), [
            'offset' => 'required|numeric',
            'limite' => 'required|numeric|gt:0',
        ]);

        if ($validator->fails()) {
            $message = $validator->errors()->first();
        }else{

			
				if(!$request->parent_id){ $request->parent_id = null; }
				
				$category_list = Category::select('id', 'name', 'slug', 'image', 'banner_img')
								->where('parent_id', $request->parent_id)
								->where('status', 'Active')
								->skip($request->offset)
								->take($request->limite)
								->get();
								
				if($category_list){					
					foreach($category_list as $val){
						$val->image = getImage($val->image); 
					}
				}

				if(isset($category_list) && $category_list->isNotEmpty()){
					$success = true;
					$message = __("messages.data_found");
					$data = $category_list;
				}
				else{
					$message = __("messages.no_data_found");
				}
			
		}

        return response()->json(['success' => $success, 'message' => $message, 'data' => $data]);
    }

   
}
