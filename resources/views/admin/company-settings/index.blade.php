@extends('adminlte::page')

@section('title','Company Settings')

@section('content_header')

<div class="d-flex justify-content-between align-items-center">

    <h1>Company Settings</h1>

    @if(!$company)

        <a href="{{ route('company-settings.create') }}"
           class="btn btn-primary">

            <i class="fas fa-plus"></i>

            Add Company

        </a>

    @endif

</div>

@stop

@section('content')

@if(session('success'))

<div class="alert alert-success">

    {{ session('success') }}
    

</div>

@endif

@if(session('error'))

<div class="alert alert-danger">

    {{ session('error') }}

</div>

@endif

<div class="card">

<div class="card-body">

@if($company)

<table class="table table-bordered">

<tr>
    <th width="220">Company Name</th>
    <td>{{ $company->company_name }}</td>
</tr>

<tr>
    <th>Email</th>
    <td>{{ $company->email }}</td>
</tr>

<tr>
    <th>Phone</th>
    <td>{{ $company->phone }}</td>
</tr>

<tr>
    <th>Website</th>
    <td>{{ $company->website }}</td>
</tr>

<tr>
    <th>Address</th>
    <td>{{ $company->address }}</td>
</tr>

<tr>
    <th>Footer Text</th>
    <td>{{ $company->footer_text }}</td>
</tr>

<tr>

<th>Logo</th>

<td>

@if($company->logo)

<img src="{{ asset('uploads/company/'.$company->logo) }}"
     width="120"
     class="img-thumbnail">

@else

No Logo

@endif

</td>

</tr>

</table>

<a href="{{ route('company-settings.edit',$company->id) }}"
   class="btn btn-warning">

<i class="fas fa-edit"></i>

Edit Settings

</a>

@else

<div class="alert alert-info">

No Company Settings Found.

</div>

@endif

</div>

</div>

@stop