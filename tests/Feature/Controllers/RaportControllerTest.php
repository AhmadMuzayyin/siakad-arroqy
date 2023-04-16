<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Raport;

use App\Models\Score;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RaportControllerTest extends TestCase
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
    public function it_displays_index_view_with_raports(): void
    {
        $raports = Raport::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('raports.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.raports.index')
            ->assertViewHas('raports');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_raport(): void
    {
        $response = $this->get(route('raports.create'));

        $response->assertOk()->assertViewIs('app.raports.create');
    }

    /**
     * @test
     */
    public function it_stores_the_raport(): void
    {
        $data = Raport::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('raports.store'), $data);

        $this->assertDatabaseHas('raports', $data);

        $raport = Raport::latest('id')->first();

        $response->assertRedirect(route('raports.edit', $raport));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_raport(): void
    {
        $raport = Raport::factory()->create();

        $response = $this->get(route('raports.show', $raport));

        $response
            ->assertOk()
            ->assertViewIs('app.raports.show')
            ->assertViewHas('raport');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_raport(): void
    {
        $raport = Raport::factory()->create();

        $response = $this->get(route('raports.edit', $raport));

        $response
            ->assertOk()
            ->assertViewIs('app.raports.edit')
            ->assertViewHas('raport');
    }

    /**
     * @test
     */
    public function it_updates_the_raport(): void
    {
        $raport = Raport::factory()->create();

        $score = Score::factory()->create();

        $data = [
            'principal_signature' => $this->faker->text(255),
            'signature' => $this->faker->text(255),
            'status' => 'already_printed',
            'score_id' => $score->id,
        ];

        $response = $this->put(route('raports.update', $raport), $data);

        $data['id'] = $raport->id;

        $this->assertDatabaseHas('raports', $data);

        $response->assertRedirect(route('raports.edit', $raport));
    }

    /**
     * @test
     */
    public function it_deletes_the_raport(): void
    {
        $raport = Raport::factory()->create();

        $response = $this->delete(route('raports.destroy', $raport));

        $response->assertRedirect(route('raports.index'));

        $this->assertSoftDeleted($raport);
    }
}
