@foreach ($teamMembers as $teamMember)
    {{ $teamMember->getFullName() }}
    {{ $teamMember->job_title }}
    {{ $teamMember->photo_path }}
@endforeach