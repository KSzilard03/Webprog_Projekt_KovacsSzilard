<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    // Displays the list of services created by the authenticated user
    public function showServices()
    {
        $services = Service::where('user_id', auth()->id())->get(); // Fetches services belonging to the authenticated user
        return view('auth.services.show', compact('services')); // Passes services to the view
    }

    // Shows the form to create a new service
    public function createService()
    {
        $categories = ['IT Services', 'Consulting', 'Design', 'Marketing', 'Education']; // Predefined categories
        return view('auth.services.create', compact('categories')); // Passes categories to the view
    }

    // Handles the creation of a new service
    public function createServicePost(Request $request)
    {
        // Validates input data for the new service
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string|max:255',
            'price' => 'required|numeric|min:0.01',
            'contact' => 'required|string|max:255',
            'terms' => 'accepted', // Ensures terms are accepted
        ]);

        // Strips any HTML tags from the input
        $validatedData['name'] = strip_tags($validatedData['name']);
        $validatedData['description'] = strip_tags($validatedData['description']);
        $validatedData['category'] = strip_tags($validatedData['category']);
        $validatedData['contact'] = strip_tags($validatedData['contact']);
        $validatedData['price'] = (float) number_format($validatedData['price'], 2, '.', ''); // Formats the price to 2 decimal places

        // Assigns the authenticated user's ID
        $validatedData['user_id'] = auth()->id();

        // Redirects to login page if user is not logged in
        if (!$validatedData['user_id']) {
            return redirect()->route('login')->with('error', 'You need to log in first.');
        }

        // Creates a new service and saves it to the database
        $service = new Service();
        $service->name = $validatedData['name'];
        $service->description = $validatedData['description'];
        $service->category = $validatedData['category'];
        $service->price = $validatedData['price'];
        $service->contact = $validatedData['contact'];
        $service->user_id = $validatedData['user_id'];

        // Redirects based on the success of the service creation
        if ($service->save()) {
            return redirect()->route('services')->with('success', 'Service created successfully!');
        }

        return redirect()->route('services.create')->with('error', 'Failed to create the service.');
    }

    // Shows the form to edit an existing service
    public function editService($id)
    {
        $service = Service::where('user_id', auth()->id())->findOrFail($id); // Fetches the service to be edited
        return view('auth.services.edit', compact('service')); // Passes the service to the edit view
    }

    // Handles the update of an existing service
    public function updateService(Request $request, $id)
    {
        $service = Service::where('user_id', auth()->id())->findOrFail($id); // Fetches the service to be updated

        // Validates the updated service data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string|max:255',
            'price' => 'required|numeric|min:0.01',
            'contact' => 'required|string|max:255',
        ]);

        // Strips any HTML tags from the input
        $service->name = strip_tags($validatedData['name']);
        $service->description = strip_tags($validatedData['description']);
        $service->category = strip_tags($validatedData['category']);
        $service->price = (float) number_format($validatedData['price'], 2, '.', ''); // Formats the price to 2 decimal places
        $service->contact = strip_tags($validatedData['contact']);

        // Redirects based on the success of the update
        if ($service->save()) {
            return redirect()->route('services')->with('success', 'Service updated successfully!');
        }

        return redirect()->route('services.edit', $service->id)->with('error', 'Failed to update the service.');
    }

    // Deletes a service
    public function deleteService($id)
    {
        $service = Service::where('user_id', auth()->id())->findOrFail($id); // Fetches the service to be deleted
        $service->delete(); // Deletes the service from the database

        // Redirects back to the services list with a success message
        return redirect()->route('services')->with('success', 'Service deleted successfully!');
    }
}
