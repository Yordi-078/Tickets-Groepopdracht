<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Models\Photo;
use App\Models\Files;
use App\Models\Card;

 
 
class UploadImageController extends Controller
{
    public function index()
    {
        return view('image');
    }
 
    public function saveImage(Request $request)
    {
        $validatedData = $request->validate([
         'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
 
        ]);
 
        $name = $request->file('image')->getClientOriginalName();
        $path = $request->file('image')->store('public/images');
 
        $save = new Photo;
 
        $save->name = $name;
        $save->path = $path;
        $save->save();

        return response()->json($save->id);
    }

    public function deleteUserImage(){
        $user = User::where('id', auth()->id())->get();
        $image = Photo::where('id', $user[0]['image'])->get();

        $path = $image[0]['path'];
        Storage::disk('local')->delete('' .$path); 
        Photo::where('id', $user[0]['image'])->delete();
        User::updateOrCreate(
            [
                "id" => auth()->id()
            ],[
                "image" => NULL,
            ]
        );
    }

    public function deleteImage($card_id){
        $card = Card::where('id', $card_id)->get();
        $image = Photo::where('id', $card[0]['image'])->get();

        $path = $image[0]['path'];
        Storage::disk('local')->delete('' .$path); 
        Photo::where('id', $card[0]['image'])->delete();
        Card::updateOrCreate(
            [
                "id" => $card_id
            ],[
                "image" => NULL,
            ]
        );
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
    
        return $response;
    }
}