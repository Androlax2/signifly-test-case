@extends ('administration.app')

@section('content')
    <div class="container">
        <div class="alert alert-info">
            The buttons
            <strong>EDIT</strong>
            and
            <strong>DELETE</strong>
            are not working for now.
        </div>
        <h1>The team</h1>
        <div class="cards-wrapper">
            @foreach ($teamMembers as $teamMember)
                @include ('includes/team-member-card', [
                    'teamMember' => $teamMember,
                    'withButtons' => true
                ])
            @endforeach
        </div>
    </div>
@endsection
