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
        // Validate the request data if needed
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'photos.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048' // Adjust the validation rules according to your needs
        ]);

        // Check if the authenticated user is the owner of the announcement
        if ($request->user()->id !== $announcement->user_id) {
            return redirect()->back()->with('error', 'Unauthorized');
        }

        // Update the announcement
        $announcement->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        // Handle photo upload if present
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $imageName = time() . '_' . $photo->getClientOriginalName();
                $photo->move(public_path('images'), $imageName);

                $announcementImage = new AnnouncementImage();
                $announcementImage->announcement_id = $announcement->id;
                $announcementImage->image_path = $imageName;
                $announcementImage->save();
            }
        }

        return redirect()->back()->with('success', 'Announcement updated successfully');
    }
}
