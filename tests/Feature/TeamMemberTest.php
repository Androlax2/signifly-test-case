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
        return sprintf("%s/team-member/create", env('ADMINISTRATION_URL'));
    }

}
