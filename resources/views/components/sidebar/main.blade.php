<style>
    /* Custom Styles */
    .curved-sidebar {
        background-color: var(--fg-palettes-color);
        color: var(--object-palettes-color);
        position: fixed;
        top: 0;
        left: 0;
        height: 100vh;
        width: 250px;
        z-index: 1030;
        /* border-radius: 0 50px 50px 0; */
        /* Curved right edges */
        box-shadow: 4px 0 6px rgba(0, 0, 0, 0.2);
        padding-top: 20px;
    }

    .curved-sidebar a {
        color: var(--object-palettes-color);
        font-weight: bold;
        display: block;
        padding: 10px 20px;
        text-decoration: none;
    }

    .curved-sidebar .brand {
        color: var(--object-palettes-color);
        font-weight: bold;
        display: block;
        padding: 5px 10px;
        text-decoration: none;
        text-align: center;
        font-size: 30px;
    }

    .curved-sidebar a:hover {
        color: #FFFF;
        background-color: var(--action-palettes-color);
        text-decoration: none;
    }

    .content {
        margin-left: 250px;
        padding: 50px 15px;
        background: #f8f9fa;
        min-height: 100vh;
    }
</style>


<nav class="col-md-3 col-lg-2 d-md-block sidebar curved-sidebar">
    <div class="position-sticky">

        <div class="text-white brand">Admin</div>
        <ul class="nav flex-column">
            @include('layouts.sidebar')
        </ul>
    </div>
</nav>
