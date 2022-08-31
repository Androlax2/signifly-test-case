@extends ('administration.app')

@section('content')
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <h1>Create a new project</h1>
        <form action="{{ route('administration.projects.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="slug" class="form-label">Slug *</label>
                <input type="text" name="slug" class="form-control" id="slug" value="{{ Str::uuid() }}">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description *</label>
                <textarea class="form-control" name="description" id="description" required></textarea>
            </div>
            <div class="mb-3">
                <label for="team" class="form-label">Who you want in your team ! *</label>
                <select name="team_member_ids[]" class="form-select" multiple required>
                    @foreach ($teamMembers as $teamMember)
                        <option value="{{ $teamMember->id }}">{{ $teamMember->getFullName() }}</option>
                    @endforeach
                </select>
                <div class="form-text">Use CTRL to select multiple person.</div>
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
@endsection
