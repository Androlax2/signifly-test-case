<?php

namespace App\Mail;

use App\Models\Project;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Collection;

class NewProjectRequest extends Mailable
{
    public function __construct(
        protected string $email,
        protected Project $project,
        protected Collection|array $teamMembers
    )
    {
    }

    public function build()
    {
        return $this
            ->subject('New project request')
            ->replyTo($this->email)
            ->markdown('emails.new-project-request', [
                'email'       => $this->email,
                'project'     => $this->project,
                'teamMembers' => $this->teamMembers,
            ]);
    }
}
