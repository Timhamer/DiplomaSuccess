@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Nieuwe gebruiker aanmaken</h1>
        <form method="POST" action="{{route('createuser')}}">
            @csrf
            <div class="form-group">
                <label for="name">E-mail</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="email">Leerlingnummer</label>
                <input type="number" name="studentnumber" class="form-control" required>
            </div>
            <br>
            <div class="form-group">
                <label for="role">Selecteer rol</label>
                <div class="form-check">
                    <input type="radio" class="form-check-input" name="role" value="student" checked>
                    <label class="form-check-label">Student</label>
                </div>
                <div class="form-check">
                    <input type="radio" class="form-check-input" name="role" value="docent">
                    <label class="form-check-label">Docent</label>
                </div>
            </div>
            <br>
            <div class="form-group">
                <label for="email">Voornaam</label>
                <input type="text" name="firstname" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="email">Tussenvoegsel</label>
                <input type="text" name="middlename" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="email">Achternaam</label>
                <input type="text" name="lastname" class="form-control" required>
            </div>

            <br>

            <button type="submit" class="btn btn-primary">Aanmaken</button>
        </form>
    </div>
@endsection
