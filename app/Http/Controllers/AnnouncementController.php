<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAnnouncementRequest;
use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $announcements = Announcement::query()->orderBy('id')->paginate(10);
//        dd($announcements);
        return view('backOffice/announcements.index', ['announcements' => $announcements]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backOffice/announcements.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAnnouncementRequest $request)
    {
        $data = $request->validated();
        if($request->hasFile('picture')) {
            $data['picture'] = $request->file('picture')->store('images', 'public');
        } else {
            $data['picture'] = null;
        }
        $data['user_id'] = auth()->id();
        $announcement = Announcement::create($data);
        return redirect()->route('backOffice/announcements.index', ['announcement' => $announcement]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Announcement $announcement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Announcement $announcement)
    {
        return view('backOffice/announcements.edit', ['announcement' => $announcement]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreAnnouncementRequest $request, Announcement $announcement)
    {
        $data = $request->validated();
        $announcement->update($data);
        return redirect()->route('backOffice/announcements.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Announcement $announcement)
    {
        $announcement->delete();
        return redirect()->route('backOffice/announcements.index');
    }
}
