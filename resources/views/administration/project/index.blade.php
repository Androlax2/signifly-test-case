@foreach ($projects as $project)
    {{ $project->description }}
    <a href="{{ route('administration.projects.edit', $project->id) }}" class="btn btn-primary">Edit</a>
    <a href="{{ route('administration.projects.delete', $project->id) }}" class="btn btn-danger">Delete</a>
@endforeach

@include('flash-message')
