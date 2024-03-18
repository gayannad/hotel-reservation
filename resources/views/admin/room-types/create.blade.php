@extends('adminlte::page')

@section('title', 'Room Types')

@section('content')
    <div class="container">
        <x-adminlte-card title="Add New Room Type" theme="dark" class="mt-4">
            <div class="row form-group mb-3">
                <div class="col">
                    <a href="#" class="btn btn-warning float-right">View Room Types</a>
                </div>
            </div>
            @if(session('success'))
                <x-adminlte-alert class="small text-small" theme="success" title="{{session('success')}}" dismissable>
                </x-adminlte-alert>
            @endif
            <div class="row form-group">
                <div class="container px-5 my-5">
                    <form id="contactForm"
                          action="{{isset($roomType) ?route('admin.room-types.update',$roomType->id) : route('admin.room-types.store')}}"
                          method="post">
                        @if(isset($roomType))
                            @method('PUT')
                        @endif
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="name">Name</label>
                            <input class="form-control @error('name') is-invalid @enderror" id="name" type="text"
                                   name="name" value="{{isset($roomType)? $roomType->name :old('name')}}"/>
                            @error('name')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" type="text"
                                      style="height: 10rem;">{{isset($roomType) ? $roomType->description : old('description')}}</textarea>
                            @error('description')
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
