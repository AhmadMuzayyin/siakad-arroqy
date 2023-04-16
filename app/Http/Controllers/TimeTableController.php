<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Teacher;
use App\Models\Semester;
use App\Models\TimeTable;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\StudentClass;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\TimeTableStoreRequest;
use App\Http\Requests\TimeTableUpdateRequest;

class TimeTableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', TimeTable::class);

        $search = $request->get('search', '');

        $timeTables = TimeTable::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.time_tables.index', compact('timeTables', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', TimeTable::class);

        $semesters = Semester::pluck('name', 'id');
        $studentClasses = StudentClass::pluck('name', 'id');
        $lessons = Lesson::pluck('name', 'id');
        $teachers = Teacher::pluck('name', 'id');

        return view(
            'app.time_tables.create',
            compact('semesters', 'studentClasses', 'lessons', 'teachers')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TimeTableStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', TimeTable::class);

        $validated = $request->validated();

        $timeTable = TimeTable::create($validated);

        return redirect()
            ->route('time-tables.edit', $timeTable)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, TimeTable $timeTable): View
    {
        $this->authorize('view', $timeTable);

        return view('app.time_tables.show', compact('timeTable'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, TimeTable $timeTable): View
    {
        $this->authorize('update', $timeTable);

        $semesters = Semester::pluck('name', 'id');
        $studentClasses = StudentClass::pluck('name', 'id');
        $lessons = Lesson::pluck('name', 'id');
        $teachers = Teacher::pluck('name', 'id');

        return view(
            'app.time_tables.edit',
            compact(
                'timeTable',
                'semesters',
                'studentClasses',
                'lessons',
                'teachers'
            )
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        TimeTableUpdateRequest $request,
        TimeTable $timeTable
    ): RedirectResponse {
        $this->authorize('update', $timeTable);

        $validated = $request->validated();

        $timeTable->update($validated);

        return redirect()
            ->route('time-tables.edit', $timeTable)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        TimeTable $timeTable
    ): RedirectResponse {
        $this->authorize('delete', $timeTable);

        $timeTable->delete();

        return redirect()
            ->route('time-tables.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
