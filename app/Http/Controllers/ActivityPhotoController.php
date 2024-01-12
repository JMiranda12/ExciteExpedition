<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ActivityPhoto;

class ActivityPhotoController extends Controller
{


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(array $data)
    {
        request()->validate([
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        $name = $data['image']->getClientOriginalName();
        $data['image']->store('storage/images/');

        ActivityPhoto::create([
            'activity_id' => $data['activity_id'],
            'name' => $name,
            'path' => $data['image']->hashName(),
        ]);

        return redirect()->back()->with('status', 'Image has been uploaded');
    }


}
