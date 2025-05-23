<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Str;
use Validator;
use Auth;
use File;
use Image;
use App\Models\Category;
//use App\Models\SubCategory;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categoryLists = Category::where('parent_id', null)
            ->where('level', 0)

            ->orderBy('created_at', 'DESC')
            ->get();

        return view('seller.category.index', compact('categoryLists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('seller.category.create');
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
            'category_name' => 'required|max:60',
            'category_image' => 'required|mimes:jpg,jpeg,png,svg|max:5120', // 5 MB images
            'banner_img' => 'nullable|mimes:jpg,jpeg,png,svg|max:5120', // 5 MB images
        ]);

        if ($validator->fails()) { // Validation fails
            $message = $validator->errors()->first();
        } else {
            $name = trim($request->category_name);
            $slug = Str::slug($name);

            $check_category_name = Category::where('parent_id', null)
                ->where('level', 0)
                ->where('slug', $slug)

                ->count();

            if ($check_category_name == 0) { // Same category name not exist so insert it

                $imgpath = fileUploadStorage($request->file('category_image'), 'category_image');

                $category = new Category();

                if ($request->hasfile('banner_img')) {
                    $bannerimgpath = fileUploadStorage($request->file('banner_img'), 'category_image');
                    $category->banner_img = $bannerimgpath;
                }


                // $category->parent_id = 0;
                $category->level = 0;
                $category->image = $imgpath;
                $category->slug = $slug;
                $category->name = $name;

                try {
                    $category->save();
                    $success = true;
                    $message =  __("messages.category_store_success");
                } catch (\Exception $e) {
                    $message = $e->getMessage();
                    $message = $e->getMessage();
                    // Remove new uploaded image if exist
                    fileRemoveStorage($imgpath);
                    fileRemoveStorage($bannerimgpath);
                }
            } else { // Same category name is exist
                $message = __('messages.category_exist');
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
        $categoryData = Category::where('id', $id)
            ->where('parent_id', null)
            ->where('level', 0)
            ->first();

        return view('seller.category.edit', compact('categoryData'));
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
        $redirect = route('category.index');

        $rules = [
            'category_name' => 'required|max:60',
            'banner_img' => 'nullable|mimes:jpg,jpeg,png,svg|max:5120', // 5 MB images
            'status' => 'required|in:Active,Inactive'
        ];

        // Check category image field is empty or not
        if (!empty($request->category_image)) {
            $rules['category_image'] = 'required|mimes:jpg,jpeg,png,svg|max:5120';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) { // Validation fails
            $message = $validator->errors()->first();
        } else {

            $name = trim($request->category_name);
            $slug = Str::slug($name);

            $check_category_name = Category::where('id', '!=', $id)
                ->where('parent_id', 0)
                ->where('level', 0)
                ->where('slug', $slug)

                ->count();

            if ($check_category_name == 0) { // Same category name not exist so update it

                $category = Category::where('id', $id)
                    ->where('parent_id', null)
                    ->where('level', 0)
                    ->first();

                if (isset($category) && !empty($category) && isset($category->id)) {

                    if ($request->hasfile('category_image')) {
                        $oldimg = $category->image;
                        $imgpath = fileUploadStorage($request->file('category_image'), 'category_image');
                        $category->image = $imgpath;
                    }

                    if ($request->hasfile('banner_img')) {
                        $oldbannerimgpath = $category->banner_img;
                        $bannerimgpath = fileUploadStorage($request->file('banner_img'), 'category_image');
                        $category->banner_img = $bannerimgpath;
                    }

                    $category->name = $name;
                    $category->slug = $slug;
                    $category->SEO_description = $request->SEO_description;
                    $category->SEO_tags = $request->SEO_tags;
                    $category->status = $request->status;

                    try {
                        $category->save();

                        // Remove old image from folder if exist
                        if (isset($oldimg) && !empty($oldimg)) {
                            fileRemoveStorage($oldimg);
                        }
                        if (isset($oldbannerimgpath) && !empty($oldbannerimgpath)) {
                            fileRemoveStorage($oldbannerimgpath);
                        }

                        $success = true;
                        $message =  __("messages.category_update_success");
                    } catch (\Exception $e) {
                        $message = $e->getMessage();

                        // Remove new uploaded image if exist
                        fileRemoveStorage($imgpath);
                        fileRemoveStorage($bannerimgpath);
                    }
                } else {
                    $message = __('messages.category_invalid');
                }
            } else { // Same category name is exist
                $message = __('messages.category_exist');
            }
        }

        return response()->json(['success' => $success, 'message' => $message, 'data' => $data, 'redirect' => $redirect]);
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
            ->where('parent_id', null)
            ->where('level', 0)
            ->first();


        if (isset($cat) && !empty($cat) && isset($cat->id)) {
            try {

                $subcat = Category::where('parent_id', $cat->id)->get();

                if (count($subcat) > 0) {
                    foreach ($subcat as $val) {
                        $subcat2 = Category::where('parent_id', $val->id)->get();
                        if (count($subcat2) > 0) {
                            foreach ($subcat2 as $val2) {
                                Category::find($val2->id)->delete();
                            }
                        }
                        Category::find($val->id)->delete();
                    }
                }

                // Remove image from folder if exist
                fileRemoveStorage($cat->image);
                fileRemoveStorage($cat->banner_img);

                $cat->delete();
                return redirect()->back()->with('success', __('messages.category_delete_success'));
            } catch (\Exception $e) {
                $message = $e->getMessage();
                //return redirect()->back()->with('danger', __('messages.exception_error'));
                return redirect()->back()->with('danger', $e->getMessage());
            }
        } else {
            return redirect()->back()->with('danger', __('messages.category_invalid'));
        }
    }

    public function category_name()
    {

        $success = false;
        $message = __("messages.exception_error");
        $data = array();

        $categoryData = Category::select('id', 'name')
            ->where('parent_id', 0)
            ->where('level', 0)
            ->where('status', 'Active')

            ->orderBy('name', 'ASC')
            ->get();

        if (isset($categoryData) && !empty($categoryData) && $categoryData->isNotEmpty()) {
            $success = true;
            $message = __("messages.data_found");
            $data = $categoryData;
        } else {
            $message = __("messages.category_data_not_found");
        }

        return response()->json(['success' => $success, 'message' => $message, 'data' => $data]);
    }
}
