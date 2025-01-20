<div class="form-group col-{{ $cols }} mb-3" style="color: var(--object-palettes-color);">
    <label for="{{ $name }}">{{ $label }}</label>
    @foreach ($options as $value => $text)
        <div class="form-check">
            @php
                $isChecked = false;
            @endphp
            @foreach ($checked as $c)
                @if ($c->facility->id == $value)
                    <input class="form-check-input" type="checkbox" value="{{ $value }}" id="{{ $text }}"
                        name="{{ $name }}[]" checked>
                    @php
                        $isChecked = true;
                    @endphp
                @endif
            @endforeach
            @if (!$isChecked)
                <input class="form-check-input" type="checkbox" value="{{ $value }}" id="{{ $text }}"
                    name="{{ $name }}[]">
            @endif
            <label class="form-check-label" for="{{ $text }}">
                {{ $text }}
            </label>
        </div>
    @endforeach
</div>
