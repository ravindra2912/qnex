<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Client::select('*');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<div class="btn-group" role="group">
                            <a href="' . route('admin.clients.edit', $row->id) . '" class="btn btn-info btn-sm">Edit</a>
                            <button type="button" class="btn btn-danger btn-sm btn_delete-' . $row->id . '" onclick="destroy(\'' . route('admin.clients.destroy', $row->id) . '\',' . $row->id . ')">
                            <span id="loader" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                            <span id="buttonText">Delete</span>
                            </button>
                            </div>';
                    return $btn;
                })
                ->editColumn('image', function ($row) {
                    return '<img class="img-thumbnail" src="' . getImage($row->image) . '" alt="" width="100px">';
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
        return view('admin.client.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.client.create');
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
            $input['image'] = fileUploadStorage($request->image, 'client_images', 155, 30);
        }

        Client::create($input);

        return response()->json(['success' => true, 'message' => 'Client Created Successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        return view('admin.client.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
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
            $input['image'] = fileUploadStorage($request->image, 'client_images', 155, 30);
            fileRemoveStorage($client->image);
        }

        $client->update($input);

        return response()->json(['success' => true, 'message' => 'Client Updated Successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        fileRemoveStorage($client->image);
        $client->delete();
        return response()->json(['success' => true, 'message' => 'Client Deleted Successfully.']);
    }
}
