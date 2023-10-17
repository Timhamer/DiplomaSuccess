<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.7.0/dist/js/bootstrap.bundle.min.js"></script>
    <title>DiplomaSucces</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container">
                <a class="navbar-brand" href="home">DiplomaSucces
                    @auth

                        @if (auth()->user()->hasRole('admin'))
                        docentendashboard
                        @elseif (auth()->user()->hasRole('student'))
                        studentendashboard
                        @endif
                    @endauth
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="addGroup">Home</a>
                        </li>
                        @auth
                            @if (auth()->user()->hasRole('admin'))
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="addLes">Wijzig documenten</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="register">Gebruiker toevoegen</a>
                                </li>
                            @endif
                        @endauth
                    </ul>
                    {{-- <form action="{{ route('logout') }}" method="POST" class="d-flex" role="search">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit">Log uit</button>
                    </form> --}}
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
