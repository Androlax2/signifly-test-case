<?php

namespace App\Http\Controllers;

use App\Helpers;
use App\Http\Requests\ProjectRequest;
use App\Mail\NewProjectRequest;
use App\Models\Project;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Str;

class ProjectController extends Controller
{
    /**
     * Render all the projects.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('administration.project.index', [
            'projects' => Project::all(),
        ]);
    }

    /**
     * Render the project creation in administration.
     */
    public function administrationCreate()
    {
        return view('administration.project.create');
    }

    /**
     * Create a project in administration.
     *
     * @param  ProjectRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function administrationStore(ProjectRequest $request)
    {
        $project = Project::create($request->validated());

        if ($request->has('team_member_ids')) {
            $project->teamMembers()->sync($request->get('team_member_ids'));
        }

        $project->save();

        return to_route('administration.projects.index')->with(Helpers::getFlashSuccessMessage('Project created'), );
    }

    /**
     * Render the project creation screen for guests.
     */
    public function create()
    {
        return view('project.create');
    }

    /**
     * Create a project for guests.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'description' => [Project::$createRules['description']],
        ]);

        $project = Project::make([
            'slug' => Str::uuid(),
            'description' => $request->get('description'),
        ]);
        $teamMembers = TeamMember::find($request->get('team_member_ids'));

        Mail::to(config('signifly.marketing_team_email'))
            ->send(new NewProjectRequest($request->get('email'), $project, $teamMembers));

        if (! Mail::failures()) {
            return to_route('home')->with(Helpers::getFlashSuccessMessage('Your request has been sent to us. We will come back soon.'));
        } else {
            return to_route('home')->with(Helpers::getFlashErrorMessage('Something went wrong. Please try again.'));
        }
    }

    /**
     * Show the project.
     *
     * @param  Project  $project
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Project $project)
    {
        return view('project.show', [
            'project' => $project,
        ]);
    }

    /**
     * TODO : A FAIRE
     */
    public function edit($id)
    {
    }

    /**
     * TODO : A FAIRE
     */
    public function update(Request $request, $id)
    {
    }

    /**
     * TODO : A FAIRE
     */
    public function destroy($id)
    {
    }
}
