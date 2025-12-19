<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Product::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('img', function ($row) {
                    return '<div class="text-center"><img src="' . getImage($row->image) . '" class="table_img" /></div>';
                })
                ->addColumn('action', function ($row) {
                    $url = route('admin.products.destroy', $row->id);
                    $url = "'" . $url . "'";
                    return ' <div class="text-center">
                    <a href="' . route('admin.products.edit', $row->id) . '" class="btn btn-outline-primary btn-sm" title="edit"><i class="far fa-edit"></i></a>
                    <button onclick="destroy(' . $url . ', ' . $row->id . ')" class="btn btn-outline-danger btn-sm btn_delete-' . $row->id . '" title="Delete">
                        <i id="buttonText" class="far fa-trash-alt"></i>
                        <span id="loader" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                    </button>
                    </div>';
                })
                ->rawColumns(['action', 'img'])
                ->make(true);
        }
        return view('admin.products.index');
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $success = false;
        $message = 'Something Wrong!';
        $redirect = route('admin.products.index');
        $data = array();

        try {
            $rules = [
                'name' => 'required',
                'image' => 'nullable|mimes:jpg,jpeg,png,webp',
                'status' => 'required',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $message = $validator->errors();
            } else {
                $insert = new Product();
                if ($request->hasFile('image')) {
                    $image_name = fileUploadStorage($request->file('image'), 'product_images', 800, 800);
                    $insert->image = $image_name;
                }
                $insert->name = $request->name;
                $insert->status = $request->status;
                $insert->save();

                $success = true;
                $message = 'Product added successfully.';
            }
        } catch (\Exception $e) {
            $message = $e->getMessage();
            if (isset($image_name) && !empty($image_name)) {
                fileRemoveStorage($image_name);
            }
        }
        return response()->json(['success' => $success, 'message' => $message, 'data' => $data, 'redirect' => $redirect]);
    }

    public function edit($id)
    {
        $product = Product::find($id);
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $success = false;
        $message = 'Something Wrong!';
        $redirect = route('admin.products.index');
        $data = array();

        try {
            $rules = [
                'name' => 'required',
                'image' => 'nullable|mimes:jpg,jpeg,png,webp',
                'status' => 'required',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $message = $validator->errors();
            } else {
                $update = Product::find($id);
                if ($request->hasFile('image')) {
                    $oldimage = $update->image;
                    $image_name = fileUploadStorage($request->file('image'), 'product_images', 800, 800);
                    $update->image = $image_name;
                    if (isset($oldimage)) {
                        fileRemoveStorage($oldimage);
                    }
                }
                $update->name = $request->name;
                $update->status = $request->status;
                $update->save();

                $success = true;
                $message = 'Product updated successfully.';
            }
        } catch (\Exception $e) {
            $message = $e->getMessage();
            if (isset($image_name) && !empty($image_name)) {
                fileRemoveStorage($image_name);
            }
        }
        return response()->json(['success' => $success, 'message' => $message, 'data' => $data, 'redirect' => $redirect]);
    }

    public function destroy($id)
    {
        $success = false;
        $message = 'Something Wrong!';
        $redirect = route('admin.products.index');
        $data = array();

        try {
            $delete = Product::find($id);
            if ($delete) {
                if ($delete->image) {
                    fileRemoveStorage($delete->image);
                }
                $delete->delete();
                $success = true;
                $message = 'Product deleted successfully.';
            }
        } catch (\Exception $e) {
            $message = $e->getMessage();
        }
        return response()->json(['success' => $success, 'message' => $message, 'data' => $data, 'redirect' => $redirect]);
    }
}
