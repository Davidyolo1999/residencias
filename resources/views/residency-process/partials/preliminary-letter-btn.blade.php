<form action="{{ route('students.preliminaryLetter') }}" method="POST" target="_blank">
    @csrf
    <input type="hidden" name="user_id" value="{{ $student->user_id }}">
    <button class="btn btn-block btn-{{ $student->preliminaryLetter->btn_color }}">
        Anteproyecto
    </button>
</form>