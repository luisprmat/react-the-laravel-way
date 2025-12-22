<?php

namespace App\Http\Controllers;

use App\Actions\OptimizeWebpImageAction;
use App\Http\Resources\PuppyResource;
use App\Models\Puppy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class PuppyController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        return Inertia::render('puppies/index', [
            'puppies' => PuppyResource::collection(
                Puppy::query()
                    ->when($search, function (Builder $query, string $search) {
                        $query->where('name', 'like', "%{$search}%")
                            ->orWhere('trait', 'like', "%{$search}%");
                    })
                    ->with(['user', 'likedBy'])
                    ->latest()
                    ->paginate(9)
                    ->withQueryString()
            ),
            'likedPuppies' => $request->user()
                ? PuppyResource::collection($request->user()->likedPuppies)
                : [],
            'filters' => [
                'search' => $search,
            ],
        ]);
    }

    public function like(Request $request, Puppy $puppy): RedirectResponse
    {
        $puppy->likedBy()->toggle($request->user()->id);

        return back();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'trait' => ['required', 'string', 'max:255'],
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:5120'],
        ]);

        $image_url = null;

        if ($request->hasFile('image')) {
            $optimized = new OptimizeWebpImageAction()->handle($request->file('image'));
            $path = 'puppies/'.$optimized['fileName'];

            $stored = config('filesystems.default') === 's3'
                ? Storage::put($path, $optimized['webpString'], 'public')
                : Storage::disk('public')->put($path, $optimized['webpString']);

            if (! $stored) {
                return back()->withErrors(['image' => __('Failed to upload image.')]);
            }
            $image_url = $path;
        }

        $request->user()->puppies()->create([
            'name' => $request->name,
            'trait' => $request->trait,
            'image_url' => $image_url,
        ]);

        return to_route('home', ['page' => 1])->with('success', __('Puppy created successfully!'));
    }

    public function update(Request $request, Puppy $puppy)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'trait' => ['required', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:5120'],
        ]);

        if ($request->hasFile('image')) {
            $oldImagePath = $puppy->image_url;

            $optimized = new OptimizeWebpImageAction()->handle($request->file('image'));
            $path = 'puppies/'.$optimized['fileName'];

            $stored = config('filesystems.default') === 's3'
                ? Storage::put($path, $optimized['webpString'], 'public')
                : Storage::disk('public')->put($path, $optimized['webpString']);

            if (! $stored) {
                return back()->withErrors(['image' => __('Failed to upload image.')]);
            }

            $puppy->image_url = $path;

            if ($oldImagePath && Storage::disk('public')->exists($oldImagePath)) {
                Storage::disk('public')->delete($oldImagePath);
            }
        }

        $puppy->name = $request->name;
        $puppy->trait = $request->trait;

        $puppy->save();

        return back()->with('success', __('Puppy updated successfully!'));
    }

    public function destroy(Request $request, Puppy $puppy)
    {
        $imagePath = $puppy->image_url;

        if ($request->user()->cannot('delete', $puppy)) {
            return back()
                ->withErrors(['error' => __('You do not have permission to delete this puppy.')]);
        }

        $puppy->delete();

        if ($imagePath && Storage::disk('public')->exists($imagePath)) {
            Storage::disk('public')->delete($imagePath);
        }

        return to_route('home', ['page' => 1])
            ->with('success', __('Puppy deleted successfully!'));
    }
}
