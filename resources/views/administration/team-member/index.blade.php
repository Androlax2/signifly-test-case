@foreach ($teamMembers as $teamMember)
    {{ $teamMember->getFullName() }}
    {{ $teamMember->job_title }}
    {{ $teamMember->photo_path }}
    <a href="{{ route('administration.team-members.edit', $teamMember->id) }}" class="btn btn-primary btn-sm">Edit</a>
    <a href="{{ route('administration.team-members.delete', $teamMember->id) }}" class="btn btn-danger btn-sm">Delete</a>
@endforeach
