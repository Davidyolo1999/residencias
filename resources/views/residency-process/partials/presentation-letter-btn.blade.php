<form action="{{ route('students.presentationLetter') }}" method="POST" target="_blank">
    @csrf
    <input type="hidden" name="user_id" value="{{ $student->user_id }}">
    <button class="btn btn-block btn-{{ $student->presentationLetter->btn_color }}">
        Carta de presentación
    </button>
</form>