@component('mail::message')
    Client Email : [{{ $email }}]({{ $email }})
    <br />
    <br />
    Project Description : {{ $project->description }}
    <br />
    <br />
    Team members :

    @foreach ($teamMembers as $teamMember)
        - {{ $teamMember->getFullName() }}
    @endforeach
@endcomponent
