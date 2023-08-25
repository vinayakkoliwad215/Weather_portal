@extends('layouts.app')

@section('content')
@if(session('message'))
    <div class="alert alert-success">{{ session('message') }}</div>
@endif

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
        <h2>Add Cities</h2>
        <form action="{{ route('addCity') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="city">City Name:</label>
                <input type="text" class="form-control" id="city" name="city" required>
            </div>
            <button type="submit" class="btn btn-primary">Add City</button>
        </form>
</div>

<div class="container">
    <h2>My Cities</h2>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th bgcolor="yellow">City Name</th>
                <th bgcolor="yellow">State</th>
                <th bgcolor="yellow">Temperature (°C)</th>
                <th bgcolor="yellow">Humidity</th>
                <th bgcolor="yellow">Wind Speed</th>
                <th bgcolor="yellow">Action</th>

                
            </tr>
        </thead>
        <tbody>
            @foreach ($cities as $city)
                <tr>
                    <td>{{ $city->name }}</td>
                    <td>{{ $city->region }}</td>
                    <td>{{ $city->temperature }}</td>
                    <td>{{ $city->humidity }}</td>
                    <td>{{ $city->wind_kph }}</td>
                    <td><a class="btn btn-info btn-sm" href="{{ route('showAlertForm', ['city_id' => $city->id]) }}">Alert</a></td>

                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection