<div class="card">
    <img src="{{ asset($teamMember->photo_path) }}" class="card-img-top" alt="{{ $teamMember->getFullName() }}">
    <div class="card-body">
        <h5 class="card-title">{{ $teamMember->getFullName() }}</h5>
        <a href="{{ $teamMember->getUrl() }}" class="btn btn-primary">Details about me</a>
        @if (isset($withButtons) && $withButtons)
            <a href="{{ route('administration.team-members.edit', $teamMember->id) }}" class="btn btn-primary btn-sm">Edit</a>
            <a href="{{ route('administration.team-members.delete', $teamMember->id) }}" class="btn btn-danger btn-sm">Delete</a>
        @endif
    </div>
</div>
