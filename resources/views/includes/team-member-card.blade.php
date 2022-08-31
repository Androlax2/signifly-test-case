<div class="card">
    @if ($teamMember->photo_path)
        <img
            src="{{ filter_var($teamMember->photo_path, FILTER_VALIDATE_URL) ? $teamMember->photo_path : asset("storage/{$teamMember->photo_path}") }}"
            class="card-img-top"
            alt="{{ $teamMember->getFullName() }}"
        >
    @endif
    <div class="card-body">
        <h5 class="card-title">{{ $teamMember->getFullName() }}</h5>
        <a href="{{ $teamMember->getUrl() }}" class="btn btn-primary">Details about me</a>
        @if (isset($withButtons) && $withButtons)
            <a href="{{ route('administration.team-members.edit', $teamMember->id) }}" class="btn btn-primary btn-sm">Edit</a>
            <a href="{{ route('administration.team-members.delete', $teamMember->id) }}" class="btn btn-danger btn-sm">Delete</a>
        @endif
    </div>
</div>
