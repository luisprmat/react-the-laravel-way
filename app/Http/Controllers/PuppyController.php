<?php

namespace App\Http\Controllers;

use App\Http\Resources\PuppyResource;
use App\Models\Puppy;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PuppyController extends Controller
{
    public function index()
    {
        return Inertia::render('puppies/index', [
            'puppies' => PuppyResource::collection(Puppy::with(['user', 'likedBy'])->get()),
        ]);
    }

    public function like(Request $request, Puppy $puppy): RedirectResponse
    {
        sleep(2); // Simulates latency
        $puppy->likedBy()->toggle($request->user()->id);

        return back();
    }
}
