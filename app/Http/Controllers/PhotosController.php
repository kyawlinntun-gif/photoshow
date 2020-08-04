<?php

namespace App\Http\Controllers;

use App\Album;
use App\Photo;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use File;

class PhotosController extends Controller
{    
    public function show(Photo $photo)
    {
        return view('photo.show', [
            'photo' => $photo
        ]);
    }

    /**
     * create
     *
     * @param  mixed $request
     * @return void
     */
    public function create(Request $request)
    {
        return view('photo.create', [
            'album_id' => $request->album_id
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
        // $fileSize = $request->file('photo')->getSize();
        $this->validate($request, [
            'title' => 'required',
            'photo' => 'required|max:1999'
        ]);

        // Get filename with extension
        $filenameWithExt = $request->file('photo')->getClientOriginalName();

        // Get just the filename
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

        // Get extension
        $extension = $request->file('photo')->getClientOriginalExtension();

        // Create new filename
        $filenameToStore = $filename . '_' . time() . '.' .$extension;

        // Create Path
        $destinationPath = public_path("storage\photo\photo" . $request->album_id);

        // Upload image
        $path = $request->file('photo')->move($destinationPath, $filenameToStore);
        // $image = Image::make($path)->fit(1200, 1200);
        // $image->save();
        
        // return $request->all();
        $photo = new Photo;
        $photo->photo = $filenameToStore;
        $photo->title = $request->title;
        $photo->size = $request->file('photo')->getSize();
        $photo->description = $request->description;
        // $photo->album_id = $request->album_id;
        // $photo->save();

        $album = Album::find($request->album_id);
        $album->photos()->save($photo);

        return redirect()->route('album.show', $request->album_id)->with('success', 'Photo created!');
    }

    public function destroy(Photo $photo)
    {
        // In Storage Link
        // if(Storage::delete('/photo/photo' . $photo->album_id . '/' . $photo->photo))
        // {
        //     $photo->delete();
        // }

        // In Public Link
        $destinationPath = public_path("\storage\photo\photo{$photo->album_id}");
        // return ($destinationPath. '/' . $photo->photo);
        if(File::delete($destinationPath.'/' . $photo->photo))
        {
            $photo->delete();
        }

        return redirect()->route('album.show', $photo->album_id)->with('success', 'Photo was successfully deleted!');
    }
}
