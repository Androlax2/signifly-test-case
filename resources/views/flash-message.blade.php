@if (Session::has('flash_notification'))
    @if (Session::get('flash_notification')['level'] == 'success')
        <div class="alert alert-success">
            {{ Session::get('flash_notification')['message'] }}
        </div>
    @elseif (Session::get('flash_notification')['level'] == 'error')
        <div class="alert alert-danger">
            {{ Session::get('flash_notification')['message'] }}
        </div>
    @endif
@endif
