<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\ActivityPhoto;
use App\Models\City;
use App\Models\Country;
use App\Models\Host;
use App\Models\Category;
use App\Models\Item;
use App\Models\Language;
use App\Models\UserItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActivityController extends Controller
{

    public static function buildSearchActivitiesQuery(
        string $searchQuery,
        array $selectArgs,
        int $category_id = null,
        int $language_id = null,
        int $user_id = null
    ) {
        $query = Activity::select($selectArgs)
            ->with('category') // Use the correct relationship method name
            ->where(function ($query) use ($searchQuery) {
                $query->orWhere('title', 'LIKE', "%{$searchQuery}%")
                    ->orWhere('description', 'LIKE', "%{$searchQuery}%")
                    ->orWhereHas('category', function ($query) use ($searchQuery) {
                        $query->where('name', 'LIKE', "%{$searchQuery}%");
                    });
            });

        $query->where(function ($query) use ($category_id, $language_id, $user_id) {
            if ($category_id !== null) {
                $query->whereHas('category', function ($query) use ($category_id) {
                    $query->where('id', $category_id);
                });
            }
            if ($language_id !== null) {
                $query->where('language_id', '=', $language_id);
            }
            if ($user_id !== null) {
                $query->whereHas('userItem', function ($query) use ($user_id) {
                    $query->where('user_id', $user_id);
                });
            }
        });

        $query->whereHas('item', function ($query) {
            $query->where('flag_delete', '=', false);
        });

        return $query;
    }

    /**
     * Returns array of hosts of specified activity.
     *
     * @param int $item_id
     * @return array $hosts
     */
    public static function getActivityHosts($item_id)
    {
        $hostActivity = Host::whereHas('activities', function ($query) use ($item_id) {
            $query->where('item_id', $item_id);
        })->get();

        return $hostActivity;
    }

    /**
     * Returns array of categories of specified activity.
     *
     * @param int $item_id
     * @return array $categories
     */
    public static function getActivityCategories($item_id): array
    {
        $activity = Activity::find($item_id);

        if (!$activity) {
            return [];
        }

        $category = Category::find($activity->category_id);

        return $category ? [$category] : [];
    }

    /**
     * Returns a paginated array of all activities that are not deleted.
     *
     * @param int $numberOfActivities
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public static function getActivities($numberOfActivities)
    {
        $activities = Activity::with('item')
            ->whereHas('item', function ($query) {
                $query->where('flag_delete', '=', false);
            })
            ->paginate($numberOfActivities);

        return $activities;
    }


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'price' => 'required|numeric|min:1',
            'language_id' => 'required|exists:language,id',
            'country_id' => 'required|exists:country,id',
            'city_id' => 'required|exists:city,id',
            'photos.*' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        $item = Item::create([
            'name' => $request->get('title'),
            'price' => $request->get('price'),
            'item_type_id' => 1, // Activity
        ]);

        $user = Auth::user();

        $activity = new Activity($request->except('photos'));
        $activity->user_id = $user->id;
        $item->activity()->save($activity);

        // Retrieve the activity_id after saving the activity
        $activityID = $item->activity->item_id;

        // Handle Photos
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $originalName = $photo->getClientOriginalName(); // Get the original file name
                $path = $photo->storeAs('public/image', $originalName); // Store the file with the original name

                ActivityPhoto::create([
                    'activity_id' => $activityID,
                    'path' => $originalName, // Store the original file name in the database
                ]);
            }
        }

        // Create UserItem
        $userItem = new UserItem;
        $userItem->item_id = $item->id;
        $userItem->user_id = $request->user()->id;
        $userItem->save();

        return redirect()->route('home')->with('success', 'Activity created successfully.');
    }


    /**
     * Display the form for creating a new activity.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function createActivity()
    {
        $loggedInUser = auth()->user();
        $possibleCategories = Category::all();
        $possibleLanguages = Language::all();
        $possibleCountries = Country::all();
        $possibleCities = City::all();

        return view('activity.create', compact(
            'possibleCategories', 'possibleLanguages','loggedInUser','possibleCountries','possibleCities'
        ));
    }
}
