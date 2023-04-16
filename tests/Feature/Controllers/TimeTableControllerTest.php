<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\TimeTable;

use App\Models\Lesson;
use App\Models\Teacher;
use App\Models\Semester;
use App\Models\StudentClass;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TimeTableControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_time_tables(): void
    {
        $timeTables = TimeTable::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('time-tables.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.time_tables.index')
            ->assertViewHas('timeTables');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_time_table(): void
    {
        $response = $this->get(route('time-tables.create'));

        $response->assertOk()->assertViewIs('app.time_tables.create');
    }

    /**
     * @test
     */
    public function it_stores_the_time_table(): void
    {
        $data = TimeTable::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('time-tables.store'), $data);

        $this->assertDatabaseHas('time_tables', $data);

        $timeTable = TimeTable::latest('id')->first();

        $response->assertRedirect(route('time-tables.edit', $timeTable));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_time_table(): void
    {
        $timeTable = TimeTable::factory()->create();

        $response = $this->get(route('time-tables.show', $timeTable));

        $response
            ->assertOk()
            ->assertViewIs('app.time_tables.show')
            ->assertViewHas('timeTable');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_time_table(): void
    {
        $timeTable = TimeTable::factory()->create();

        $response = $this->get(route('time-tables.edit', $timeTable));

        $response
            ->assertOk()
            ->assertViewIs('app.time_tables.edit')
            ->assertViewHas('timeTable');
    }

    /**
     * @test
     */
    public function it_updates_the_time_table(): void
    {
        $timeTable = TimeTable::factory()->create();

        $studentClass = StudentClass::factory()->create();
        $lesson = Lesson::factory()->create();
        $teacher = Teacher::factory()->create();
        $semester = Semester::factory()->create();

        $data = [
            'day' => $this->faker->text(255),
            'clock_in' => $this->faker->time(),
            'clock_out' => $this->faker->time(),
            'student_class_id' => $studentClass->id,
            'lesson_id' => $lesson->id,
            'teacher_id' => $teacher->id,
            'semester_id' => $semester->id,
        ];

        $response = $this->put(route('time-tables.update', $timeTable), $data);

        $data['id'] = $timeTable->id;

        $this->assertDatabaseHas('time_tables', $data);

        $response->assertRedirect(route('time-tables.edit', $timeTable));
    }

    /**
     * @test
     */
    public function it_deletes_the_time_table(): void
    {
        $timeTable = TimeTable::factory()->create();

        $response = $this->delete(route('time-tables.destroy', $timeTable));

        $response->assertRedirect(route('time-tables.index'));

        $this->assertSoftDeleted($timeTable);
    }
}
