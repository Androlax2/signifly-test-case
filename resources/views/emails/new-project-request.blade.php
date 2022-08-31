{{ $project->description }}

@foreach ($teamMembers as $teamMember)
    {{ $teamMember->getFullName() }}
@endforeach
