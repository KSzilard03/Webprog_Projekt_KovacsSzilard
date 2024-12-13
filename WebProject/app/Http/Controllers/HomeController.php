<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // Displays the home page with the latest 6 services
    public function index()
    {
        $latestServices = Service::latest()->take(6)->get(); // Fetches the latest 6 services

        return view('home', compact('latestServices')); // Passes the latest services to the view
    }

    // Displays the login page
    public function login()
    {
        return view('login');
    }

    // Displays the registration page
    public function register()
    {
        return view('register');
    }

    // Displays all services with optional filtering by category and price
    public function services(Request $request)
    {
        // Default categories if none exist in the database
        $defaultCategories = ['IT Services', 'Consulting', 'Design', 'Marketing', 'Education'];
        // Retrieves distinct categories from the services table
        $categories = Service::select('category')->distinct()->pluck('category')->toArray();
        // Merges and ensures uniqueness of the categories list
        $categories = array_unique(array_merge($categories, $defaultCategories));

        $services = Service::query(); // Initializes the service query

        // Filters by selected category
        if ($request->category) {
            $services->where('category', $request->category);
        }

        // Filters by minimum price
        if ($request->min_price) {
            $services->where('price', '>=', $request->min_price);
        }

        // Filters by maximum price
        if ($request->max_price) {
            $services->where('price', '<=', $request->max_price);
        }

        // Executes the query and retrieves filtered services
        $services = $services->get();

        // Passes the filtered services and categories to the view
        return view('services', compact('services', 'categories'));
    }
}
