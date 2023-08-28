@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h4>Edit Company</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('companies.update',$company->id) }}" method="post" enctype="multipart/form-data" autocomplete="off">
                        @csrf
                        <input type="hidden" value="{{ $company->id }}">
                        <div class="mb-3">
                            <label class="form-label">{{ __('Name') }}<span>*</span></label>
                            <input id="name" type="text" placeholder="Enter Name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $company->name }}" autofocus>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">{{ __('Email') }}</label>
                            <input id="email" type="email" placeholder="Enter Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $company->email }}">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">{{ __('Logo') }}
                                <a href="{{ asset('storage/'.$company->logo)}}">View</a>
                            </label>
                            <input id="logo" type="file" class="form-control @error('logo') is-invalid @enderror" name="logo" accept="image/*">
                            @error('logo')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">{{ __('Website') }}</label>
                            <input id="website" type="url" placeholder="Enter Website" class="form-control @error('website') is-invalid @enderror" name="website" value="{{ $company->website }}">
                            @error('website')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{ route('companies') }}" class="btn btn-primary">Back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection