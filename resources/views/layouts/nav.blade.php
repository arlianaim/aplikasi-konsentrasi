@php
    $rute = request()->route()->uri();
    $rute = explode('/', $rute);
@endphp
<x-nav.link active="{{ request()->routeIs('home') }}" label="Home" href="{{ route('home') }}" />
<x-nav.link active="{{ request()->routeIs('house') || in_array('house', $rute) }}" label="Kos Kosan"
    href="{{ route('house') }}" />
<x-nav.link active="{{ request()->routeIs('facility') || in_array('facility', $rute) }}" label="Fasilitas"
    href="{{ route('facility') }}" />
{{-- <x-nav.link label="|" href="#" dis="1"/> --}}

<li class="nav-item">
    <form action="{{ route('logout') }}" method="POST" class="nav-link">
        @csrf
        <button type="submit" style="background: none; border: none;">Logout</button>
    </form>
</li>
