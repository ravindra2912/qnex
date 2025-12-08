<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class StaffController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Staff::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('img', function ($row) {
                    return '<div class="text-center"><img src="' . getImage($row->image) . '" class="table_img" /></div>';
                })
                ->addColumn('action', function ($row) {
                    $url = route('admin.staff.destroy', $row->id);
                    $url = "'" . $url . "'";
                    return ' <div class="text-center">
                    <a href="' . route('admin.staff.edit', $row->id) . '" class="btn btn-outline-primary btn-sm" title="edit"><i class="far fa-edit"></i></a>
                    <button onclick="destroy(' . $url . ', ' . $row->id . ')" class="btn btn-outline-danger btn-sm btn_delete-' . $row->id . '" title="Delete">
                        <i id="buttonText" class="far fa-trash-alt"></i>
                        <span id="loader" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                    </button>
                    </div>';
                })
                ->rawColumns(['action', 'img'])
                ->make(true);
        }
        return view('admin.staff.index');
    }

    public function create()
    {
        return view('admin.staff.create');
    }

    public function store(Request $request)
    {
        $success = false;
        $message = 'Something Wrong!';
        $redirect = route('admin.staff.index');
        $data = array();

        try {
            $rules = [
                'name' => 'required',
                'position' => 'required',
                'image' => 'nullable|mimes:jpg,jpeg,png,webp',
                'status' => 'required',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $message = $validator->errors();
            } else {
                $insert = new Staff();
                if ($request->hasFile('image')) {
                    $image_name = fileUploadStorage($request->file('image'), 'staff_images', 500, 500);
                    $insert->image = $image_name;
                }
                $insert->name = $request->name;
                $insert->position = $request->position;
                $insert->facebook_url = $request->facebook_url;
                $insert->linkedin_url = $request->linkedin_url;
                $insert->x_url = $request->x_url;
                $insert->status = $request->status;
                $insert->save();

                $success = true;
                $message = 'Staff added successfully.';
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
        $staff = Staff::find($id);
        return view('admin.staff.edit', compact('staff'));
    }

    public function update(Request $request, $id)
    {
        $success = false;
        $message = 'Something Wrong!';
        $redirect = route('admin.staff.index');
        $data = array();

        try {
            $rules = [
                'name' => 'required',
                'position' => 'required',
                'image' => 'nullable|mimes:jpg,jpeg,png,webp',
                'status' => 'required',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $message = $validator->errors();
            } else {
                $update = Staff::find($id);
                if ($request->hasFile('image')) {
                    $oldimage = $update->image;
                    $image_name = fileUploadStorage($request->file('image'), 'staff_images', 500, 500);
                    $update->image = $image_name;
                    if (isset($oldimage)) {
                        fileRemoveStorage($oldimage);
                    }
                }
                $update->name = $request->name;
                $update->position = $request->position;
                $update->facebook_url = $request->facebook_url;
                $update->linkedin_url = $request->linkedin_url;
                $update->x_url = $request->x_url;
                $update->status = $request->status;
                $update->save();

                $success = true;
                $message = 'Staff updated successfully.';
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
        $redirect = route('admin.staff.index');
        $data = array();

        try {
            $delete = Staff::find($id);
            if ($delete) {
                if ($delete->image) {
                    fileRemoveStorage($delete->image);
                }
                $delete->delete();
                $success = true;
                $message = 'Staff deleted successfully.';
            }
        } catch (\Exception $e) {
            $message = $e->getMessage();
        }
        return response()->json(['success' => $success, 'message' => $message, 'data' => $data, 'redirect' => $redirect]);
    }
}
