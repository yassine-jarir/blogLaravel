<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Announcement $announcement) {

        $announcement->comments()->create([
            'user_id' => auth()->id(),
            'content' => $request->body,
        ]);

        return back()->with('success', 'Comment added successfully!');
    }
}
