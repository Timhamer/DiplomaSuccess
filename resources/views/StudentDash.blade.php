@extends('layouts.app')

@section('content')
    <div class="container">
        @foreach ($groups as $group)
            <div class="group" style="background-color: #c7c7c7">
                <h3>{{ $group->name }}</h3>
                <button class="btn btn-primary">🎓</button>
            </div>
        @endforeach
    </div>
@endsection
