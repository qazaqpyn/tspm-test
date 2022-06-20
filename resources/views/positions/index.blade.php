@extends('users.layout')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="float-left">
                <h2>Positions</h2>
            </div>
            <div class="float-right">
                <a class="btn btn-success" href="{{ route('positions.create') }}"> Create New Position</a>
                <a class="btn btn-secondary" href="/"> Back</a>
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
            <th>Name</th>
            <th>Salary</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($positions as $position)
        <tr>
            <td>{{ $position->id }}</td>
            <td>{{ $position->name }}</td>
            <td>{{ $position->salary }}</td>
            <td>
                <form action="{{ route('positions.destroy',$position->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('positions.show',$position->id) }}">Show</a>
                    <a class="btn btn-primary" href="{{ route('positions.edit',$position->id) }}">Edit</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach

    </table>


@endsection