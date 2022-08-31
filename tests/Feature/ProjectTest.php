<?php

namespace Tests\Feature;

use App\Mail\NewProjectRequest;
use App\Models\Project;
use App\Models\TeamMember;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

/**
 * @preserveGlobalState disabled
 * @runTestsInSeparateProcesses
 */
class ProjectTest extends TestCase
{
    use RefreshDatabase;

    public function test_administration_project_creation_screen_can_be_rendered()
    {
        $response = $this->get($this->getAdministrationProjectCreationRoute());

        $response->assertSuccessful();
    }

    public function test_guest_project_creation_screen_can_be_rendered()
    {
        $response = $this->get($this->getGuestProjectCreationRoute());

        $response->assertSuccessful();
    }

    public function test_projects_listing_is_working_in_administration()
    {
        $projects = Project::factory(10)->create();

        $response = $this->get($this->getAdministrationProjectListingRoute());

        $response->assertSuccessful();
        $projects->map(function ($project) use ($response) {
            $response->assertSee($project->description);
            $response->assertSee(route('administration.projects.edit', $project->id));
            $response->assertSee(route('administration.projects.delete', $project->id));
        });
    }

    public function test_project_can_be_created_through_administration()
    {
        $teamMembers = TeamMember::factory(5)->create();

        $response = $this->post($this->getAdministrationProjectCreationRoute(), [
            'description' => 'New project',
            'slug' => 'my-slug',
            'team_member_ids' => $teamMembers->pluck('id')->toArray(),
        ]);

        $response->assertRedirect(route('administration.projects.index'));
        $this->assertDatabaseHas('projects', [
            'description' => 'New project',
            'slug' => 'my-slug',
        ]);
        $teamMembers->map(function ($teamMember) {
            $this->assertDatabaseHas('project_team_member', [
                'project_id' => 1,
                'team_member_id' => $teamMember->id,
            ]);
        });
        $this->followRedirects($response)->assertSee('Project created');
    }

    public function test_guest_can_create_a_project_and_inform_us()
    {
        Mail::fake();

        $teamMembers = TeamMember::factory(5)->create();

        $response = $this->post($this->getGuestProjectCreationRoute(), [
            'email' => 'client@gmail.com',
            'description' => 'New project Description',
            'team_member_ids' => $teamMembers->pluck('id')->toArray(),
        ]);

        $response->assertRedirect('/');
        $this->followRedirects($response)->assertSee('Your request has been sent to us. We will come back soon.');
        $this->assertDatabaseMissing('projects', [
            'description' => 'New project Description',
        ]);
        $teamMembers->map(function ($teamMember) {
            $this->assertDatabaseMissing('project_team_member', [
                'project_id' => 1,
                'team_member_id' => $teamMember->id,
            ]);
        });

        Mail::assertSent(NewProjectRequest::class);
    }

    public function test_project_detail_page_is_working()
    {
        $project = Project::factory()
                          ->hasAttached(TeamMember::factory(5)->create())
                          ->create();
        $response = $this->get($this->getProjectDetailRoute($project));
        $response->assertSuccessful();
        $response->assertSee($project->description);

        $project->teamMembers->map(function (TeamMember $teamMember) use ($response) {
            $response->assertSee($teamMember->first_name);
            $response->assertSee($teamMember->last_name);
            $response->assertSee($teamMember->job_title);
            $response->assertSee($teamMember->photo_path);
        });
    }

    /**
     * Get the project route creation in administration.
     *
     * @return string
     */
    protected function getAdministrationProjectCreationRoute(): string
    {
        return sprintf('%s/projects/create', env('ADMINISTRATION_URL'));
    }

    /**
     * Get the project route creation for guests.
     *
     * @return string
     */
    protected function getGuestProjectCreationRoute(): string
    {
        return 'projects/create';
    }

    /**
     * Get the project listing route in administration.
     *
     * @return string
     */
    protected function getAdministrationProjectListingRoute(): string
    {
        return sprintf('%s/projects', env('ADMINISTRATION_URL'));
    }

    /**
     * Get the project detail route.
     *
     * @param  Project  $project
     * @return string
     */
    protected function getProjectDetailRoute(Project $project): string
    {
        return "projects/{$project->slug}";
    }
}
