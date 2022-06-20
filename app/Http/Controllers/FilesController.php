<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Models\Files;

class FilesController extends Controller
{
    //
    public function saveFile(Request $request)
    {
        $validatedData = $request->validate([
         'file' => 'required|mimes:pdf,xls,doc|max:2048',
        ]);
 
        $name = $request->file('file')->getClientOriginalName();
 
        $path = $request->file('file')->store('public/files');
 
 
        $save = new Files;
 
        $save->name = $name;
        $save->path = $path;
        
        $save->save();

        return response()->json($save->id);
    }
}
