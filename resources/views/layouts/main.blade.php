<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Bootstrap Icons -->
    <link href="{{ asset('vendor/bootstrap-icons/font/bootstrap-icons.css') }}" rel="stylesheet">

    <!-- Select 2 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />


    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>

    <style>
        :root {

            --bg-palettes-color: #1A1A2E;
            --fg-palettes-color: #1A1A2F;
            --fg2-palettes-color: #15152A;
            --action-palettes-color: #FFA700;
            --object-palettes-color: #FFA500;
        }

        .bg_palettes {
            background-color: var(--bg-palettes-color);
        }

        .fg_palettes {
            background-color: var(--fg-palettes-color);
        }

        .fg2_palettes {
            background-color: var(--fg2-palettes-color);
        }

        .action_palettes {
            background-color: var(--action-palettes-color);
        }

        .h_palettes {
            color: var(--object-palettes-color);
        }

        .bgs_palettes {
            background-color: var(--fg-palettes-color);
            color: var(--bg-palettes-color);
        }

        .bgs_palettes:hover {
            background-color: var(--action-palettes-color);
            color: #FFFF;
        }

        .object_palettes {
            background-color: var(--object-palettes-color);
        }

        .hr_style {
            background-color: var(--object-palettes-color);
            height: 5px;
        }

        .headTable_style {
            background-color: rgba(0, 0, 0, 0.2);
            color: var(--object-palettes-color);
            text-align: center;
        }
        .action_button{
            color: var(--action-palettes-color);
        }

        .active_button {
            color: var(--object-palettes-color);
        }

        .table_border {
            border: 1px solid var(--object-palettes-color);
        }
        .nav_custom{
            color: var(--object-palettes-color);
            font-weight: bold;
            height: 70px;
        }
    </style>
    <title>Admin Kos Kosan Tamalanrea</title>
</head>

<body class="bg_palettes">

    <div class="container-fluid">
        <div class="row">
            <x-sidebar.main />
            <main class="col-md-9 ms-md-auto col-lg-10 ">
                @isset($header)
                    <nav class="nav_custom shadow">
                        <div class="container-xxl">
                            <span class="mb-0 h1">{{ $header }}</span>
                        </div>
                    </nav>
                @endisset
                <div class="px-5 py-1">
                    {{ $slot }}
                </div>
            </main>

        </div>
    </div>


    {{-- <x-alert /> --}}

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    -->



    <!-- Select 2 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>


    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
        })()


        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>
</body>

</html>
