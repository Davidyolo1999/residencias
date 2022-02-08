<form action="{{ route('students.commitmentLetter') }}" method="POST" target="_blank">
    @csrf
    <input type="hidden" name="user_id" value="{{ $student->user_id }}">
    <button class="btn btn-block btn-{{ $student->commitmentLetter->btn_color }}">
        Carta de compromiso
    </button>
</form>