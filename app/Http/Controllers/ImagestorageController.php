<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImagestorageController extends Controller
{
    public function create() {
        $images = Image::all();
        return view('create', ['images' => $images]);
    }
    public function store(Request $request){
        $extension = $request->file('imgupload')->extension();
        $imgname = date('dmyHis').'.'.$extension;
        $this->validate($request, [ 'imgupload' => 'required|file|max:5000']);
        $path = storage::putFileAs('public/images', $request->file('imgupload'), $imgname);
        Image::create([ 'path' => $imgname]);
        return redirect()->back()->withSuccess("Image success to be uploaded in " . $path);
    }
}
