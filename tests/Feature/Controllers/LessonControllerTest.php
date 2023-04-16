<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Lesson;

use App\Models\Teacher;
use App\Models\StudentClass;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LessonControllerTest extends TestCase
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
    public function it_displays_index_view_with_lessons(): void
    {
        $lessons = Lesson::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('lessons.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.lessons.index')
            ->assertViewHas('lessons');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_lesson(): void
    {
        $response = $this->get(route('lessons.create'));

        $response->assertOk()->assertViewIs('app.lessons.create');
    }

    /**
     * @test
     */
    public function it_stores_the_lesson(): void
    {
        $data = Lesson::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('lessons.store'), $data);

        $this->assertDatabaseHas('lessons', $data);

        $lesson = Lesson::latest('id')->first();

        $response->assertRedirect(route('lessons.edit', $lesson));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_lesson(): void
    {
        $lesson = Lesson::factory()->create();

        $response = $this->get(route('lessons.show', $lesson));

        $response
            ->assertOk()
            ->assertViewIs('app.lessons.show')
            ->assertViewHas('lesson');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_lesson(): void
    {
        $lesson = Lesson::factory()->create();

        $response = $this->get(route('lessons.edit', $lesson));

        $response
            ->assertOk()
            ->assertViewIs('app.lessons.edit')
            ->assertViewHas('lesson');
    }

    /**
     * @test
     */
    public function it_updates_the_lesson(): void
    {
        $lesson = Lesson::factory()->create();

        $studentClass = StudentClass::factory()->create();
        $teacher = Teacher::factory()->create();

        $data = [
            'name' => $this->faker->name(),
            'student_class_id' => $studentClass->id,
            'teacher_id' => $teacher->id,
        ];

        $response = $this->put(route('lessons.update', $lesson), $data);

        $data['id'] = $lesson->id;

        $this->assertDatabaseHas('lessons', $data);

        $response->assertRedirect(route('lessons.edit', $lesson));
    }

    /**
     * @test
     */
    public function it_deletes_the_lesson(): void
    {
        $lesson = Lesson::factory()->create();

        $response = $this->delete(route('lessons.destroy', $lesson));

        $response->assertRedirect(route('lessons.index'));

        $this->assertSoftDeleted($lesson);
    }
}
