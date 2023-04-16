<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\StudentClass;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StudentClassControllerTest extends TestCase
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
    public function it_displays_index_view_with_student_classes(): void
    {
        $studentClasses = StudentClass::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('student-classes.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.student_classes.index')
            ->assertViewHas('studentClasses');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_student_class(): void
    {
        $response = $this->get(route('student-classes.create'));

        $response->assertOk()->assertViewIs('app.student_classes.create');
    }

    /**
     * @test
     */
    public function it_stores_the_student_class(): void
    {
        $data = StudentClass::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('student-classes.store'), $data);

        $this->assertDatabaseHas('student_classes', $data);

        $studentClass = StudentClass::latest('id')->first();

        $response->assertRedirect(route('student-classes.edit', $studentClass));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_student_class(): void
    {
        $studentClass = StudentClass::factory()->create();

        $response = $this->get(route('student-classes.show', $studentClass));

        $response
            ->assertOk()
            ->assertViewIs('app.student_classes.show')
            ->assertViewHas('studentClass');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_student_class(): void
    {
        $studentClass = StudentClass::factory()->create();

        $response = $this->get(route('student-classes.edit', $studentClass));

        $response
            ->assertOk()
            ->assertViewIs('app.student_classes.edit')
            ->assertViewHas('studentClass');
    }

    /**
     * @test
     */
    public function it_updates_the_student_class(): void
    {
        $studentClass = StudentClass::factory()->create();

        $data = [
            'name' => $this->faker->text(255),
        ];

        $response = $this->put(
            route('student-classes.update', $studentClass),
            $data
        );

        $data['id'] = $studentClass->id;

        $this->assertDatabaseHas('student_classes', $data);

        $response->assertRedirect(route('student-classes.edit', $studentClass));
    }

    /**
     * @test
     */
    public function it_deletes_the_student_class(): void
    {
        $studentClass = StudentClass::factory()->create();

        $response = $this->delete(
            route('student-classes.destroy', $studentClass)
        );

        $response->assertRedirect(route('student-classes.index'));

        $this->assertSoftDeleted($studentClass);
    }
}
