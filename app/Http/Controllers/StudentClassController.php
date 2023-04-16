<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\StudentClass;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StudentClassStoreRequest;
use App\Http\Requests\StudentClassUpdateRequest;

class StudentClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', StudentClass::class);

        $search = $request->get('search', '');

        $studentClasses = StudentClass::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.student_classes.index',
            compact('studentClasses', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', StudentClass::class);

        return view('app.student_classes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StudentClassStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', StudentClass::class);

        $validated = $request->validated();

        $studentClass = StudentClass::create($validated);

        return redirect()
            ->route('student-classes.edit', $studentClass)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, StudentClass $studentClass): View
    {
        $this->authorize('view', $studentClass);

        return view('app.student_classes.show', compact('studentClass'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, StudentClass $studentClass): View
    {
        $this->authorize('update', $studentClass);

        return view('app.student_classes.edit', compact('studentClass'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        StudentClassUpdateRequest $request,
        StudentClass $studentClass
    ): RedirectResponse {
        $this->authorize('update', $studentClass);

        $validated = $request->validated();

        $studentClass->update($validated);

        return redirect()
            ->route('student-classes.edit', $studentClass)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        StudentClass $studentClass
    ): RedirectResponse {
        $this->authorize('delete', $studentClass);

        $studentClass->delete();

        return redirect()
            ->route('student-classes.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
