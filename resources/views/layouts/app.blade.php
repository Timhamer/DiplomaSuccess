<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                @if (session('user')->id == 1)
                <a class="navbar-brand" href="{{ route('Home') }}">DiplomaSucces</a>
                @endif

                @if (session('user')->id == 2)
                <a class="navbar-brand" href="{{ route('studentDashboard') }}">DiplomaSucces</a>
                @endif
                <button class="navbar-toggler" type="button" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse custom-navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <!-- Other navigation links go here -->
                        @if (session('user')->id == 1)
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ route('Home') }}">Home</a>
                        </li>
                        @endif
                        @if (session('user')->id == 2)
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ route('studentDashboard') }}">Home</a>
                        </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="{{ route('editExam') }}">Wijzig documenten</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="{{ route('adduser') }}">Gebruiker toevoegen</a>
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

<script>
// jQuery code to handle the menu button click
$(document).ready(function () {
    $(".navbar-toggler").click(function () {
        $(".custom-navbar-collapse").toggleClass("show");
    });
});
</script>
