<div class="card">
    <img src="{{ asset($teamMember->photo_path) }}" class="card-img-top" alt="{{ $teamMember->getFullName() }}">
    <div class="card-body">
        <h5 class="card-title">{{ $teamMember->getFullName() }}</h5>
        <a href="{{ $teamMember->getUrl() }}" class="btn btn-primary">Details about me</a>
    </div>
</div>
