<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Str;
use Auth;
use App\Models\Category;
//use App\Models\SubCategory;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subCategoryLists = Category::with(['category_data'])
                                    ->where('level', 1)
                                   
                                    ->orderBy('created_at','DESC')
                                    ->get();

        return view('seller.subcategory.index', compact('subCategoryLists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categoryData = Category::where('parent_id', null)
                                    ->where('level', 0)
                                    ->where('status', 'Active')
                                   
                                    ->orderBy('name','ASC')
                                    ->get();

        return view('seller.subcategory.create', compact('categoryData'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $success = false;
        $message = __("messages.exception_error");
        $data = array();

        $validator = Validator::make($request->all(), [
            'category' => 'required|exists:categories,id',
            'sub_category_name' => 'required|max:60',
        ]);

        if($validator->fails()){ // Validation fails
            $message = $validator->errors()->first();
        }
        else{

            $name = trim($request->sub_category_name);
            $slug = Str::slug($name);

            $check_category_name = Category::where('slug', $slug)
                                            ->where('parent_id', $request->category)
                                            ->where('level', 1)
                                           
                                            ->count();

            if($check_category_name == 0){ // Same sub category name not exist so insert it

                $sub_category = new Category();
                $sub_category->parent_id = $request->category;
                $sub_category->level = 1;
                $sub_category->name = $name;
                $sub_category->slug = $slug;
                
                try{
                    $sub_category->save();
                    $success = true;
                    $message =  __("messages.sub_category1_store_success");
                }
                catch(\Exception $e){
					//$message = $e->getMessage();
                }
            }
            else{ // Same sub category name is exist
                $message = __('messages.sub_category1_exist');
            }
        }

        return response()->json(['success' => $success, 'message' => $message, 'data' => $data]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categoryData = Category::where('status', 'Active')
                               
                                ->where('parent_id', null)
                                ->where('level', 0)
                                ->orderBy('name','ASC')
                                ->get();

        $subCategoryData = Category::where('id', $id)
                                    ->where('level', 1)
                                   
                                    ->first();

        return view('seller.subcategory.edit', compact('categoryData', 'subCategoryData'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $success = false;
        $message = __("messages.exception_error");
        $data = array();

        $validator = Validator::make($request->all(), [
            'category' => 'required|exists:categories,id',
            'sub_category_name' => 'required|max:60',
            'status' => 'required|in:Active,Inactive'
        ]);

        if($validator->fails()){ // Validation fails
            $message = $validator->errors()->first();
        }
        else{

            $category_id = $request->category;
            $name = trim($request->sub_category_name);
            $slug = Str::slug($name);

            $check_sub_category_name = Category::where('id', '!=', $id)
                                                ->where('parent_id', $category_id)
                                                ->where('slug', $slug)
                                                ->where('level', 1)
                                               
                                                ->count();

            if($check_sub_category_name == 0){ // Same sub category name not exist with same category_id so insert it

                $sub_category = Category::find($id);

                if(isset($sub_category) && !empty($sub_category) && isset($sub_category->id)){
                    $sub_category->parent_id = $category_id;
                    $sub_category->name = $name;
                    $sub_category->slug = $slug;
					$sub_category->SEO_description = $request->SEO_description;
                    $sub_category->SEO_tags = $request->SEO_tags;
                    $sub_category->status = $request->status;
                    
                    try{
                        $sub_category->save();
                        $success = true;
                        $message = __('messages.sub_category1_update_success');
                    }
                    catch(\Exception $e){
                    }
                }
                else{
                    $message = __('messages.sub_category1_invalid');
                }
            }
            else{ // Same sub category name is exist with same category id
                $message = __('messages.sub_category1_exist');
            }
        }

        return response()->json(['success' => $success, 'message' => $message, 'data' => $data]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cat = Category::where('id', $id)
                            ->where('level', 1)
                            ->first();
                                    
        if(isset($cat) && !empty($cat) && isset($cat->id)){
            try{

				$subcat2 = Category::where('parent_id', $cat->id)->get();
				if(count($subcat2) > 0){
					foreach($subcat2 as $val2){
						Category::find($val2->id)->delete();
					}
				}
				
                $cat->delete();
                return redirect()->back()->with('success', __('messages.sub_category1_delete_success'));
            }
            catch(\Exception $e){
                return redirect()->back()->with('danger', __('messages.exception_error'));
            }
        }
        else{
            return redirect()->back()->with('danger', __('messages.sub_category1_invalid'));
        }
    }

    public function sub_category_name($id){

        $success = false;
        $message = __("messages.exception_error");
        $data = array();

        $subCategoryData = Category::select('id', 'name')
                                    ->where('parent_id', $id)
                                    ->where('status', 'Active')
                                   
                                    ->orderBy('name','ASC')
                                    ->get();

        if(isset($subCategoryData) && !empty($subCategoryData) && $subCategoryData->isNotEmpty()){
            $success = true;
            $message = __("messages.data_found");
            $data = $subCategoryData;
        }
        else{
            $message = __("messages.sub_category1_data_not_found");
        }

        return response()->json(['success' => $success, 'message' => $message, 'data' => $data]);
    }
}
