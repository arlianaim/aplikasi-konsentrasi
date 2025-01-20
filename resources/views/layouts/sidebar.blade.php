@php
    $rute = request()->route()->uri();
    $rute = explode('/', $rute);
@endphp

<style>
    .nav-link {
        display: block;
        padding: 5px 10px;
        color: var(--object-palettes-color);
        text-decoration: none;
        font-weight: bold;
    }

    .nav-link:hover {
        background-color: var(--action-palettes-color);
        color: #fff;
    }

    button.nav-link {
        text-align: left;
        /* Agar teks "Logout" sejajar dengan link lainnya */
    }
</style>

{{-- <div class="flex flex-col gap-2"> --}}
<x-sidebar.link active="{{ request()->routeIs('home*') }}" label="Home" href="{{ route('home') }}" />
<x-sidebar.link active="{{ request()->routeIs('house*') || in_array('house', $rute) }}" label="Kos Kosan"
    href="{{ route('house') }}" />
<x-sidebar.link active="{{ request()->routeIs('facility*') || in_array('facility', $rute) }}" label="Fasilitas"
    href="{{ route('facility') }}" />
<form action="{{ route('logout') }}" method="POST" class="nav-link">
    @csrf
    <button type="submit" class="nav-link" style="background: none; border: none; width: 100%;">Logout</button>
</form>
{{-- </div> --}}
