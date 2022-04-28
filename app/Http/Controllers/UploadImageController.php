<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
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
        $image = Photo::where('id', $image_id)->get();

        var_dump('dit is de image 0 path die je zoekt.');
        var_dump($image[0]['name']);
        $contents = Storage::disk('local')->get($image[0]['name']);

        $image->delete();
    }

    public function displayImage($image_id){
        $filename = Photo::where('id', $image_id)->get();

        $path = $filename[0]['path'];
        if (!Storage::exists($path)) {
            abort(404);
        }
        $file = Storage::get($path);
    
        $type = Storage::mimeType($path);
        $response = Response::make($file, 200);
        
    
        $response->header("Content-Type", $type);

        // dd($response);
        return $response;
        // return response()->json($response);
    }
}

        // $filename = Photo::where('id', $image_id)->get();

        // $path = $filename[0]['path'];
        // if (!Storage::exists($path)) {
        //     abort(404);
        // }
        // $file = Storage::get($path);
    
        // $type = Storage::mimeType($path);
        // $response = Response::make($file, 200);
    
        // $response->header("Content-Type", $type);

        // dd($response);

        
        // $filename = Photo::where('id', $image_id)->get();

        // $path = $filename[0]['path'];
        // if (!Storage::exists($path)) {
        //     abort(404);
        // }
        // $file = Storage::get($path);
    
        // $type = Storage::mimeType($path);
        // $response = JsonResponse::fromJsonString($file, 200);
    
        // $response->header("Content-Type", $type);

        // dd($response);
        // // return $response;
        // return response()->json($response);