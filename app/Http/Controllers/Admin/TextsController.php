<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Models\Text;

class TextsController extends Controller
{
    //
    public function __construct() {
        $this->section = "texts";
    }
    public function index() {

        return view('admin.texts.index')
                ->with([
                    'texts' => Text::all(),
                    'section' => $this->section,
                ]);
    }

    public function show($id) {
        $content = Text::findOrFail($id);

        return view('admin.texts.show')
        ->with([
            'content' => $content,
            'section' => $this->section,
        ]);
    }

    public function update($id, Request $request) {
        $rules = [
            'title' => 'required',
            'text' => 'required',
            'image' => 'image',
        ];
        $request->validate($rules);
        $content = Text::findOrFail($id);
        $content->update($request->except(['image']));
        if ($request->hasFile('image')) {
            if ($request->file('image')->isValid()) {
                //
                $extension = $request->image->extension();
                $newName = "text" . date('mdYHis') . uniqid() . "." . $extension;
                $request->image->storeAs('public/'.config('constants.base_image_path'), $newName);
                $content->image = $newName;
                $content->save();
            }
        }
        return back();

    }
}
