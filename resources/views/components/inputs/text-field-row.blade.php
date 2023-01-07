<div class="row mb-3">
    <div class="col-md-3">
        <label for="{{ $name }}" class="d-block letter text-dark">{{ $label }}</label>
    </div>
    <div class="col-md-9">
        <div class="input-group input-group-dynamic label-floating has-warning">
            <input
                type="{{ $type }}"
                class="form-control"
                name="{{ $name }}"
                id="{{ $name }}"
                value="{{ old($name, $defaultValue) }}"
                {{ $attributes }}
            >
        </div>
        @error($name)
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
</div>
