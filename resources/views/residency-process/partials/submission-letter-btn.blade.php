<form action="{{ route('students.submissionLetter') }}" method="POST" target="_blank">
    @csrf
    <input type="hidden" name="user_id" value="{{ $student->user_id }}">
    <button class="btn btn-block btn-{{ $student->submissionLetter->btn_color }}">
        Carta de Entrega de Proyecto
    </button>
</form>