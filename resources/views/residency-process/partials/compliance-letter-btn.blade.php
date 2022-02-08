<form action="{{ route('students.complianceLetter') }}" method="POST" target="_blank">
    @csrf
    <input type="hidden" name="user_id" value="{{ $student->user_id }}">
    <button class="btn btn-block btn-{{ $student->complianceLetter->btn_color }}">
        Cédula de cumplimiento RP
    </button>
</form>