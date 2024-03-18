@extends('adminlte::page')

@section('title', 'Customers')

@section('content')
    <div class="container">
        <x-adminlte-card title="{{isset($customer) ? 'Edit Customer' : 'Add New Customer'}}" theme="dark" class="mt-4">
            <div class="row form-group mb-3">
                <div class="col">
                    <a href="{{route('admin.customers.index')}}" class="btn btn-warning float-right">View Customers</a>
                </div>
            </div>
            @if(session('success'))
                <x-adminlte-alert class="small text-small" theme="success" title="{{session('success')}}" dismissable>
                </x-adminlte-alert>
            @endif
            <div class="row form-group">
                <div class="container px-5 my-5">
                    <form id="contactForm" enctype="multipart/form-data"
                          action="{{isset($customer) ?route('admin.customers.update',$customer->id) : route('admin.customers.store')}}"
                          method="post">
                        @if(isset($customer))
                            @method('PUT')
                        @endif
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="name">Name</label>
                            <input class="form-control @error('name') is-invalid @enderror" id="name" type="text"
                                   name="name" value="{{isset($customer)? $customer->name :old('name')}}"/>
                            @error('name')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="email">Email</label>
                            <input class="form-control @error('email') is-invalid @enderror" id="email" type="email"
                                   name="email" value="{{isset($customer)? $customer->email :old('email')}}"/>
                            @error('email')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="phone">Phone</label>
                            <input class="form-control @error('phone') is-invalid @enderror" id="phone" type="text"
                                   name="phone" value="{{isset($customer)? $customer->phone :old('phone')}}"/>
                            @error('phone')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-grid">
                            <button class="btn btn-primary btn-sm  float-right" id="submitButton" type="submit">Save
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
