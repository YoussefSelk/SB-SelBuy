<?php

// app/Http/Controllers/Admin/AdminDashboardController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\Category;
use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
}
