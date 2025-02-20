<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $announcements = Announcement::query()->orderBy('id')->get();
//        dd($announcements);
        return view('frontOffice/index', ['announcements' => $announcements]);
    }

    public function show(Announcement $announcement)
    {
        return view('frontOffice.show', ['announcement' => $announcement]);
    }
}
