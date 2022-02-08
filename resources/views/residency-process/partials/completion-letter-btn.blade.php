<form action="{{ route('students.completionLetter') }}" method="POST" target="_blank">
    @csrf
    <input type="hidden" name="user_id" value="{{ $student->user_id }}">
    <button class="btn btn-block btn-{{ $student->completionLetter->btn_color }}">
        Carta de Término
    </button>
</form>