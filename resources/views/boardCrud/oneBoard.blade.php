@if (Auth::user()->user_role == 'teacher' || Auth::user()->user_role == 'admin' )
<a class="Add-students-button" href="{{ route('addStudentsToBoard', $board_id) }}">
    {{ __('Add students') }}
</a>
@endif

