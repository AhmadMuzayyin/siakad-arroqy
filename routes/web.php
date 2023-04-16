<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ScoreController;
use App\Http\Controllers\RaportController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\TimeTableController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\StudentClassController;
use App\Http\Controllers\HomeroomTeacherController;

Route::get('/', function () {
    return to_route('login');
});

Route::middleware(['auth:sanctum', 'verified'])
    ->get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

Route::prefix('/')
    ->middleware(['auth:sanctum', 'verified'])
    ->group(function () {
        Route::resource('roles', RoleController::class);
        Route::resource('permissions', PermissionController::class);

        Route::get('wali-kelas', [
            HomeroomTeacherController::class,
            'index',
        ])->name('homeroom-teachers.index');
        Route::post('wali-kelas', [
            HomeroomTeacherController::class,
            'store',
        ])->name('homeroom-teachers.store');
        Route::get('wali-kelas/create', [
            HomeroomTeacherController::class,
            'create',
        ])->name('homeroom-teachers.create');
        Route::get('wali-kelas/{homeroomTeacher}', [
            HomeroomTeacherController::class,
            'show',
        ])->name('homeroom-teachers.show');
        Route::get('wali-kelas/{homeroomTeacher}/edit', [
            HomeroomTeacherController::class,
            'edit',
        ])->name('homeroom-teachers.edit');
        Route::put('wali-kelas/{homeroomTeacher}', [
            HomeroomTeacherController::class,
            'update',
        ])->name('homeroom-teachers.update');
        Route::delete('wali-kelas/{homeroomTeacher}', [
            HomeroomTeacherController::class,
            'destroy',
        ])->name('homeroom-teachers.destroy');

        Route::get('raport', [RaportController::class, 'index'])->name(
            'raports.index'
        );
        Route::post('raport', [RaportController::class, 'store'])->name(
            'raports.store'
        );
        Route::get('raport/create', [RaportController::class, 'create'])->name(
            'raports.create'
        );
        Route::get('raport/{raport}', [RaportController::class, 'show'])->name(
            'raports.show'
        );
        Route::get('raport/{raport}/edit', [
            RaportController::class,
            'edit',
        ])->name('raports.edit');
        Route::put('raport/{raport}', [
            RaportController::class,
            'update',
        ])->name('raports.update');
        Route::delete('raport/{raport}', [
            RaportController::class,
            'destroy',
        ])->name('raports.destroy');

        Route::get('nilai', [ScoreController::class, 'index'])->name(
            'scores.index'
        );
        Route::post('nilai', [ScoreController::class, 'store'])->name(
            'scores.store'
        );
        Route::get('nilai/create', [ScoreController::class, 'create'])->name(
            'scores.create'
        );
        Route::get('nilai/{score}', [ScoreController::class, 'show'])->name(
            'scores.show'
        );
        Route::get('nilai/{score}/edit', [
            ScoreController::class,
            'edit',
        ])->name('scores.edit');
        Route::put('nilai/{score}', [ScoreController::class, 'update'])->name(
            'scores.update'
        );
        Route::delete('nilai/{score}', [
            ScoreController::class,
            'destroy',
        ])->name('scores.destroy');

        Route::get('jadwal', [TimeTableController::class, 'index'])->name(
            'time-tables.index'
        );
        Route::post('jadwal', [TimeTableController::class, 'store'])->name(
            'time-tables.store'
        );
        Route::get('jadwal/create', [
            TimeTableController::class,
            'create',
        ])->name('time-tables.create');
        Route::get('jadwal/{timeTable}', [
            TimeTableController::class,
            'show',
        ])->name('time-tables.show');
        Route::get('jadwal/{timeTable}/edit', [
            TimeTableController::class,
            'edit',
        ])->name('time-tables.edit');
        Route::put('jadwal/{timeTable}', [
            TimeTableController::class,
            'update',
        ])->name('time-tables.update');
        Route::delete('jadwal/{timeTable}', [
            TimeTableController::class,
            'destroy',
        ])->name('time-tables.destroy');

        Route::get('siswa', [StudentController::class, 'index'])->name(
            'students.index'
        );
        Route::post('siswa', [StudentController::class, 'store'])->name(
            'students.store'
        );
        Route::get('siswa/create', [StudentController::class, 'create'])->name(
            'students.create'
        );
        Route::get('siswa/{student}', [StudentController::class, 'show'])->name(
            'students.show'
        );
        Route::get('siswa/{student}/edit', [
            StudentController::class,
            'edit',
        ])->name('students.edit');
        Route::put('siswa/{student}', [
            StudentController::class,
            'update',
        ])->name('students.update');
        Route::delete('siswa/{student}', [
            StudentController::class,
            'destroy',
        ])->name('students.destroy');

        Route::get('guru', [TeacherController::class, 'index'])->name(
            'teachers.index'
        );
        Route::post('guru', [TeacherController::class, 'store'])->name(
            'teachers.store'
        );
        Route::get('guru/create', [TeacherController::class, 'create'])->name(
            'teachers.create'
        );
        Route::get('guru/{teacher}', [TeacherController::class, 'show'])->name(
            'teachers.show'
        );
        Route::get('guru/{teacher}/edit', [
            TeacherController::class,
            'edit',
        ])->name('teachers.edit');
        Route::put('guru/{teacher}', [
            TeacherController::class,
            'update',
        ])->name('teachers.update');
        Route::delete('guru/{teacher}', [
            TeacherController::class,
            'destroy',
        ])->name('teachers.destroy');

        Route::get('kelas', [StudentClassController::class, 'index'])->name(
            'student-classes.index'
        );
        Route::post('kelas', [StudentClassController::class, 'store'])->name(
            'student-classes.store'
        );
        Route::get('kelas/create', [
            StudentClassController::class,
            'create',
        ])->name('student-classes.create');
        Route::get('kelas/{studentClass}', [
            StudentClassController::class,
            'show',
        ])->name('student-classes.show');
        Route::get('kelas/{studentClass}/edit', [
            StudentClassController::class,
            'edit',
        ])->name('student-classes.edit');
        Route::put('kelas/{studentClass}', [
            StudentClassController::class,
            'update',
        ])->name('student-classes.update');
        Route::delete('kelas/{studentClass}', [
            StudentClassController::class,
            'destroy',
        ])->name('student-classes.destroy');

        Route::get('semester', [SemesterController::class, 'index'])->name(
            'semesters.index'
        );
        Route::post('semester', [SemesterController::class, 'store'])->name(
            'semesters.store'
        );
        Route::get('semester/create', [
            SemesterController::class,
            'create',
        ])->name('semesters.create');
        Route::get('semester/{semester}', [
            SemesterController::class,
            'show',
        ])->name('semesters.show');
        Route::get('semester/{semester}/edit', [
            SemesterController::class,
            'edit',
        ])->name('semesters.edit');
        Route::put('semester/{semester}', [
            SemesterController::class,
            'update',
        ])->name('semesters.update');
        Route::delete('semester/{semester}', [
            SemesterController::class,
            'destroy',
        ])->name('semesters.destroy');

        Route::get('pengguna', [UserController::class, 'index'])->name(
            'users.index'
        );
        Route::post('pengguna', [UserController::class, 'store'])->name(
            'users.store'
        );
        Route::get('pengguna/create', [UserController::class, 'create'])->name(
            'users.create'
        );
        Route::get('pengguna/{user}', [UserController::class, 'show'])->name(
            'users.show'
        );
        Route::get('pengguna/{user}/edit', [
            UserController::class,
            'edit',
        ])->name('users.edit');
        Route::put('pengguna/{user}', [UserController::class, 'update'])->name(
            'users.update'
        );
        Route::delete('pengguna/{user}', [
            UserController::class,
            'destroy',
        ])->name('users.destroy');

        Route::get('mata_pelajaran', [LessonController::class, 'index'])->name(
            'lessons.index'
        );
        Route::post('mata_pelajaran', [LessonController::class, 'store'])->name(
            'lessons.store'
        );
        Route::get('mata_pelajaran/create', [
            LessonController::class,
            'create',
        ])->name('lessons.create');
        Route::get('mata_pelajaran/{lesson}', [
            LessonController::class,
            'show',
        ])->name('lessons.show');
        Route::get('mata_pelajaran/{lesson}/edit', [
            LessonController::class,
            'edit',
        ])->name('lessons.edit');
        Route::put('mata_pelajaran/{lesson}', [
            LessonController::class,
            'update',
        ])->name('lessons.update');
        Route::delete('mata_pelajaran/{lesson}', [
            LessonController::class,
            'destroy',
        ])->name('lessons.destroy');
    });
