<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\HomeroomTeacher;

use App\Models\Teacher;
use App\Models\StudentClass;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HomeroomTeacherControllerTest extends TestCase
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
    public function it_displays_index_view_with_homeroom_teachers(): void
    {
        $homeroomTeachers = HomeroomTeacher::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('homeroom-teachers.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.homeroom_teachers.index')
            ->assertViewHas('homeroomTeachers');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_homeroom_teacher(): void
    {
        $response = $this->get(route('homeroom-teachers.create'));

        $response->assertOk()->assertViewIs('app.homeroom_teachers.create');
    }

    /**
     * @test
     */
    public function it_stores_the_homeroom_teacher(): void
    {
        $data = HomeroomTeacher::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('homeroom-teachers.store'), $data);

        $this->assertDatabaseHas('homeroom_teachers', $data);

        $homeroomTeacher = HomeroomTeacher::latest('id')->first();

        $response->assertRedirect(
            route('homeroom-teachers.edit', $homeroomTeacher)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_homeroom_teacher(): void
    {
        $homeroomTeacher = HomeroomTeacher::factory()->create();

        $response = $this->get(
            route('homeroom-teachers.show', $homeroomTeacher)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.homeroom_teachers.show')
            ->assertViewHas('homeroomTeacher');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_homeroom_teacher(): void
    {
        $homeroomTeacher = HomeroomTeacher::factory()->create();

        $response = $this->get(
            route('homeroom-teachers.edit', $homeroomTeacher)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.homeroom_teachers.edit')
            ->assertViewHas('homeroomTeacher');
    }

    /**
     * @test
     */
    public function it_updates_the_homeroom_teacher(): void
    {
        $homeroomTeacher = HomeroomTeacher::factory()->create();

        $teacher = Teacher::factory()->create();
        $studentClass = StudentClass::factory()->create();

        $data = [
            'teacher_id' => $teacher->id,
            'student_class_id' => $studentClass->id,
        ];

        $response = $this->put(
            route('homeroom-teachers.update', $homeroomTeacher),
            $data
        );

        $data['id'] = $homeroomTeacher->id;

        $this->assertDatabaseHas('homeroom_teachers', $data);

        $response->assertRedirect(
            route('homeroom-teachers.edit', $homeroomTeacher)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_homeroom_teacher(): void
    {
        $homeroomTeacher = HomeroomTeacher::factory()->create();

        $response = $this->delete(
            route('homeroom-teachers.destroy', $homeroomTeacher)
        );

        $response->assertRedirect(route('homeroom-teachers.index'));

        $this->assertSoftDeleted($homeroomTeacher);
    }
}
