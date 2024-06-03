<?php

// app/Http/Controllers/Admin/AdminDashboardController.php

namespace App\Http\Controllers\Admin;

use App\Charts\UserCityChart;
use App\Charts\UsersChart;
use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\AnnouncementImage;
use App\Models\Category;
use App\Models\Role;
use App\Models\User;
use App\Models\Post;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    /////////////////////////////////////////////////////////////////////////
    /////////////////////////////////  VIEW  /////////////////////////////////
    /////////////////////////////////////////////////////////////////////////

    public function index()
    {
        // Initialize UsersChart with advanced colorations
        $users_data = User::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('month')
            ->get();

        $userChart = new UsersChart();
        foreach ($users_data as $user) {
            $userChart->labels[] = date('F', mktime(0, 0, 0, $user->month, 1));
            $userChart->dataset('Users Created', 'line', [$user->count])
                ->backgroundColor('rgba(255, 99, 132, 0.2)') // Light red background color for dataset
                ->color('rgba(255, 99, 132, 1)')              // Red color for dataset
                ->options(['borderColor' => 'rgba(255, 99, 132, 1)']); // Red border color for dataset
        }

        // Initialize UserCityChart with advanced colorations
        $usersByCity = User::select('ville', DB::raw('COUNT(*) as count'))
            ->groupBy('ville')
            ->orderBy('count', 'desc')
            ->get();

        $cityChart = new UserCityChart();
        foreach ($usersByCity as $user) {
            $cityChart->labels[] = $user->ville;
            $cityChart->dataset('Users by City', 'bar', [$user->count])
                ->backgroundColor(['#ffcc00', '#3399ff', '#ff6600']) // Custom background colors for bars
                ->color(['#ffcc00', '#3399ff', '#ff6600']);           // Custom border colors for bars
        }
        // Fetch other data for the view
        $announcements = Announcement::all();
        $users = User::all();
        $categories = Category::all();

        // Pass both charts and other data to the view
        return view('admin.dashboard', compact('announcements', 'users', 'categories', 'userChart', 'cityChart'));
    }


    public function announcement() //admin announcement View
    {
        $announcements = Announcement::all();
        $users = User::all();
        $categories = Category::all();
        return view('admin.announcement')->with(compact('announcements'))->with(compact('users'))->with(compact('categories'));
    }
    public function users() //admin Users View
    {
        $users = User::all();
        $roles = Role::all();

        return view('admin.user')->with(compact('users'))->with(compact('roles'));
    }

    public function categories() //admin Categories View
    {
        $categories = Category::all();
        return view('admin.category')->with(compact('categories'));
    }

    public function edit_user_view($id)
    {
        $user = User::find($id);
        $excludedRoleNames = ['SuperAdmin']; // Array of role names to exclude
        $roles = Role::whereNotIn('name', $excludedRoleNames)->get();
        return view('admin.CRUD.user.edit_user')->with(compact('user', 'roles'));
    }

    public function user_details($id)
    {
        $user = User::find($id);
        return view('admin.CRUD.user.user_details')->with(compact('user'));
    }
    public function edit_category_view($id)
    {
        $category = Category::find($id);
        if (!$category) {
            return redirect()->route('admin.categories')
                ->with('warning', 'Category not found.');
        }
        return view('admin.CRUD.category.edit_category')->with(compact('category'));
    }
    public function details_annoucement($id)
    {
        $announcement = Announcement::find($id);
        if (!$announcement) {
            return redirect()->route('admin.announcements')
                ->with('warning', 'Announcement not found.');
        }
        return view('admin.CRUD.announcement.announcement-details')->with(compact('announcement'));
    }

    public function create()
    {
        $posts = Post::all();
        return view('admin.post')->with(compact('posts'));
    }
    public function edit_post_view($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return redirect()->route('posts.index')->with('error', 'Post not found');
        }
        return view('admin.CRUD.posts.edit-post', compact('post'));
    }

    /////////////////////////////////////////////////////////////////////////
    ///////////////////////////////// CRUD  /////////////////////////////////
    /////////////////////////////////////////////////////////////////////////

    public function edit_user(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'name' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'string', 'email', 'max:255', Rule::unique('users')->ignore($id)],
            'password' => ['nullable'],
            'phone' => ['nullable', 'string'],
            'roles' => ['nullable', 'array'],
            'roles.*' => ['exists:roles,id']
        ]);

        // Find the user by ID
        $user = User::findOrFail($id);

        // Update the user's information
        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->input('password') ? Hash::make($request->input('password')) : $user->password,
            'phone' => $request->input('phone'),
        ]);

        // Sync user roles
        if ($request->has('roles')) {
            $user->syncRoles($request->input('roles'));
        }

        // Redirect with success message
        return redirect()->route('admin.users')->with('success', 'User updated successfully.');
    }

    public function delete_user($id)
    {

        $user = User::find($id);

        if (!$user) {
            return redirect()->route('admin.users')
                ->with('warning', 'User not found.');
        }


        // Delete related announcements
        $user->announcements()->delete();

        // Delete related messages sent by the user
        $user->sentMessages()->delete();

        // Delete related messages received by the user
        $user->receivedMessages()->delete();

        $user->roles()->detach();

        $user->delete();
        return redirect()->route('admin.users')
            ->with('success', 'User deleted successfully.');
    }
    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function add_user(Request $request)
    {

        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');
        $ville = $request->input('city');
        $phone = $request->input('phone');
        $role = $request->input('role');

        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'confirmed'],
            'city' => ['required'],
            'phone' => ['required'],
            'role' => ['required'],
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'name' =>  $name,
            'email' => $email,
            'password' => Hash::make($password),
            'ville' => $ville,
            'phone' => $phone,
        ]);

        $Role = Role::where('name', $role)->first();
        $user->roles()->attach($Role);

        event(new Registered($user));
        return redirect()->route('admin.users')
            ->with('success', 'User created successfully.');
    }

    public function add_category(Request $request)
    {
        $name = $request->input('name');
        $rules = [
            'name' => ['required', 'string', 'max:255'],
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $category = Category::create([
            'name' =>  $name,
        ]);

        return redirect()->route('admin.categories')
            ->with('success', 'Category created successfully.');
    }

    public function delete_category($id)
    {
        $category = Category::find($id);
        if (!$category) {
            return redirect()->route('admin.categories')
                ->with('warning', 'Category not found.');
        }
        $category->delete();
        return redirect()->route('admin.categories')
            ->with('success', 'Category deleted successfully.');
    }

    public function edit_category(Request $request, $id)
    {
        $category = Category::find($id);
        if (!$category) {
            return redirect()->route('admin.categories')
                ->with('warning', 'Category not found.');
        }
        $category->update([
            'name' => $request->input('name'),
        ]);
        return redirect()->route('admin.categories')
            ->with('success', 'Category updated successfully.');
    }

    public function add_annoucement(Request $request)
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

        return redirect()->route('admin.announcements')->with('success', 'Announcement created successfully.');
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

            return redirect()->route('admin.announcements')->with('success', 'Announcement deleted successfully.');
        } else {
            return redirect()->route('admin.announcements')->with('error', 'Error     ');
        }
    }
    public function deleteImage($id)
    {
        $image = AnnouncementImage::findOrFail($id);
        $imagePath = public_path('images/' . $image->image_path);

        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
        $image->delete();

        return redirect()->back()->with('success', 'Image deleted successfully.');
    }
    public function addImages(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $announcement = Announcement::findOrFail($id);

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

        return redirect()->back()->with('success', 'Images added successfully.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('post_images'), $imageName);

        $post = new Post();
        $post->title = $request->title;
        $post->description = $request->description;
        $post->image_url = '/post_images/' . $imageName;
        $post->save();

        return redirect()->route('admin.posts.create')->with('success', 'Post created successfully.');
    }
    public function suspendUser($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->status = 'inactive';
            $user->save();
            return response()->json(['success' => true, 'message' => 'User suspended successfully']);
        }
        return response()->json(['success' => false, 'message' => 'User not found']);
    }

    public function activateUser($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->status = 'active';
            $user->save();
            return response()->json(['success' => true, 'message' => 'User activated successfully']);
        }
        return response()->json(['success' => false, 'message' => 'User not found']);
    }
    public function suspend_announcement($id)
    {
        $announcement = Announcement::findOrFail($id);
        $announcement->is_active = false;
        $announcement->save();

        return response()->json(['message' => 'Announcement suspended successfully.']);
    }
    public function unsuspend_announcement($id)
    {
        $announcement = Announcement::findOrFail($id);
        $announcement->is_active = true;
        $announcement->save();

        return response()->json(['message' => 'Announcement unsuspended successfully.']);
    }

    public function edit_post(Request $request, $id)
    {
        $post = Post::find($id);

        if (!$post) {
            return redirect()->route('admin.posts.edit.view', $id)->with('error', 'Post not found');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $post->title = $request->input('title');
        $post->description = $request->input('description');

        if ($request->hasFile('image')) {
            // Delete the old image if it exists and is not the default placeholder image
            if ($post->image_url && $post->image_url !== 'https://via.placeholder.com/300x200.png?text=No+Image+Available') {
                $oldImagePath = public_path($post->image_url);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            // Store the new image
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('post_images'), $imageName);
            $post->image_url = '/post_images/' . $imageName;
        } else {
            // If no new image is uploaded, retain the old image
            if (!$post->image_url) {
                $post->image_url = 'https://via.placeholder.com/300x200.png?text=No+Image+Available';
            }
        }

        $post->save();

        return redirect()->route('admin.posts.edit.view', $id)->with('success', 'Post updated successfully');
    }



    public function delete_post($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return redirect()->route('posts.index')->with('error', 'Post not found');
        }

        // Delete the image if exists
        if ($post->image_url) {
            Storage::disk('public')->delete($post->image_url);
        }

        $post->delete();

        return redirect()->back()->with('success', 'Post deleted successfully');
    }
    public function delete_image($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json(['success' => false, 'message' => 'Post not found']);
        }

        // Delete the image if it exists and is not the default placeholder image
        if ($post->image_url && $post->image_url !== 'https://via.placeholder.com/300x200.png?text=No+Image+Available') {
            $oldImagePath = public_path($post->image_url);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        }

        $post->image_url = 'https://via.placeholder.com/300x200.png?text=No+Image+Available';
        $post->save();

        return response()->json(['success' => true, 'message' => 'Image deleted successfully']);
    }
}
