@extends('layouts.app')

@section('content')
@if(session('message'))
    <div class="alert alert-success">{{ session('message') }}</div>
@endif
<div class="container">
    <h3>Alret Information</h3><br/>
    <div class="row">
      <form action="{{ route('setAlert', ['city_id' => $city_id]) }}" method="post">
        @csrf
        <label>Event Type</label>
        <input type="text" name="event_type" placeholder="Event Type" class="form-control">
        <br/>
        <label>ThresHole</label>
        <input type="text" name="threshold" placeholder="Threshold" class="form-control">
        <br/>
        <button type="submit">Set Alert</button>
    </form>   
    </div>
   
</div>


@endsection