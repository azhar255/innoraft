@extends('layouts.app')

@section('content')
<div class="container">
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
    <table class="table table-striped">
        <thead>
          <tr>
            <td>S.No</td>
            <th>Company Name</th>
            <th>Email</th>
            <th>Website</th>
            <th>Logo</th>
            <th align="center" colspan="4" style="text-align:center">Action</th>
          </tr>
        </thead>
        <tbody>
            @php $i=0; @endphp 
            @foreach ($data as $company)
          <tr>
            <td>@php echo ++$i; @endphp</td>
            <td>{{$company->name}}</td>
            <td>{{$company->email}}</td>
            <td>{{$company->website}}</td>
            <td> <img width="50" src="<?php echo asset("storage/$company->logo")?>" /></td>
            <td></td>
            <td colspan="2"><span><a class="btn btn-primary" href="{{action('CompanyController@edit',$company->id)}}">Edit</a></span> </td>
            <td colspan="2">   
            <span><form action="{{ action('CompanyController@destroy',$company->id)}}" method="POST">
            @csrf
            <input type="hidden" name="_method" value="DELETE" />
            <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </span>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      <div class="pull-right" style="float: right;">
      {{ $data->links() }}
      </div>
</div>
@endsection
<script>
    document.onsubmit=function(){
        return confirm('Sure?');
    }
</script>

