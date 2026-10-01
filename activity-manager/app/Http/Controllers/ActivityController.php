<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreActivityRequest;
use App\Http\Requests\UpdateActivityRequest;
use App\Models\Activity;
use App\Models\Category;
use App\Services\ActivityService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ActivityController extends Controller
{
    public function index(Request $request): View
    {
        $activities = Activity::query()
            ->with('category')
            ->search($request->search)
            ->inCategory($request->category_id)
            ->ofStatus($request->status)
            ->sortByStart($request->sort)
            ->paginate(10)
            ->withQueryString();

        return view('activities.index', [
            'activities' => $activities,
            'categories' => $this->categoryOptions(),
        ]);
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

    public function publish(Activity $activity, ActivityService $service): RedirectResponse
    {
        $service->publish($activity);

        return back()->with('success', 'Kegiatan berhasil dipublikasikan.');
    }

    public function complete(Activity $activity, ActivityService $service): RedirectResponse
    {
        $service->complete($activity);

        return back()->with('success', 'Kegiatan ditandai selesai.');
    }

    private function categoryOptions()
    {
        return Category::orderBy('name')->get();
    }
}