<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreActivityRequest;
use App\Http\Requests\UpdateActivityRequest;
use App\Models\Activity;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ActivityController extends Controller
{
    public function index(): View
    {
        $status = request()->query('status');
        $validStatuses = ['Planned', 'Ongoing', 'Done'];

        $activities = Activity::query()
            ->with('category')
            ->when(
                $status && in_array($status, $validStatuses, true),
                fn ($query) => $query->where('status', $status)
            )
            ->orderBy('activity_date')
            ->get();

        return view('activities.index', compact('activities', 'status'));
    }

    public function create(): View
    {
        return view('activities.create', ['categories' => $this->categoryOptions()]);
    }

    public function store(StoreActivityRequest $request): RedirectResponse
    {
        Activity::create($request->validated());
        return redirect()->route('activities.index')->with('success', 'Kegiatan berhasil ditambahkan.');
    }

    public function show(Activity $activity): View
    {
        $activity->load('category');
        return view('activities.show', compact('activity'));
    }

    public function edit(Activity $activity): View
    {
        return view('activities.edit', [
            'activity' => $activity,
            'categories' => $this->categoryOptions(),
        ]);
    }

    public function update(UpdateActivityRequest $request, Activity $activity): RedirectResponse
    {
        $activity->update($request->validated());
        return redirect()->route('activities.index')->with('success', 'Kegiatan berhasil diperbarui.');
    }

    public function destroy(Activity $activity): RedirectResponse
    {
        $activity->delete();
        return redirect()->route('activities.index')->with('success', 'Kegiatan berhasil dihapus.');
    }

    private function categoryOptions()
    {
        return Category::orderBy('name')->get();
    }
}