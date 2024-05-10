<?php

namespace App\Http\Controllers\FrontOffice;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\AnnouncementImage;
use App\Models\Category;
use Illuminate\Http\Request;

class FrontOfficeController extends Controller
{


    /////////////////////////////////////////////////////////////////////////
    /////////////////////////////////  VIEW  /////////////////////////////////
    /////////////////////////////////////////////////////////////////////////


    public function index()
    {

        $announcements = Announcement::all();
        // Fetch featured products
        $featuredProducts = Announcement::where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->limit(8)
            ->get();

        // Fetch categories with the count of announcements
        $categories = Category::withCount('announcements')
            ->orderBy('created_at', 'desc')
            ->get();

        $carAnnouncements = Announcement::whereHas('category', function ($query) {
            $query->where('name', 'Cars');
        })->get();

        $techAnnouncements = Announcement::whereHas('category', function ($query) {
            $query->where('name', 'Electronics');
        })->get();


        return view('index', compact('featuredProducts', 'categories', 'carAnnouncements', 'techAnnouncements'));
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

    public function category_announcement($id)
    {
        $category = Category::findOrFail($id);
        $announcements = Announcement::where('category_id', $id)->get();

        return view('FrontOffice.CRUD.category-announcements', compact('category', 'announcements'));
    }



    /////////////////////////////////////////////////////////////////////////
    ///////////////////////////////// CRUD  /////////////////////////////////
    /////////////////////////////////////////////////////////////////////////


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
            'city' => 'required|string|max:255',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Maximum file size 2MB

        ]);

        // Handle the image upload
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('images'), $imageName);
                $announcement->images()->create(['image_path' => $imageName]);
            }
        }

        // Update the announcement
        $announcement->update(array_merge($validatedData, ['ville' => $request->city]));

        return response()->json(['message' => 'Announcement updated successfully']);
    }

    public function deleteImage($id)
    {
        $image = AnnouncementImage::findOrFail($id);
        $imagePath = public_path('images/' . $image->image_path);

        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
        $image->delete();

        return response()->json(['message' => 'Image deleted successfully']);
    }

    public function getImagesJson($id)
    {
        $announcement = Announcement::findOrFail($id);
        $images = $announcement->images()->pluck('image_path')->toArray();

        return response()->json(['images' => $images]);
    }

    public function filterAnnouncements(Request $request)
    {
        $announcements = Announcement::with('user', 'images')
            ->where('is_active', true);

        if ($request->filled('category')) {
            $announcements->where('category_id', $request->input('category'));
        }

        if ($request->filled('price_min')) {
            $announcements->where('price', '>=', $request->input('price_min'));
        }

        if ($request->filled('price_max')) {
            $announcements->where('price', '<=', $request->input('price_max'));
        }

        $announcements = $announcements->paginate(10);

        return response()->json(['announcements' => $announcements]);
    }
}
