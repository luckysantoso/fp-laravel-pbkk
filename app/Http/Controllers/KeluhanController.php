<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
// Use the keluhans Model
use App\Models\Keluhan;
// We will use Form Request to validate incoming requests from our store and update method
use App\Http\Requests\Keluhan\StoreRequest;
use App\Http\Requests\Keluhan\UpdateRequest;

class KeluhanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        return response()->view('keluhans.index', [
            'keluhans' => Keluhan::orderBy('updated_at', 'desc')->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return response()->view('keluhans.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        if ($request->hasFile('featured_image')) {
            // put image in the public storage
            $filePath = Storage::disk('public')->put('images/posts/featured-images', request()->file('featured_image'));
            $validated['featured_image'] = $filePath;
        }

        // insert only requests that already validated in the StoreRequest
        $create = Keluhan::create($validated);

        if($create) {
            // add flash for the success notification
            session()->flash('notif.success', 'Keluhan created successfully!');
            return redirect()->route('keluhans.index');
        }

        return abort(500);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): Response
    {
        return response()->view('keluhans.show', [
            'keluhan' => Keluhan::findOrFail($id),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): Response
    {
        return response()->view('keluhans.form', [
            'keluhan' => Keluhan::findOrFail($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id): RedirectResponse
    {
        $keluhans = Keluhan::findOrFail($id);
        $validated = $request->validated();

        if ($request->hasFile('featured_image')) {
            // delete image
            Storage::disk('public')->delete($keluhans->featured_image);

            $filePath = Storage::disk('public')->put('images/posts/featured-images', request()->file('featured_image'), 'public');
            $validated['featured_image'] = $filePath;
        }

        $update = $keluhans->update($validated);

        if($update) {
            session()->flash('notif.success', 'Keluhan updated successfully!');
            return redirect()->route('keluhans.index');
        }

        return abort(500);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $keluhans = Keluhan::findOrFail($id);

        Storage::disk('public')->delete($keluhans->featured_image);
        
        $delete = $keluhans->delete($id);

        if($delete) {
            session()->flash('notif.success', 'Keluhan deleted successfully!');
            return redirect()->route('keluhans.index');
        }

        return abort(500);
    }
}
