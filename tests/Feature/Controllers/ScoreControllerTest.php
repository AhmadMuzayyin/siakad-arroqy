<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Score;

use App\Models\Lesson;
use App\Models\Student;
use App\Models\Semester;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ScoreControllerTest extends TestCase
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
    public function it_displays_index_view_with_scores(): void
    {
        $scores = Score::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('scores.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.scores.index')
            ->assertViewHas('scores');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_score(): void
    {
        $response = $this->get(route('scores.create'));

        $response->assertOk()->assertViewIs('app.scores.create');
    }

    /**
     * @test
     */
    public function it_stores_the_score(): void
    {
        $data = Score::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('scores.store'), $data);

        $this->assertDatabaseHas('scores', $data);

        $score = Score::latest('id')->first();

        $response->assertRedirect(route('scores.edit', $score));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_score(): void
    {
        $score = Score::factory()->create();

        $response = $this->get(route('scores.show', $score));

        $response
            ->assertOk()
            ->assertViewIs('app.scores.show')
            ->assertViewHas('score');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_score(): void
    {
        $score = Score::factory()->create();

        $response = $this->get(route('scores.edit', $score));

        $response
            ->assertOk()
            ->assertViewIs('app.scores.edit')
            ->assertViewHas('score');
    }

    /**
     * @test
     */
    public function it_updates_the_score(): void
    {
        $score = Score::factory()->create();

        $lesson = Lesson::factory()->create();
        $student = Student::factory()->create();
        $semester = Semester::factory()->create();

        $data = [
            'attendance' => $this->faker->randomNumber(0),
            'test' => $this->faker->randomNumber(0),
            'lesson_id' => $lesson->id,
            'student_id' => $student->id,
            'semester_id' => $semester->id,
        ];

        $response = $this->put(route('scores.update', $score), $data);

        $data['id'] = $score->id;

        $this->assertDatabaseHas('scores', $data);

        $response->assertRedirect(route('scores.edit', $score));
    }

    /**
     * @test
     */
    public function it_deletes_the_score(): void
    {
        $score = Score::factory()->create();

        $response = $this->delete(route('scores.destroy', $score));

        $response->assertRedirect(route('scores.index'));

        $this->assertSoftDeleted($score);
    }
}
