<form action="{{ route('students.residencyRequest') }}" method="POST" target="_blank">
    @csrf
    <input type="hidden" name="user_id" value="{{ $student->user_id }}">
    <button class="btn btn-block btn-{{ $student->residencyRequest->btn_color }}">
        Solicitud de residencias
    </button>
</form>