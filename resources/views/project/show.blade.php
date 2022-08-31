@extends ('app')

@section('content')
    <div class="container">
        <h3>Project Description :</h3>
        <p>{{ $project->description }}</p>
        <h1>Working on this project :</h1>
        <div class="cards-wrapper">
            @foreach ($project->teamMembers as $teamMember)
                @include ('includes/team-member-card', [
                    'teamMember' => $teamMember
                ])
            @endforeach
        </div>
    </div>
@endsection
