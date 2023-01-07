<form action="{{ route('students.externalQualificationLetter') }}" method="POST" target="_blank">
    @csrf
    <input type="hidden" name="user_id" value="{{ $student->user_id }}">
    <button class="btn btn-block btn-{{ $student->externalQualificationLetter->btn_color }}">
        Formato Evaluación Externo
    </button>
</form>