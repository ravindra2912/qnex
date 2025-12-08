<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use DataTables;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Testimonial::select('*');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<div class="btn-group" role="group">
                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                Action
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="' . route('admin.testimonials.edit', $row->id) . '">Edit</a>
                                <button class="dropdown-item btn_delete-' . $row->id . '" onclick="destroy(\'' . route('admin.testimonials.destroy', $row->id) . '\',\'' . $row->id . '\')">Delete <span id="loader" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span><span id="buttonText"></span></button>
                            </div>
                        </div>';
                    return $btn;
                })
                ->editColumn('image', function ($row) {
                    return '<img class="img-thumbnail" src="' . getImage($row->image) . '" alt="" width="100px">';
                })
                ->editColumn('status', function ($row) {
                    return $row->status == 'active'
                        ? '<span class="badge badge-success">Active</span>'
                        : '<span class="badge badge-danger">Inactive</span>';
                })
                ->rawColumns(['action', 'image', 'status'])
                ->make(true);
        }
        return view('admin.testimonial.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.testimonial.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required',
            'designation' => 'required',
            'review' => 'required',
            'rating' => 'required|integer|min:1|max:5',
            'status' => 'required',
        ]);

        $input = $request->all();

        if ($request->hasFile('image')) {
            $input['image'] = fileUploadStorage($request->file('image'), 'testimonial_images', 500, 500);
        }

        Testimonial::create($input);

        return response()->json(['success' => true, 'message' => 'Testimonial created successfully.']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonial.edit', compact('testimonial'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Testimonial $testimonial)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required',
            'designation' => 'required',
            'review' => 'required',
            'rating' => 'required|integer|min:1|max:5',
            'status' => 'required',
        ]);

        $input = $request->all();

        if ($request->hasFile('image')) {
            fileRemoveStorage($testimonial->image);
            $input['image'] = fileUploadStorage($request->file('image'), 'testimonial_images', 500, 500);
        }

        $testimonial->update($input);

        return response()->json(['success' => true, 'message' => 'Testimonial updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function destroy(Testimonial $testimonial)
    {
        fileRemoveStorage($testimonial->image);
        $testimonial->delete();

        return response()->json(['success' => true, 'message' => 'Testimonial deleted successfully.']);
    }
}
