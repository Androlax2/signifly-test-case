@extends ('app')

@section('content')
    <div class="container">
        <h3>Project Description :</h3>
        <p>{{ $project->description }}</p>
        <h1>Working on this project :</h1>
        <div class="cards-wrapper">
            @foreach ($project->teamMembers as $teamMember)
                @include ('includes/team-member-card', [
                    'team_member' => $teamMember
                ])
            @endforeach
        </div>
    </div>
@endsection
