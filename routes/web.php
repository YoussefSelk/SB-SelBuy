<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

//The Landing Page Route (FrontOffice)
include 'web/FrontOffce/index.php';

//The Admin Dashboard Routes (BackOffice)
include 'web/BackOffice/dashboard.php';

//The Announcement Routes (BackOffice)
include 'web/BackOffice/Announcement.php';

//The Profile Routes (Others)
include 'web/others/profile.php';


require __DIR__ . '/auth.php';
