<img
    src="{{ filter_var($teamMember->photo_path, FILTER_VALIDATE_URL) ? $teamMember->photo_path : asset("storage/{$teamMember->photo_path}") }}"
    @if (isset($class))
    class="{{ $class }}"
    @endif
    alt="{{ $teamMember->getFullName() }}"
    @if (isset($style))
    style="{{ $style }}"
    @endif
>
