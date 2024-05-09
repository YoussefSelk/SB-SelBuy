<?php

namespace App\Http\Controllers\FrontOffice;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\AnnouncementImage;
use App\Models\Category;
use Illuminate\Http\Request;

class FrontOfficeController extends Controller
{
    public function index()
    {
        // Fetch featured products
        $featuredProducts = Announcement::where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->limit(8)
            ->get();

        // Fetch categories with the count of announcements
        $categories = Category::withCount('announcements')
            ->orderBy('created_at', 'desc')
            ->limit(8)
            ->get();

        return view('index', compact('featuredProducts', 'categories'));
    }

    public function announcement_details($id)
    {
        $announcement = Announcement::find($id);
        if (!$announcement) {
            return redirect()->route('home')
                ->with('warning', 'Announcement not found.');
        }
        return view('FrontOffice.CRUD.announcement-details', compact('announcement'));
    }

    public function like($id)
    {
        $announcement = Announcement::find($id);
        if (!$announcement) {
            return response()->json(['error' => 'Announcement not found'], 404);
        }

        $announcement->likes += 1;
        $announcement->save();

        return response()->json(['likes' => $announcement->likes]);
    }

    public function update_announcement(Request $request, Announcement $announcement)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
        ]);

        // Update the announcement
        $announcement->update($validatedData);

        return response()->json(['message' => 'Announcement updated successfully']);
    }
}
