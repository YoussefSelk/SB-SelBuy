<?php

// app/Http/Controllers/Admin/AdminDashboardController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\Category;
use App\Models\User;

class AdminDashboardController extends Controller
{
    //View Functions
    public function index() //admin dashboard View
    {
        return view('admin.dashboard');
    }

    public function announcement() //admin announcement View
    {
        $announcements = Announcement::all();
        $users = User::where('is_admin', 0)->get();
        $categories = Category::all();
        return view('admin.announcement')->with(compact('announcements'))->with(compact('users'))->with(compact('categories'));
    }
}
