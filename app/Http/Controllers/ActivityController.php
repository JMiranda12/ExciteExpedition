<?php

namespace App\Http\Controllers;

use App\Models\Activity;
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
    /**
     * Query to search activities with filters.
     *
     * @param string $searchQuery
     * @param array $selectArgs
     * @param int|null $category_id
     * @param int|null $language_id
     * @param int|null $year
     * @param int|null $user_id
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
   /* public static function buildSearchActivitiesQuery(
        string $searchQuery,
        array $selectArgs,
        int $host_id = null,
        int $category_id = null,
        int $language_id = null,
        int $year = null,
        int $user_id = null
    ) {
        $query = Activity::select($selectArgs)
            ->with(['host', 'categories'])
            ->where(function ($query) use ($searchQuery) {
                $query->orWhere('title', 'ilike', "%{$searchQuery}%")
                    ->orWhere('description', 'ilike', "%{$searchQuery}%")
                    ->orWhereHas('host', function ($query) use ($searchQuery) {
                        $query->where('name', 'ilike', "%{$searchQuery}%");
                    });
            });

        $query->where(function ($query) use ($user_id, $host_id, $category_id, $language_id, $year) {
            if ($host_id !== null) {
                $query->whereHas('host', function ($query) use ($host_id) {
                    $query->where('id', $host_id);
                });
            }
            if ($category_id !== null) {
                $query->whereHas('categories', function ($query) use ($category_id) {
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
    }*/

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

    /**
     * Method to create a new activity.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
   /* public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'price' => 'required|numeric|min:1',
          //  'first_date' => 'required|date|date_format:Y-m-d',
           // 'last_date' => 'required|date|date_format:Y-m-d',
            'language_id' => 'required|exists:language,id',
           // 'photos.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validation for photos
        ]);

        // Create the item associated with the activity
        $item = Item::create([
            'name' => $request->get('title'),
            'price' => $request->get('price'),
            'item_type_id' => 1, // Activity
        ]);

        // Create the activity itself and associate it with the logged-in user
        $activity = $item->activity()->create($request->except('photos'));
        $activity->user_id = $request->user()->id; // Associate with the logged-in user
        $activity->save();

        // Handle photo uploads
        if ($request->hasFile('photos')) {
            $photos = [];
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('activity_photos', 'public'); // Adjust the storage path as needed
                $photos[] = ['path' => $path];
            }

            // Associate photos with the activity
            $activity->photos()->createMany($photos);
        }

        // Associate the item with the user
        $userItem = new UserItem;
        $userItem->item_id = $item->id;
        $userItem->user_id = $request->user()->id;
        $userItem->save();

        return redirect()->route('home')
            ->with('success', 'Atividade criada com sucesso.');

        //return redirect()->route('activity.createForm')->with('message', __('Item criado com sucesso'));
    }
*/

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'price' => 'required|numeric|min:1',
            'language_id' => 'required|exists:language,id',
            'photos.*' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        // Create the item associated with the activity
        $item = Item::create([
            'name' => $request->get('title'),
            'price' => $request->get('price'),
            'item_type_id' => 1, // Activity
        ]);

        $user = Auth::user();

        // Create the activity itself
       // $activity = $item->activity()->create($request->except('photos'));
        $activity = new Activity($request->except('photos'));
        $activity->user_id = $user->id;
        // Save the activity
       // $activity->save();
        $item->activity()->save($activity);

        if ($request->hasFile('photos')) {
            $activityPhotoController = new ActivityPhotoController;
            foreach ($request->file('photos') as $photo) {
                $activityPhotoController->create([
                    'activity_id' => $activity->id,
                    'image' => $photo,
                ]);
            }
        }

        // Associate the item with the user
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

        return view('activity.create', compact(
            'possibleCategories', 'possibleLanguages','loggedInUser','possibleCountries'
        ));
    }
}
