<div class="card">
    <div class="card-body">
        <p class="card-text">{{ $project->description }}</p>
        <a href="{{ $project->getUrl() }}" class="btn btn-primary">See the project</a>
        @if (isset($withButtons) && $withButtons)
            <a href="{{ route('administration.projects.edit', $project->id) }}" class="btn btn-primary">Edit</a>
            <a href="{{ route('administration.projects.delete', $project->id) }}" class="btn btn-danger">Delete</a>
        @endif
    </div>
</div>
