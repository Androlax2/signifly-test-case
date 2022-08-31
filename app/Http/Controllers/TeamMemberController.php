<?php

namespace App\Http\Controllers;

use App\Helpers;
use App\Http\Requests\TeamMemberRequest;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TeamMemberController extends Controller
{
    /**
     * Render the team member listing in administration.
     */
    public function administrationIndex()
    {
        return view('administration.team-member.index', [
            'teamMembers' => TeamMember::orderByDesc('id')->get(),
        ]);
    }

    /**
     * Render the team member listing outside administration.
     */
    public function index()
    {
        return view('team-member.index', [
            'teamMembers' => TeamMember::orderByDesc('id')->get(),
        ]);
    }

    /**
     * Render the creation screen.
     */
    public function create()
    {
        return view('administration.team-member.create');
    }

    /**
     * Create a team member.
     *
     * @param TeamMemberRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(TeamMemberRequest $request)
    {
        $teamMember = TeamMember::create($request->validated());
        $teamMember->save();

        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $filename = "{$teamMember->generateStorageFileName($photo)}.{$photo->getClientOriginalExtension()}";

            if (Storage::disk('public')->putFileAs($teamMember->getStorageDir(), $photo, $filename)) {
                $teamMember->photo_path = "{$teamMember->getStorageDir()}/{$filename}";
                $teamMember->save();
            }
        }

        return to_route('administration.team-members.index')->with(Helpers::getFlashSuccessMessage('The team member has been created.'));
    }

    /**
     * Show a team member.
     *
     * @param TeamMember $teamMember
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(TeamMember $teamMember)
    {
        return view('team-member.show', [
            'teamMember' => $teamMember,
        ]);
    }

    /**
     * TODO : A faire
     */
    public function edit($id)
    {
    }

    /**
     * TODO : A faire
     */
    public function update(Request $request, $id)
    {
    }

    /**
     * TODO : A faire
     */
    public function destroy($id)
    {
    }
}
