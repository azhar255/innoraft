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
            <th>S.No</th>
            <th>Employee Name</th>
            <th>Company Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th align="center" colspan="4" style="text-align:center">Action</th>
          </tr>
        </thead>
        
        <tbody>
            @php $i=0; @endphp 
            @foreach ($data as $employee)
          <tr>
            <td>@php echo ++$i; @endphp</td>
            <td>{{$employee->fname}} {{$employee->lname}}</td>
            <td>{{$employee->company_name}}</td>
            <td>{{$employee->phone}}</td>
            <td>{{$employee->email}}</td>
            <td></td>
            <td colspan="2"><span><a class="btn btn-primary" href="{{action('EmployeeController@edit',$employee->id)}}">Edit</a></span> </td>
            <td colspan="2">   
            <span><form action="{{ action('EmployeeController@destroy',$employee->id)}}" method="POST">
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

