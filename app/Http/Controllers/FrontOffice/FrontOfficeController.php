<?php

namespace App\Http\Controllers\FrontOffice;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\AnnouncementImage;
use App\Models\Category;
use App\Models\Favorite;
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
        // Fetch all announcements with 'is_active' true
        $announcements = Announcement::where('is_active', true)
            ->whereHas('user', function ($query) {
                $query->where('status', 'active');
            })->get();

        // Fetch featured products with 'is_active' true
        $featuredProducts = Announcement::where('is_active', true)
            ->whereHas('user', function ($query) {
                $query->where('status', 'active');
            })
            ->orderBy('created_at', 'desc')
            ->limit(8)
            ->get();

        // Fetch categories with the count of announcements that are 'is_active' true
        $categories = Category::withCount(['announcements' => function ($query) {
            $query->where('is_active', true)
                ->whereHas('user', function ($query) {
                    $query->where('status', 'active');
                });
        }])
            ->orderBy('created_at', 'desc')
            ->get();

        // Fetch car announcements with 'is_active' true
        $carAnnouncements = Announcement::where('is_active', true)
            ->whereHas('category', function ($query) {
                $query->where('name', 'Cars');
            })->whereHas('user', function ($query) {
                $query->where('status', 'active');
            })->get();

        // Fetch tech announcements with 'is_active' true
        $techAnnouncements = Announcement::where('is_active', true)
            ->whereHas('category', function ($query) {
                $query->where('name', 'Electronics');
            })->whereHas('user', function ($query) {
                $query->where('status', 'active');
            })->get();

        // Fetch latest posts
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
    public function my_announcement_view()
    {
        $user = Auth::user();
        $announcements = Announcement::where('user_id', $user->id)->get();

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
    public function about_us()
    {
        return view('FrontOffice.about_us');
    }
    public function favorites()
    {
        // Get the authenticated user's favorite announcements with their images
        $favorites = auth()->user()->favorites()->with('announcement.images')->get();

        // Pass the favorites data to the view
        return view('FrontOffice.CRUD.my-favorites', compact('favorites'));
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

        // Filtering by category
        if ($request->filled('category')) {
            $announcements->where('category_id', $request->input('category'));
        }

        // Filtering by price range
        if ($request->filled('price_min')) {
            $announcements->where('price', '>=', $request->input('price_min'));
        }

        if ($request->filled('price_max')) {
            $announcements->where('price', '<=', $request->input('price_max'));
        }

        // Search query
        if ($request->filled('search')) {
            $searchTerm = $request->input('search');
            $announcements->where(function ($query) use ($searchTerm) {
                $query->where('title', 'like', "%$searchTerm%")
                    ->orWhere('description', 'like', "%$searchTerm%");
            });
        }

        // Paginate the results
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


    public function search(Request $request)
    {
        $searchQuery = $request->input('query');
        $category = $request->input('category');
        $ville = $request->input('ville');

        $announcements = Announcement::query()
            ->when($category, function ($query) use ($category) {
                return $query->where('category_id', $category);
            })
            ->when($ville, function ($query) use ($ville) {
                return $query->where('ville', 'like', '%' . $ville . '%');
            })
            ->where(function ($subQuery) use ($searchQuery) {
                $subQuery->where('title', 'like', '%' . $searchQuery . '%')
                    ->orWhere('description', 'like', '%' . $searchQuery . '%');
            })
            ->with('user', 'images')
            ->get();

        return response()->json(['announcements' => $announcements]);
    }
    public function addToFavorites(Request $request)
    {
        $favorite = Favorite::create([
            'user_id' => auth()->id(),
            'announcement_id' => $request->announcement_id,
        ]);

        return response()->json(['success' => true]);
    }

    public function removeFromFavorites($id)
    {
        Favorite::where('announcement_id', $id)->delete();

        return response()->json(['success' => true]);
    }
    public function delete_announcement($id)
    {
        $announcement = Announcement::find($id);
        if ($announcement) {
            foreach ($announcement->images as $image) {
                $imagePath = public_path('images/' . $image->image_path);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
                $image->delete();
            }
            $announcement->delete();

            return response()->json(['message' => 'Announcement deleted successfully']);
        } else {
            return response()->json(['message' => 'Failed to delete the Announcement']);
        }
    }
    
}
