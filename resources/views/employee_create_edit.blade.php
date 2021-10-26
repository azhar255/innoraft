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
        <form class="form-vertical" role="form" method="post" @if(Request::segment(3)=="edit")  action="{{ URL::to('employee',Request::segment(2))}}" @else action="{{ route('employee.store')}}" @endif enctype="multipart/form-data">
            @csrf
          <fieldset>
              @if(Request::segment(3)=="edit")
              {{ method_field('put') }}
              <legend>Update Employee</legend>
              @else
            <legend>Create Employee</legend>
            @endif
            <div class="form-group">
              <label for="input-text" class="control-label">First Name <span style="color:red">*</span></label>
              <input type="text" class="form-control" id="input-text" name="fname" @if(Request::segment(3)=="edit") value={{$company->fname}} @else value="{{ old('fname') }}" @endif placeholder="First Name">
              @if ($errors->has('fname'))
              <span class="text-danger">{{ $errors->first('fname') }}</span>
          @endif
            </div>
            <div class="form-group">
              <label for="input-date" class="control-label">Last Name</label>
              <input type="text" class="form-control mask-date" id="input-date" @if(Request::segment(3)=="edit") value={{$company->lname}} @else value="{{ old('lname') }}" @endif name="lname" placeholder="Last Name">
              @if ($errors->has('lname'))
              <span class="text-danger">{{ $errors->first('lname') }}</span>
          @endif
            </div>
            <div class="form-group">
              <label for="input-money" class="control-label">Company</label>
              {{-- <input type="text" class="form-control mask-money" id="input-money" @if(Request::segment(3)=="edit") value={{$company->website}} @else value="{{ old('website') }}" @endif name="website" placeholder="Company Website"> --}}
              <select name="company" class="form-control">
                  @foreach($companyList as $companies)
                  <option @if(Request::segment(3)=="edit") @if($company->company_id==$companies->id) {{"selected"}} @endif @endif value="{{$companies->id}}">{{$companies->name}}</option>
                  @endforeach
              </select>
              @if ($errors->has('company'))
              <span class="text-danger">{{ $errors->first('company') }}</span>
          @endif
            </div>
            <div class="form-group">
                <label for="input-date" class="control-label">Email</label>
                <input type="email" class="form-control mask-date" id="input-date" @if(Request::segment(3)=="edit") value={{$company->email}} @else value="{{ old('email') }}" @endif name="email" placeholder="Email">
                @if ($errors->has('email'))
                <span class="text-danger">{{ $errors->first('email') }}</span>
            @endif
            </div>
            <div class="form-group">
                <label for="input-date" class="control-label">Phone</label>
                <input type="text" class="form-control mask-date" id="input-date" @if(Request::segment(3)=="edit") value={{$company->phone}} @else value="{{ old('phone') }}" @endif name="phone" placeholder="Phone">
                @if ($errors->has('phone'))
                <span class="text-danger">{{ $errors->first('phone') }}</span>
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