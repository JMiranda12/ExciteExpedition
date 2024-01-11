<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Activity;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Application dashboard
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        $activities = ActivityController::getActivities(6);

        return view('home', ['activities' => $activities]);
    }

    public function howTo() {
        return view('howTo');
    }
}
