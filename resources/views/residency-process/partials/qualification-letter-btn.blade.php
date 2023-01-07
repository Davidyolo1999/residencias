<form action="{{ route('students.qualificationLetter') }}" method="POST" target="_blank">
    @csrf
    <input type="hidden" name="user_id" value="{{ $student->user_id }}">
    <button class="btn btn-block btn-{{ $student->qualificationLetter->qualification_text && $student->qualificationLetter->qualification < 70 ? 'danger' : $student->qualificationLetter->btn_color }}">
        Acta de Calificación
    </button>
</form>