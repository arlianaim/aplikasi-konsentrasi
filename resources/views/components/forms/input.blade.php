<div class="mb-3 h_palettes col-{{ $cols }} {{ $hidden ? 'visually-hidden' : '' }}">
    @if ($label)
        <label for="{{ $name }}">{{ $label }}</label>
    @endif

    <input
        type="{{ $type }}"
        name="{{ $name }}"
        value="{{ old($name, $value) }}"
        id="{{ $name }}"
        class="form-control @error($name) is-invalid @enderror"
        {{ $type == 'number' && $min ? 'min='.$min : '' }}
        {{ $disabled ? 'disabled' : '' }}
        {{ $readonly ? 'readonly' : '' }}
        aria-describedby="{{ $help ? $name . '-help' : '' }}"
    >

    @if ($help && $disabled)
        <div id="{{ $name }}-help" class="form-text">{{ $help }}</div>
    @endif

    @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

