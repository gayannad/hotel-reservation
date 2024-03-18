@extends('adminlte::page')

@section('title', 'Rooms')

@section('content')
    <div class="container">
        <x-adminlte-card title="{{isset($room) ? 'Edit Room' : 'Add New Room'}}" theme="dark" class="mt-4">
            <div class="row form-group mb-3">
                <div class="col">
                    <a href="{{route('admin.rooms.index')}}" class="btn btn-warning float-right">View Rooms</a>
                </div>
            </div>
            @if(session('success'))
                <x-adminlte-alert class="small text-small" theme="success" title="{{session('success')}}" dismissable>
                </x-adminlte-alert>
            @endif
            <div class="row form-group">
                <div class="container px-5 my-5">
                    <form id="contactForm" enctype="multipart/form-data"
                          action="{{isset($room) ?route('admin.rooms.update',$room->id) : route('admin.rooms.store')}}"
                          method="post">
                        @if(isset($room))
                            @method('PUT')
                        @endif
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="name">Name</label>
                            <input class="form-control @error('name') is-invalid @enderror" id="name" type="text"
                                   name="name" value="{{isset($room)? $room->name :old('name')}}"/>
                            @error('name')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" type="text"
                                      style="height: 10rem;">{{isset($room) ? $room->description : old('description')}}</textarea>
                            @error('description')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="name">Capacity</label>
                            <input class="form-control @error('capacity') is-invalid @enderror" id="capacity"
                                   type="number"
                                   name="capacity" value="{{isset($room)? $room->capacity :old('capacity')}}"/>
                            @error('capacity')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="name">Price</label>
                            <input class="form-control @error('price') is-invalid @enderror" id="price" type="number"
                                   name="price" value="{{isset($room)? $room->price :old('price')}}"/>
                            @error('price')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="name">Room Type</label>
                            <select name="type" id="type" class="form-control">
                                @foreach($types as $type)
                                    <option value="{{$type->id}}">{{$type->name}}</option>
                                @endforeach
                            </select>
                            @error('type')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="name">Image</label>
                            <input class="form-control @error('image') is-invalid @enderror" id="image" type="file"
                                   name="image" value="{{isset($room)? $room->image :old('image')}}"/>

                            @if(isset($room) && $room->image !== null)
                                <img src="{{$room->image}}" alt="Room Image" class="mt-2 img-thumbnail col-2">
                            @endisset

                            @error('name')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-grid">
                            <button class="btn btn-primary btn-lg  float-right" id="submitButton" type="submit">Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </x-adminlte-card>
    </div>
@stop

@section('css')

@stop

@section('js')

@stop
