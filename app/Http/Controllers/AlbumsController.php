<?php

namespace App\Http\Controllers;

use App\Album;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class AlbumsController extends Controller
{    
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $albums = Album::with('photos')->get();
        return view('album.index', [
            'albums' => $albums
        ]);
    }
    
    /**
     * create
     *
     * @return void
     */
    public function create()
    {
        return view('album\create');
    }

    public function show(Album $album)
    {
        return view('photo.index', [
            'album' => $album
        ]);
    }
    
    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'cover_img' => 'required|max:1999'
        ]);

        // Get filename with extension
        $filenameWithExt = $request->file('cover_img')->getClientOriginalName();

        // Get just the filename
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

        // Get extension
        $extension = $request->file('cover_img')->getClientOriginalExtension();

        // Create new filename
        $filenameToStore = $filename . '_' . time() . '.' .$extension;

        // Create Path
        $destinationPath = public_path("storage\album_covers");

        // Upload image
        $path = $request->file('cover_img')->move($destinationPath, $filenameToStore);
        $image = Image::make($path)->fit(1200, 1200);
        $image->save();
        
        // return $request->all();
        $album = new Album;
        $album->name = $request->name;
        $album->description = $request->description;
        $album->cover_image = $filenameToStore;
        $album->save();

        return redirect()->route('album.index')->with('success', 'Album created!');
    }
}
