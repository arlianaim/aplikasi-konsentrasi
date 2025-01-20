<style>
    /* Custom Styles */
    .curved-nav {
        /* background: linear-gradient(135deg, #001F3F, #3A6D8C); */
        background-color: var(--fg-palettes-color);
        color: var(--object-palettes-color);
        position: sticky;
        top: 0;
        z-index: 1030;
        border-radius: 0 0 50px 50px;
        /* Curved bottom edges */
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
    }

    .curved-nav a {
        color: var(--object-palettes-color);
        font-weight: bold;
    }

    .curved-nav a:hover {
        color: #FFFF;
        text-decoration: none;
    }

    .curved-nav button {
        color: var(--object-palettes-color);
        font-weight: bold;
    }

    .curved-nav button:hover {
        color: #FFFF;
        text-decoration: none;
    }

    .content {
        padding: 50px 15px;
        background: #f8f9fa;
        min-height: 100vh;
    }
</style>

<nav class="navbar navbar-expand-lg curved-nav">
    <div class="container">
        <a class="navbar-brand" href="#">Admin</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                @include('layouts.nav')
            </ul>

        </div>
    </div>
</nav>

