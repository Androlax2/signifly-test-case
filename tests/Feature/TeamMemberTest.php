<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TeamMemberTest extends TestCase
{
    use RefreshDatabase;

    public function test_team_member_creation_screen_can_be_rendered()
    {
        $response = $this->get($this->getTeamMemberCreationRoute());

        $response->assertSuccessful();
    }

    public function test_team_members_listing_is_working()
    {
        $teamMembers = TeamMember::factory()->create(10);

        $response = $this->get($this->getTeamMemberListingRoute());

        $response->assertSuccessful();
        $teamMembers->map(function ($teamMember) use ($response) {
            $response->assertSee($teamMember->first_name);
            $response->assertSee($teamMember->last_name);
            $response->assertSee($teamMember->job_title);
            // TODO: Checker qu'on voit la photo
        });
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
        // TODO: Checker qu'on voit la photo
    }

    public function test_team_member_can_be_created_through_administration()
    {
        $teamMember = TeamMember::factory()->make();

        $response = $this
            ->post($this->getTeamMemberCreationRoute(), $teamMember->toArray());

        $response->assertCreated();
        $this->assertDatabaseCount('team_members', 1);
        $this->assertDatabaseHas('team_members', $teamMember->toArray());
    }

    /**
     * Get the team member route creation.
     *
     * @return string
     */
    protected function getTeamMemberCreationRoute(): string
    {
        return sprintf("%s/team/create", env('ADMINISTRATION_URL'));
    }

    /**
     * Get the team member listing route.
     *
     * @return string
     */
    protected function getTeamMemberListingRoute(): string
    {
        return sprintf("%s/team", env('ADMINISTRATION_URL'));
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
        return "team/{$teamMember->first_name}-{$teamMember->last_name}";
    }

}
