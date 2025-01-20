<li class="nav-item">
    <a class="nav-link {{ $active }}" {{ $active != '' ? "aria-current='page'" : '' }} href="{{ $href }}"
        {{ $dis ? 'disabled' : '' }}>
        {{ $label }}
    </a>
</li>
