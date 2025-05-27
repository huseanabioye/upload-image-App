<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $photos = Photo::where('user_id', Auth::id())->get();
        return view('photos.index', compact('photos'));
    }

    public function create()
    {
        return view('photos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // $filename = time() . '.' . $request->photo->getClientOriginalExtension();
        // $request->photo->storeAs('public/photos', $filename);
        $filename = $request->file('photo')->store('photos', 'public');

        Photo::create([
            'title' => $request->title,
            'description' => $request->description,
            'filename' => $filename,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('photos.index')->with('success', 'Photo uploaded successfully.');
    }

    public function show(Photo $photo)
    {
        if ($photo->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('photos.show', compact('photo'));
    }

    public function destroy(Photo $photo)
    {
        if ($photo->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        Storage::delete('public/photos/' . $photo->filename);
        $photo->delete();

        return redirect()->route('photos.index')->with('success', 'Photo deleted successfully.');
    }
}
