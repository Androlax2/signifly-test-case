@extends ('app')

@section('content')
    <div class="container">
        <h1 class="mt-2">{{ $teamMember->getFullName() }}</h1>
        @if ($teamMember->photo_path)
            @include ('includes/team-member/photo', [
                'teamMember' => $teamMember,
            ])
        @endif
        <p class="mt-3">Job : {{ $teamMember->job_title }}</p>
        <p>Location : {{ $teamMember->location }}</p>
        <p>Phone :
            <a href="tel:{{ $teamMember->phone }}">{{ $teamMember->phone }}</a>
        </p>
        <p>Email :
            <a href="mailto:{{ $teamMember->email }}">{{ $teamMember->email }}</a>
        </p>
        @if (isset($teamMember->description))
            <p>Description : {{ $teamMember->description }}</p>
        @endif
    </div>
@endsection
