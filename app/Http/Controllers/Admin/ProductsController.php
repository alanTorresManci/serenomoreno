<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;

class ProductsController extends Controller
{
    //
    public function __construct() {
        $this->section = "products";
    }
    public function index() {

        return view('admin.products.index')
                ->with([
                    'products' => Product::all(),
                    'section' => $this->section,
                ]);
    }

    public function create() {

        return view('admin.products.create')
        ->with([
            'section' => $this->section,
        ]);
    }

    public function show($id) {
        $content = Product::findOrFail($id);

        return view('admin.products.show')
        ->with([
            'content' => $content,
            'section' => $this->section,
        ]);
    }

    public function store(Request $request) {
        $rules = [
            'title' => 'required',
            'description' => 'required',
            'image' => 'required|image',
        ];
        $request->validate($rules);

        $data = [
            'title' => $request->title,
            'description' => $request->description,
        ];
        if ($request->hasFile('image')) {
            if ($request->file('image')->isValid()) {
                //
                $extension = $request->image->extension();
                $newName = "product" . date('mdYHis') . uniqid() . "." . $extension;
                $request->image->storeAs('public/'.config('constants.base_image_path'), $newName);
                $data['image'] = $newName;
                $content = Product::create($data);

                return redirect()->route('products.show', $content);
            }
        }
    }

    public function update($id, Request $request) {
        $rules = [
            'title' => 'required',
            'description' => 'required',
            'image' => 'image',
        ];
        $request->validate($rules);
        $content = Product::findOrFail($id);
        $content->update($request->except(['image']));
        if ($request->hasFile('image')) {
            if ($request->file('image')->isValid()) {
                //
                $extension = $request->image->extension();
                $newName = "product" . date('mdYHis') . uniqid() . "." . $extension;
                $request->image->storeAs('public/'.config('constants.base_image_path'), $newName);
                $content->image = $newName;
                $content->save();
            }
        }
        return back();

    }

    public function destroy($id) {
        $content = Product::findOrFail($id);
        $content->delete();

        return back();
    }
}
