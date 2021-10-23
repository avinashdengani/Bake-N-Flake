<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CitiesController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', City::class);
        $cities = City::paginate(10);
        return view('cities.index', compact(['cities']));
    }

}
