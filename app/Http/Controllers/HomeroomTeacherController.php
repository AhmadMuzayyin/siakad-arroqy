<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\StudentClass;
use App\Models\HomeroomTeacher;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\HomeroomTeacherStoreRequest;
use App\Http\Requests\HomeroomTeacherUpdateRequest;

class HomeroomTeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', HomeroomTeacher::class);

        $search = $request->get('search', '');

        $homeroomTeachers = HomeroomTeacher::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.homeroom_teachers.index',
            compact('homeroomTeachers', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', HomeroomTeacher::class);

        $teachers = Teacher::pluck('name', 'id');
        $studentClasses = StudentClass::pluck('name', 'id');

        return view(
            'app.homeroom_teachers.create',
            compact('teachers', 'studentClasses')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(
        HomeroomTeacherStoreRequest $request
    ): RedirectResponse {
        $this->authorize('create', HomeroomTeacher::class);

        $validated = $request->validated();

        $homeroomTeacher = HomeroomTeacher::create($validated);

        return redirect()
            ->route('homeroom-teachers.edit', $homeroomTeacher)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(
        Request $request,
        HomeroomTeacher $homeroomTeacher
    ): View {
        $this->authorize('view', $homeroomTeacher);

        return view('app.homeroom_teachers.show', compact('homeroomTeacher'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(
        Request $request,
        HomeroomTeacher $homeroomTeacher
    ): View {
        $this->authorize('update', $homeroomTeacher);

        $teachers = Teacher::pluck('name', 'id');
        $studentClasses = StudentClass::pluck('name', 'id');

        return view(
            'app.homeroom_teachers.edit',
            compact('homeroomTeacher', 'teachers', 'studentClasses')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        HomeroomTeacherUpdateRequest $request,
        HomeroomTeacher $homeroomTeacher
    ): RedirectResponse {
        $this->authorize('update', $homeroomTeacher);

        $validated = $request->validated();

        $homeroomTeacher->update($validated);

        return redirect()
            ->route('homeroom-teachers.edit', $homeroomTeacher)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        HomeroomTeacher $homeroomTeacher
    ): RedirectResponse {
        $this->authorize('delete', $homeroomTeacher);

        $homeroomTeacher->delete();

        return redirect()
            ->route('homeroom-teachers.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
