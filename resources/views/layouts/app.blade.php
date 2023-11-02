<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.7.0/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
<script src="{{ asset('js/app.js') }}"></script>
<link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <title>DiplomaSucces</title>
    @stack('scripts')
</head>

<body>


    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary navy-blue">
            <div class="container">
                <a class="navbar-brand" href="home">DiplomaSucces



                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="Home">Home</a>
                        </li>

                            @if (session('user')->id == 2)
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="EditDocument">Wijzig documenten</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="AddAccount">Gebruiker toevoegen</a>
                                </li>
                            @endif
                    </ul>
                    <form action="{{ route('logout') }}" method="POST" class="d-flex" role="search">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit">Log uit</button>
                    </form>
                </div>
            </div>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <!-- Footer content goes here -->
    </footer>
</body>

</html>
