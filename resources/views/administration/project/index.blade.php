@extends ('administration.app')

@section('content')
    <div class="container">
        <h1>All our projects</h1>
        <div class="cards-wrapper">
            @foreach ($projects as $project)
                @include ('includes/project-card', [
                    'project' => $project,
                    'withButtons' => true
                ])
            @endforeach
        </div>
    </div>
@endsection
