@extends ('administration.app')

@section('content')
    <div class="container">
        <h1>Add a new team member</h1>
        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form
            action="{{ route('administration.team-members.store') }}"
            method="POST"
            enctype="multipart/form-data"
        >
            @csrf
            <div class="mb-3">
                <label for="first_name" class="form-label">First name *</label>
                <input type="text" id="first_name" name="first_name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="last_name" class="form-label">Last name *</label>
                <input type="text" id="last_name" name="last_name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email *</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="job_title" class="form-label">Job title *</label>
                <input type="text" id="job_title" name="job_title" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="location" class="form-label">Location *</label>
                <input type="text" id="location" name="location" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone *</label>
                <input type="tel" id="phone" name="phone" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea id="description" name="description" class="form-control"></textarea>
            </div>
            <div class="mb-3">
                <label for="photo" class="form-label">Photo</label>
                <input class="form-control" type="file" id="photo" name="photo">
            </div>
            <button type="submit" class="btn btn-primary">Add</button>
        </form>
    </div>
@endsection
