<form action="{{ route('students.authorizationLetter') }}" method="POST" target="_blank">
    @csrf
    <input type="hidden" name="user_id" value="{{ $student->user_id }}">
    <button class="btn btn-block btn-{{ $student->authorizationLetter->btn_color }}">
        Autorizacion de Uso de Información
    </button>
</form>