@extends('layout')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Assets</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('assets.create') }}"> Create New Asset</a>
            </div>
        </div>
    </div>


    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif


    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Manufacturer</th>
            <th>Model</th>
            <th>Serial</th>
            <th>Vendor Name</th>
            <th>Location ID</th>
            <th width="280px">Action</th>
        </tr>
    @foreach ($assets as $asset)
    <tr>
        <td>{{ $asset->id}}</td>
        <td>{{ $asset->manufacturer}}</td>
        <td>{{ $asset->model}}</td>
        <td>{{ $asset->serial}}</td>
        <td>{{ $asset->vendor_name}}</td>
        <td>
            <a class="btn btn-info" href="{{ route('assets.show',$asset->id) }}">Show</a>
            <a class="btn btn-primary" href="{{ route('assets.edit',$asset->id) }}">Edit</a>
            {!! Form::open(['method' => 'DELETE','route' => ['assets.destroy', $asset->id],'style'=>'display:inline']) !!}
            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
            {!! Form::close() !!}
        </td>
    </tr>
    @endforeach
    </table>


@endsection
