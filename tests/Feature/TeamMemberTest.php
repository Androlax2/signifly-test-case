<?php

namespace Tests\Feature;

use App\Models\TeamMember;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Storage;
use Tests\TestCase;

/**
 * @preserveGlobalState disabled
 * @runTestsInSeparateProcesses
 */
class TeamMemberTest extends TestCase
{
    use RefreshDatabase;

    public function test_team_member_creation_screen_can_be_rendered_in_administration()
    {
        $response = $this->get($this->getTeamMemberCreationRoute());

        $response->assertSuccessful();
    }

    public function test_team_members_listing_is_working_in_administration()
    {
        $teamMembers = TeamMember::factory(10)->create();

        $response = $this->get($this->getAdministrationTeamMemberListingRoute());

        $response->assertSuccessful();
        $teamMembers->map(function ($teamMember) use ($response) {
            $response->assertSee($teamMember->first_name);
            $response->assertSee($teamMember->last_name);
            $response->assertSee($teamMember->job_title);
            $response->assertSee($teamMember->photo_path);
            $response->assertSee(route('administration.team-members.edit', $teamMember->id));
            $response->assertSee(route('administration.team-members.delete', $teamMember->id));
        });
    }

    public function test_team_members_listing_is_working_outside_administration()
    {
        $teamMembers = TeamMember::factory(10)->create();

        $response = $this->get('team-members');

        $response->assertSuccessful();
        $teamMembers->map(function ($teamMember) use ($response) {
            $response->assertSee($teamMember->first_name);
            $response->assertSee($teamMember->last_name);
            $response->assertSee($teamMember->job_title);
            $response->assertSee($teamMember->photo_path);
            $response->assertDontSee(route('administration.team-members.edit', $teamMember->id));
            $response->assertDontSee(route('administration.team-members.delete', $teamMember->id));
        });
    }

    public function test_team_member_can_be_created_in_administration()
    {
        Storage::fake();

        $teamMember = TeamMember::factory()->make();

        $photo = UploadedFile::fake()->image('team-member.jpg');
        $photoSignature = sha1_file($photo->getPathname());

        $response = $this
            ->post(
                $this->getTeamMemberCreationRoute(),
                [
                    'first_name'  => $teamMember->first_name,
                    'last_name'   => $teamMember->last_name,
                    'email'       => $teamMember->email,
                    'job_title'   => $teamMember->job_title,
                    'location'    => $teamMember->location,
                    'phone'       => $teamMember->phone,
                    'description' => $teamMember->description,
                    'photo'       => $photo,
                ]
            );

        Storage::disk('public')->assertExists("team-members/1/{$photoSignature}.jpg");

        $this->assertDatabaseCount('team_members', 1);
        $this->assertDatabaseHas('team_members', [
            'first_name'  => $teamMember->first_name,
            'last_name'   => $teamMember->last_name,
            'email'       => $teamMember->email,
            'job_title'   => $teamMember->job_title,
            'location'    => $teamMember->location,
            'phone'       => $teamMember->phone,
            'description' => $teamMember->description,
            'photo_path'  => "team-members/1/{$photoSignature}.jpg",
        ]);

        $response->assertRedirect($this->getAdministrationTeamMemberListingRoute());
        $this->followRedirects($response)->assertSee('The team member has been created.');
    }

    public function test_team_member_detail_page_is_working()
    {
        $teamMember = TeamMember::factory()->create();

        $response = $this->get($this->getTeamMemberDetailRoute($teamMember));
        $response->assertSuccessful();
        $response->assertSee($teamMember->first_name);
        $response->assertSee($teamMember->last_name);
        $response->assertSee($teamMember->job_title);
        $response->assertSee($teamMember->location);
        $response->assertSee($teamMember->phone);
        $response->assertSee($teamMember->email);
        $response->assertSee($teamMember->description);
        $response->assertSee($teamMember->photo_path);
    }

    /**
     * Get the team member route creation.
     *
     * @return string
     */
    protected function getTeamMemberCreationRoute(): string
    {
        return sprintf('%s/team-members/create', env('ADMINISTRATION_URL'));
    }

    /**
     * Get the team member listing route.
     *
     * @return string
     */
    protected function getAdministrationTeamMemberListingRoute(): string
    {
        return sprintf('%s/team-members', env('ADMINISTRATION_URL'));
    }

    /**
     * Get the team member detail route.
     *
     * @param TeamMember $teamMember
     *
     * @return string
     */
    protected function getTeamMemberDetailRoute(TeamMember $teamMember): string
    {
        return "team-members/{$teamMember->first_name}-{$teamMember->last_name}";
    }
}
