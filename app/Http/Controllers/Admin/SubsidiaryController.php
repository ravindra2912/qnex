<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subsidiary;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Validator;

class SubsidiaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Subsidiary::select('*');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<div class="btn-group" role="group">
                            <a href="' . route('admin.subsidiaries.edit', $row->id) . '" class="btn btn-info btn-sm">Edit</a>
                            <button type="button" class="btn btn-danger btn-sm btn_delete-' . $row->id . '" onclick="destroy(\'' . route('admin.subsidiaries.destroy', $row->id) . '\',' . $row->id . ')">
                            <span id="loader" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                            <span id="buttonText">Delete</span>
                            </button>
                            </div>';
                    return $btn;
                })
                ->editColumn('image', function ($row) {
                    return '<img class="img-thumbnail" src="' . getImage($row->image) . '" alt="" width="100px">';
                })
                ->editColumn('description', function ($row) {
                    return \Illuminate\Support\Str::limit($row->description, 50);
                })
                ->editColumn('status', function ($row) {
                    if ($row->status == 'active') {
                        return '<span class="badge badge-success">Active</span>';
                    } else {
                        return '<span class="badge badge-danger">Inactive</span>';
                    }
                })
                ->rawColumns(['action', 'image', 'status'])
                ->make(true);
        }
        return view('admin.subsidiary.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.subsidiary.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'status' => 'required|in:active,in-active',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->all()
            ]);
        }

        $input = $request->all();

        if ($request->hasFile('image')) {
            $input['image'] = fileUploadStorage($request->image, 'subsidiary_images', 300, 300);
        }

        Subsidiary::create($input);

        return response()->json(['success' => true, 'message' => 'Subsidiary Created Successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subsidiary  $subsidiary
     * @return \Illuminate\Http\Response
     */
    public function show(Subsidiary $subsidiary)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subsidiary  $subsidiary
     * @return \Illuminate\Http\Response
     */
    public function edit(Subsidiary $subsidiary)
    {
        return view('admin.subsidiary.edit', compact('subsidiary'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subsidiary  $subsidiary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subsidiary $subsidiary)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'status' => 'required|in:active,in-active',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->all()
            ]);
        }

        $input = $request->except(['_token', '_method']);

        if ($request->hasFile('image')) {
            $input['image'] = fileUploadStorage($request->image, 'subsidiary_images', 300, 300);
            fileRemoveStorage($subsidiary->image);
        }

        $subsidiary->update($input);

        return response()->json(['success' => true, 'message' => 'Subsidiary Updated Successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subsidiary  $subsidiary
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subsidiary $subsidiary)
    {
        fileRemoveStorage($subsidiary->image);
        $subsidiary->delete();
        return response()->json(['success' => true, 'message' => 'Subsidiary Deleted Successfully.']);
    }
}
