@if (Session::has('flash_notification'))
    @if (Session::get('flash_notification')['level'] == 'success')
        <flash-message
            time="5000"
            message="{{ Session::get('flash_notification')['message'] }}"
            progressbar="true"
        ></flash-message>
    @elseif (Session::get('flash_notification')['level'] == 'error')
        <flash-message
            type="ERROR"
            time="5000"
            message="{{ Session::get('flash_notification')['message'] }}"
            progressbar="true"
        ></flash-message>
    @endif
@endif
