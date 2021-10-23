<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index()
    {
        $categories = Category::with('products')->get();
        $testimonials = Testimonial::with('owner')->where('ratings', '>=', 3)->get();
        return view('landingpage', compact(['categories', 'testimonials']));
    }
}
