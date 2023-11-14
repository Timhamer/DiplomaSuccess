{{-- @extends('layouts.app') --}}

    <div class="container">
        <h1>Account afmaken</h1>
        <form method="POST" action="{{ route('finishuser') }}">
            @csrf
            <input type="hidden" name="user_id" value="{{ $user->id }}">
            <p>Account email: {{ $user->email }}</p>
            <br>
            <div class="form-group">
                <label for="password">Wachtwoord</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password_confirmation">Herhaal wachtwoord</label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>

            <br>

            <button type="submit" class="btn btn-primary">Maak account af</button>
        </form>
    </div>