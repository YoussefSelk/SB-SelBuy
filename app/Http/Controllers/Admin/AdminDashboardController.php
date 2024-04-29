<?php

// app/Http/Controllers/Admin/AdminDashboardController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;

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
        return view('admin.announcement')->with(compact('announcements'));
    }
}
