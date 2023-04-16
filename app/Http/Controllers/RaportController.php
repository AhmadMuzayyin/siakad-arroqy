<?php

namespace App\Http\Controllers;

use App\Models\Score;
use App\Models\Raport;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\RaportStoreRequest;
use App\Http\Requests\RaportUpdateRequest;

class RaportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Raport::class);

        $search = $request->get('search', '');

        $raports = Raport::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.raports.index', compact('raports', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Raport::class);

        $scores = Score::pluck('id', 'id');

        return view('app.raports.create', compact('scores'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RaportStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Raport::class);

        $validated = $request->validated();
        if ($request->hasFile('signature')) {
            $validated['signature'] = $request
                ->file('signature')
                ->store('public');
        }

        if ($request->hasFile('principal_signature')) {
            $validated['principal_signature'] = $request
                ->file('principal_signature')
                ->store('public');
        }

        $raport = Raport::create($validated);

        return redirect()
            ->route('raports.edit', $raport)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Raport $raport): View
    {
        $this->authorize('view', $raport);

        return view('app.raports.show', compact('raport'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Raport $raport): View
    {
        $this->authorize('update', $raport);

        $scores = Score::pluck('id', 'id');

        return view('app.raports.edit', compact('raport', 'scores'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        RaportUpdateRequest $request,
        Raport $raport
    ): RedirectResponse {
        $this->authorize('update', $raport);

        $validated = $request->validated();
        if ($request->hasFile('signature')) {
            if ($raport->signature) {
                Storage::delete($raport->signature);
            }

            $validated['signature'] = $request
                ->file('signature')
                ->store('public');
        }

        if ($request->hasFile('principal_signature')) {
            if ($raport->principal_signature) {
                Storage::delete($raport->principal_signature);
            }

            $validated['principal_signature'] = $request
                ->file('principal_signature')
                ->store('public');
        }

        $raport->update($validated);

        return redirect()
            ->route('raports.edit', $raport)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Raport $raport): RedirectResponse
    {
        $this->authorize('delete', $raport);

        if ($raport->signature) {
            Storage::delete($raport->signature);
        }

        if ($raport->principal_signature) {
            Storage::delete($raport->principal_signature);
        }

        $raport->delete();

        return redirect()
            ->route('raports.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
