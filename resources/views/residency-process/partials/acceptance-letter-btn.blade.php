<form action="{{ route('students.acceptanceLetter') }}" method="POST" target="_blank">
    @csrf
    <input type="hidden" name="user_id" value="{{ $student->user_id }}">
    <button class="btn btn-block btn-{{ $student->acceptanceLetter->btn_color }}">
        Carta de Aceptación
    </button>
</form>
