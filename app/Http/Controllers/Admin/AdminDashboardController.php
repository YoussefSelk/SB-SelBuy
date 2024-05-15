<?php

// app/Http/Controllers/Admin/AdminDashboardController.php

namespace App\Http\Controllers\Admin;

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

class AdminDashboardController extends Controller
{
    /////////////////////////////////////////////////////////////////////////
    /////////////////////////////////  VIEW  /////////////////////////////////
    /////////////////////////////////////////////////////////////////////////

    public function index() //admin dashboard View
    {
        $announcements = Announcement::all();
        $users = User::all();
        $categories = Category::all();
        return view('admin.dashboard')->with(compact('announcements'))->with(compact('users'))->with(compact('categories'));
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
        return view('admin.CRUD.user.edit_user')->with(compact('user'));
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
        return view('admin.post');
    }


    /////////////////////////////////////////////////////////////////////////
    ///////////////////////////////// CRUD  /////////////////////////////////
    /////////////////////////////////////////////////////////////////////////

    public function edit_user(Request $request, $id)
    {
        $request->validate([
            'name' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'string', 'email', 'max:255', Rule::unique('users')->ignore($id)],
            'password' => ['nullable',],
            'phone' => ['nullable',],
        ]);

        $user = User::findOrFail($id);

        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->input('password') ? Hash::make($request->input('password')) : $user->password,
            'phone' => $request->input('phone'),
        ]);

        return redirect()->route('admin.users')
            ->with('success', 'User updated successfully.');
    }

    public function delete_user($id)
    {

        $user = User::find($id);

        if (!$user) {
            return redirect()->route('admin.users')
                ->with('warning', 'User not found.');
        }


        $announcements = Announcement::where('user_id', $user->id)->get();
        if ($announcements) {
            foreach ($announcements as $announcement) {
                $announcement->delete();
            }
        }

        $roles = $user->roles;
        if ($roles) {
            foreach ($roles as $role) {
                $user->removeRole($role->name);
            }
        }

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
}
