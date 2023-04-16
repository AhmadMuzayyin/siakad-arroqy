<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Teacher;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\StudentClass;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\LessonStoreRequest;
use App\Http\Requests\LessonUpdateRequest;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Lesson::class);

        $search = $request->get('search', '');

        $lessons = Lesson::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.lessons.index', compact('lessons', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Lesson::class);

        $studentClasses = StudentClass::pluck('name', 'id');
        $teachers = Teacher::pluck('name', 'id');

        return view(
            'app.lessons.create',
            compact('studentClasses', 'teachers')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LessonStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Lesson::class);

        $validated = $request->validated();

        $lesson = Lesson::create($validated);

        return redirect()
            ->route('lessons.edit', $lesson)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Lesson $lesson): View
    {
        $this->authorize('view', $lesson);

        return view('app.lessons.show', compact('lesson'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Lesson $lesson): View
    {
        $this->authorize('update', $lesson);

        $studentClasses = StudentClass::pluck('name', 'id');
        $teachers = Teacher::pluck('name', 'id');

        return view(
            'app.lessons.edit',
            compact('lesson', 'studentClasses', 'teachers')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        LessonUpdateRequest $request,
        Lesson $lesson
    ): RedirectResponse {
        $this->authorize('update', $lesson);

        $validated = $request->validated();

        $lesson->update($validated);

        return redirect()
            ->route('lessons.edit', $lesson)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Lesson $lesson): RedirectResponse
    {
        $this->authorize('delete', $lesson);

        $lesson->delete();

        return redirect()
            ->route('lessons.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
