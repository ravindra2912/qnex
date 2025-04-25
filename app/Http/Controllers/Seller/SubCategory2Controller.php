<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Str;
use Auth;
use App\Models\Category;

class SubCategory2Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subCategoryLists = Category::with(['category_data'])
                                    ->whereHas('category_data', function($q){
                                        $q->where('level', 1);
                                    })
                                    ->where('level', 2)
                                   
                                    ->orderBy('created_at','DESC')
                                    ->get();

        return view('seller.subcategory2.index', compact('subCategoryLists'));
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

        return view('seller.subcategory2.create', compact('categoryData'));
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
            'sub_category' => 'required|exists:categories,id',
            'sub_category2_name' => 'required|max:60',
        ]);

        if($validator->fails()){ // Validation fails
            $message = $validator->errors()->first();
        }
        else{

            $name = trim($request->sub_category2_name);
            $slug = Str::slug($name);

            $check_category_name = Category::where('slug', $slug)
                                            ->where('parent_id', $request->sub_category)
                                            ->where('level', 2)
                                           
                                            ->count();

            if($check_category_name == 0){ // Same sub category name not exist so insert it

                $sub_category = new Category();
                $sub_category->parent_id = $request->sub_category;
                $sub_category->level = 2;
                $sub_category->name = $name;
                $sub_category->slug = $slug;
                
                try{
                    $sub_category->save();
                    $success = true;
                    $message =  __("messages.sub_category2_store_success");
                }
                catch(\Exception $e){
                }
            }
            else{ // Same sub category name is exist
                $message = __('messages.sub_category2_exist');
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

        $subCategory2Data = Category::with(['category_data'])
                                    ->where('id', $id)
                                    ->where('level', 2)
                                   
                                    ->first();
        
        $subCategoryData = $subParentData = array();
        
        if(isset($subCategory2Data) && isset($subCategory2Data->id)){
            $subCategoryData = Category::select('id', 'parent_id' ,'name')
                                        ->where('id', $subCategory2Data->parent_id)
                                        ->where('status', 'Active')
                                        ->where('level', 1)
                                       
                                        ->orderBy('name','ASC')
                                        ->first();

            $subParentData = Category::select('id', 'name')
                                        ->where('parent_id', $subCategoryData->parent_id)
                                        ->where('status', 'Active')
                                        ->where('level', 1)
                                       
                                        ->orderBy('name','ASC')
                                        ->get();
        }

        return view('seller.subcategory2.edit', compact('categoryData', 'subCategory2Data', 'subCategoryData', 'subParentData'));
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
            'sub_category' => 'required|exists:categories,id',
            'sub_category2_name' => 'required|max:60',
            'status' => 'required|in:Active,Inactive'
        ]);

        if($validator->fails()){ // Validation fails
            $message = $validator->errors()->first();
        }
        else{

            $parent_id = $request->sub_category;
            $name = trim($request->sub_category2_name);
            $slug = Str::slug($name);

            $check_sub_category_name = Category::where('id', '!=', $id)
                                                ->where('parent_id', $parent_id)
                                                ->where('slug', $slug)
                                                ->where('level', 2)
                                               
                                                ->count();

            if($check_sub_category_name == 0){ // Same sub category name not exist with same parent_id so insert it

                $sub_category = Category::find($id);

                if(isset($sub_category) && !empty($sub_category) && isset($sub_category->id)){
                    $sub_category->parent_id = $parent_id;
                    $sub_category->name = $name;
                    $sub_category->slug = $slug;
					$sub_category->SEO_description = $request->SEO_description;
                    $sub_category->SEO_tags = $request->SEO_tags;
                    $sub_category->status = $request->status;
                    
                    try{
                        $sub_category->save();
                        $success = true;
                        $message = __('messages.sub_category2_update_success');
                    }
                    catch(\Exception $e){
                    }
                }
                else{
                    $message = __('messages.sub_category2_invalid');
                }
            }
            else{ // Same sub category name is exist with same category id
                $message = __('messages.sub_category2_exist');
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
                        ->where('level', 2)
                        ->first();
                                    
        if(isset($cat) && !empty($cat) && isset($cat->id)){
            try{
                $cat->delete();
                return redirect()->back()->with('success', __('messages.sub_category2_delete_success'));
            }
            catch(\Exception $e){
                return redirect()->back()->with('danger', __('messages.exception_error'));
            }
        }
        else{
            return redirect()->back()->with('danger', __('messages.sub_category2_invalid'));
        }
    }

    public function sub_category2_name($id){

        $success = false;
        $message = __("messages.exception_error");
        $data = array();

        $subCategory2Data = Category::select('id', 'name')
                                    ->where('parent_id', $id)
                                    ->where('status', 'Active')
                                   
                                    ->orderBy('name','ASC')
                                    ->get();

        if(isset($subCategory2Data) && !empty($subCategory2Data) && $subCategory2Data->isNotEmpty()){
            $success = true;
            $message = __("messages.data_found");
            $data = $subCategory2Data;
        }
        else{
            $message = __("messages.sub_category2_data_not_found");
        }

        return response()->json(['success' => $success, 'message' => $message, 'data' => $data]);
    }
}
