@extends('layouts.app')

@section('content')
@if(Session::has('success'))
<div class="container">
<div class="alert alert-success">
    {{ Session::get('success') }}
    @php
        Session::forget('success');
    @endphp
</div>
</div>
@endif

<div class="container">
    <div class="row">
      <div class="col-xs-12 col-sm-10 col-md-7 col-lg-6">
        <form class="form-vertical" role="form" method="post" @if(Request::segment(3)=="edit")  action="{{ URL::to('company',Request::segment(2))}}" @else action="{{ route('company.store')}}" @endif enctype="multipart/form-data">
            @csrf
          <fieldset>
              @if(Request::segment(3)=="edit")
              {{ method_field('put') }}
              <legend>Update Company</legend>
              @else
            <legend>Create Company</legend>
            @endif
            <div class="form-group">
              <label for="input-text" class="control-label">Company Name</label>
              <input type="text" class="form-control" id="input-text" name="name" @if(Request::segment(3)=="edit") value={{$company->name}} @else value="{{ old('name') }}" @endif placeholder="Company Name">
              @if ($errors->has('name'))
              <span class="text-danger">{{ $errors->first('name') }}</span>
          @endif
            </div>
            <div class="form-group">
              <label for="input-date" class="control-label">Company Email</label>
              <input type="email" class="form-control mask-date" id="input-date" @if(Request::segment(3)=="edit") value={{$company->email}} @else value="{{ old('email') }}" @endif name="email" placeholder="Company Email">
              @if ($errors->has('email'))
              <span class="text-danger">{{ $errors->first('email') }}</span>
          @endif
            </div>
            <div class="form-group">
              <label for="input-money" class="control-label">Company Website</label>
              <input type="text" class="form-control mask-money" id="input-money" @if(Request::segment(3)=="edit") value={{$company->website}} @else value="{{ old('website') }}" @endif name="website" placeholder="Company Website">
              @if ($errors->has('website'))
              <span class="text-danger">{{ $errors->first('website') }}</span>
          @endif
            </div>
            <div class="form-group">
              <label for="address" class="control-label">Company Logo</label>
              <input type="file" class="form-control" id="address" name="logo">
              @if ($errors->has('logo'))
              <span class="text-danger">{{ $errors->first('logo') }}</span>
          @endif
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary">Save Data</button>
            </div>
          </fieldset>
        </form>
      </div>
    </div>
  </div>
  @endsection