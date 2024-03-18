@extends('layouts.app')

@section('title', 'Room Booking')

@section('content')
    <div class="container">
        <h1>Available Rooms</h1>
        <div class="row">
            @if(isset($rooms))
                @foreach($rooms as $room)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img src="{{!empty($room->image) ? $room->image : 'https://via.placeholder.com/300'}}"
                                 class="card-img-top" alt="Room Image">
                            <div class="card-body">
                                <h5 class="card-title">{{$room->name}}</h5>
                                <h5 class="card-title">{{"LKR.". number_format($room->price,2)}}</h5>
                                <p class="card-text">{{$room->description}}</p>
                                <a href="#" class="btn btn-primary">Book Now</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')

@stop
