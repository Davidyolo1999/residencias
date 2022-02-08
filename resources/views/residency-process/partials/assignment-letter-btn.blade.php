<form action="{{ route('students.assignmentLetter') }}" method="POST" target="_blank">
    @csrf
    <input type="hidden" name="user_id" value="{{ $student->user_id }}">
    <button class="btn btn-block btn-{{ $student->assignmentLetter->btn_color }}">
        Asignación de asesor interno
    </button>
</form>
