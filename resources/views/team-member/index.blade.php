@extends ('app')

@section('content')
    <div class="container">
        <h1>Our team</h1>
        <div class="cards-wrapper">
            @foreach ($teamMembers as $teamMember)
                @include ('includes/team-member-card', [
                    'team_member' => $teamMember
                ])
            @endforeach
        </div>
    </div>
@endsection

