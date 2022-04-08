<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Photo;
 
 
class UploadImageController extends Controller
{
    public function index()
    {
        return view('image');
    }
 
    public function save(Request $request)
    {
        // $validatedData = $request->validate([
        //  'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
 
        // ]);
 
        $name = $request->file('image')->getClientOriginalName();
 
        $path = $request->file('image')->store('public/images');
 
 
        $save = new Photo;
 
        $save->name = $name;
        $save->path = $path;
        
        $save->save();

        return response()->json($save->id);
        // return redirect('upload-image')->with('status', 'Image Has been uploaded');
 
    }

    public function deleteImage($image_id){
        var_dump('dit is de functie die je zoekt.');
        $image = Photo::where('id', $image_id)->get();

        var_dump('dit is de image 0 path die je zoekt.');
        var_dump($image[0]['name']);
        $contents = Storage::disk('local')->get($image[0]['name']);

        $image->delete();
    }
}
