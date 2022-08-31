@extends ('app')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container">
        <h1>Work with us !</h1>
        <p>Explain us your project :</p>
        <form action="{{ route('projects.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Your email *</label>
                <input type="email" id="email" name="email" class="form-control" required>
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
            <button type="submit" class="btn btn-primary">Let's go</button>
        </form>
    </div>
@endsection
