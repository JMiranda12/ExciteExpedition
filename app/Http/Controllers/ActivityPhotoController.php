<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ActivityPhotoController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        $photo = new ActivityPhoto;
        $photo->activity_id = $request->activity_id;
        $photo->path = $request->file('image')->store('activity_photos', 'public');
        $photo->save();

        return redirect()->back()->with('status', 'Image has been uploaded');
    }
}
