<?php

namespace App\Http\Controllers;

use App\Models\Basketball;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BasketballController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:Indoor,Outdoor,Indoor/Outdoor',
            'price' => 'required|numeric|min:0',
            'image' => [
                'required',
                'image',
                'mimes:jpeg,png,jpg,webp',
                'max:2048', // 2MB max
                'dimensions:min_width=200,min_height=200,max_width=2000,max_height=2000'
            ]
        ]);

        if ($request->hasFile('image')) {
            try {
                // Optimize and store the image
                $image = $request->file('image');
                $imageName = time() . '_' . str_slug($request->name) . '.' . $image->getClientOriginalExtension();
                
                // Store the image
                $path = $image->storeAs('basketballs', $imageName, 'public');
                
                Basketball::create([
                    'name' => $validated['name'],
                    'type' => $validated['type'],
                    'price' => $validated['price'],
                    'image' => $path
                ]);

                return redirect()->back()->with('success', 'Basketball added successfully!');
            } catch (\Exception $e) {
                return redirect()->back()
                    ->with('error', 'Error uploading image. Please try again.')
                    ->withInput();
            }
        }
    }

    public function update(Request $request, Basketball $basketball)
    {
        // Validate the request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:Indoor,Outdoor,Indoor/Outdoor',
            'price' => 'required|numeric|min:0',
            'image' => [
                'nullable',
                'image',
                'mimes:jpeg,png,jpg,webp',
                'max:2048',
                'dimensions:min_width=200,min_height=200,max_width=2000,max_height=2000'
            ]
        ]);

        try {
            if ($request->hasFile('image')) {
                // Delete old image if it exists
                if ($basketball->image && Storage::disk('public')->exists($basketball->image)) {
                    Storage::disk('public')->delete($basketball->image);
                }
                
                // Store new image
                $image = $request->file('image');
                $imageName = time() . '_' . str_slug($request->name) . '.' . $image->getClientOriginalExtension();
                $validated['image'] = $image->storeAs('basketballs', $imageName, 'public');
            }

            $basketball->update($validated);

            return redirect()->back()->with('success', 'Basketball updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error updating basketball. Please try again.')
                ->withInput();
        }
    }

    public function destroy(Basketball $basketball)
    {
        // Delete the image file if it exists
        if ($basketball->image) {
            Storage::delete($basketball->image);
        }

        // Delete the basketball record
        $basketball->delete();

        return redirect()->back()->with('success', 'Basketball deleted successfully');
    }
} 