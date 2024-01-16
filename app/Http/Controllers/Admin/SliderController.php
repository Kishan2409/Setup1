<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class SliderController extends Controller
{
    public $module_name = 'Slider';
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        if ($request->ajax()) {

            $slidermaster = Slider::query();

            return DataTables::eloquent($slidermaster)
                ->addColumn('action', function ($s) {

                    $editUrl = url('admin/slider/edit', encrypt($s->id));

                    $deleteUrl = url('admin/slider/delete', encrypt($s->id));

                    $viewUrl = url('admin/slider/show', encrypt($s->id));

                    $actions = '';

                    $actions .= "<a href='" . $editUrl . "' class='btn btn-primary btn-sm m-1 text-decoration-none '><i class='fas fa-pencil-alt'></i> Edit</a>";
                    $actions .= "<a href='" . $viewUrl . "' class='btn btn-success btn-sm m-1 text-decoration-none '><i class='fas fa-eye'></i> View</a>";
                    $actions .= "<a href='" . $deleteUrl . "' class='btn btn-danger btn-sm m-1 text-decoration-none  delete' id='delete' data-id='" . $s->id . "'><i class='fa-regular fa-trash-can'></i> Delete</a>";

                    if ($s->status == 0) {
                        $actions .= " <a id='activate' href='#' class='activate btn btn-warning text-decoration-none btn-sm ' data-id='" . $s->id . "'><i class='fa-solid fa-check'></i> Active</a>";
                    } else {
                        $actions .= " <a id='deactivate' href='#'class='deactivate btn btn-warning btn-sm  text-decoration-none ' data-id='" . $s->id . "'><i class='fa-solid fa-ban'></i> Inactive</a>";
                    }

                    return $actions;
                })
                ->addColumn('image', function ($s) {

                    return '<img src="' . url('public/storage/slider/' . $s->image) . '" class="ms-2" style="height: 100px;width: 100px;">';
                })
                ->editColumn('status', function ($sm) {
                    if ($sm->status == 0) {
                        return "<center><span class='badge badge-danger'>Inactive</span></center>";
                    } else {
                        return "<center><span class='badge badge-success'>Active</span></center>";
                    }
                })
                ->filter(function ($data) use ($request) {
                    if ($request->get('status') == '0' || $request->get('status') == '1') {
                        $data->where('status', $request->get('status'));
                    }
                    if (!empty($request->get('search'))) {
                        $data->where(function ($wordsearch) use ($request) {
                            $search = $request->get('search');
                            $wordsearch->orWhere('title', 'LIKE', "%$search%")
                                ->orWhere('description', 'LIKE', "%$search%");
                        });
                    }
                })
                ->rawColumns(['action', 'image', 'status'])
                ->addIndexColumn()
                ->make(true);
        }
        $module_name = $this->module_name;
        return view('admin.slider.index', compact('module_name'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $module_name = $this->module_name;
        return view('admin.slider.form', compact('module_name'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        if ($request->hasFile('image')) {
            if (!Storage::exists(storage_path('app/public/slider'))) {
                Storage::disk('public')->makeDirectory('slider');
            }
            $image =  rand(10000, 99999) . "." . $request->file('image')->getClientOriginalExtension();
            $imagepath = $request->file('image')->move('storage/app/public/slider', $image);
        }

        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'image' => $image,
            'status' => $request->status,
            'added_by' => auth()->user()->id
        ];

        Slider::create($data);

        return redirect('admin/slider')->with('success', $this->module_name . ' Create  Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $module_name = $this->module_name;
        $data = Slider::where('id', decrypt($id))->first();
        return view('admin.slider.show',  compact('module_name', 'data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //

        $module_name = $this->module_name;
        $data = Slider::where('id', decrypt($id))->first();
        return view('admin.slider._form',  compact('module_name', 'data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $slider = Slider::where('id', decrypt($id))->first();
        if ($request->hasFile('image')) {
            if (File::exists(storage_path('app/public/slider/' . $slider->image))) {
                File::delete(storage_path('app/public/slider/' . $slider->image));
            }
            $image = rand(10000, 99999) . "." . $request->file('image')->getClientOriginalExtension();
            $imagepath = $request->file('image')->move('storage/app/public/slider', $image);
        } else {
            $image = $slider->image;
        }

        Slider::where('id', decrypt($id))->update(
            [
                'title' => $request->title,
                'description' => $request->description,
                'image' => $image,
                'status' => $request->status,
                'updated_by' => auth()->user()->id
            ]
        );

        return redirect('admin/slider')->with('success', $this->module_name . ' Update Successfully !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        //
        $id = $request->id;
        $data = Slider::where('id', $id)->first();
        if (File::exists(storage_path('app/public/slider/' . $data->image))) {
            File::delete(storage_path('app/public/slider/' . $data->image));
        }
        $data->delete();
        return response()->json(['status' => true]);
    }

    public function status(Request $request)
    {
        $id = $request->id;
        $slider = Slider::where('id', $id)->first();

        if ($slider->status == 1) {

            Slider::where('id', $id)->update(['status' => 0]);

            return response()->json([
                'status' => true
            ]);
        } else {
            Slider::where('id', $id)->update(['status' => 1]);

            return response()->json([
                'status' => true
            ]);
        }
    }
}
