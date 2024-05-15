<?php

namespace App\Http\Controllers\FrontOffice;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\AnnouncementImage;
use App\Models\Category;
use App\Models\Role;
use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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

        $posts = Post::latest()->get();

        return view('index', compact('featuredProducts', 'posts', 'categories', 'carAnnouncements', 'techAnnouncements'));
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

    public function become_seller_view($id)
    {
        if (Auth::user()->id != $id) {
            return redirect()->back()->with('error', 'Security Guard Error');
        }
        $user = User::find($id);
        return view('FrontOffice.CRUD.become-seller')->with(compact('user'));
    }

    public function create_announcement_view()
    {
        $categories = Category::all();
        return view('FrontOffice.CRUD.create-announcement')->with(compact('categories'));
    }
    public function my_announcement_view($id)
    {
        $user = User::findOrFail($id);
        $announcements = Announcement::where('user_id', $id)->get();

        return view('FrontOffice.seller.my-announcements')->with(compact('user', 'announcements'));
    }
    public function terms_and_conditions()
    {
        return view('FrontOffice.terms_and_conditions');
    }
    public function privacy_policy()
    {
        return view('FrontOffice.privacy_policy');
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
    public function become_seller(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|string|max:20',
            'ville' => 'required|string|max:255',
            'privacy_policy' => 'accepted',
            'terms_conditions' => 'accepted',
        ]);

        $user = User::findOrFail($id);
        if ($user->name != $request->input('name')) {
            $user->name = $request->input('name');
        }

        if ($user->email != $request->input('email')) {
            $user->email = $request->input('email');
        }

        if ($user->phone != $request->input('phone')) {
            $user->phone = $request->input('phone');
        }

        if ($user->ville != $request->input('ville')) {
            $user->ville = $request->input('ville');
        }

        $Role = Role::where('name', 'Seller')->first();
        $user->roles()->attach($Role);
        $user->save();

        return redirect()->route('home')->with('success', 'You are now a Seller !!!');
    }
    public function create_announcement(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'user' => 'required|exists:users,id',
            'category' => 'required|exists:categories,id',
            'city' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $announcement = new Announcement();
        $announcement->title = $request->title;
        $announcement->price = $request->price;
        $announcement->description = $request->description;
        $announcement->user_id = $request->user;
        $announcement->category_id = $request->category;
        $announcement->ville = $request->city; // Add city to the announcement
        $announcement->save();

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('images'), $imageName);

                $announcementImage = new AnnouncementImage();
                $announcementImage->announcement_id = $announcement->id;
                $announcementImage->image_path = $imageName;
                $announcementImage->save();
            }
        }

        return redirect()->route('home')->with('success', 'Announcement created successfully.');
    }
}
