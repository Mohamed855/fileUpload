<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\File;

class FilesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
        return redirect() -> route('home')->with([
            'files' => File::where('user_id', auth()->user()->id)->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        return view('drive.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fileName = auth()->user()->id . '-' . time() . '.' . $request->file->extension();
        $fileType = $request->file->getClientMimeType();
        $fileSize = $request->file->getSize();

        $request->file->move(public_path('files'), $fileName);

        File::create([
            'user_id' => auth()->user()->id,
            'name' => $fileName,
            'type' => $fileType,
            'size' => $fileSize,
        ]);

        return redirect()->route('home')->with([
            'successMessage' => 'File Uploaded Successfully'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('drive.show') -> with('file', File::where('id', $id)-> first());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $name)
    {
        File::where('name', $name)->delete();
        unlink(public_path('files/' . $name));
        return redirect()->route('home')->with([
           'deleteMessage' => 'File Deleted Successfully',
        ]);
    }
}
