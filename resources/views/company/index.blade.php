@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h4>Company
                        <a class="btn btn-primary float-end" href="{{ route('companies.create') }}"> Add Company</a>
                    </h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="companyTable" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Logo</th>
                                    <th>Website</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($company as $cmp)
                                <tr>
                                    <td>{{ $cmp->id }}</td>
                                    <td>{{ $cmp->name }}</td>
                                    <td>{{ $cmp->email }}</td>
                                    <td>
                                        @if ($cmp->logo)
                                        <img src="{{ asset('storage/'.$cmp->logo) }}" alt="{{ $cmp->name }} Logo" width="100" height="100">
                                        @endif
                                    </td>
                                    <td>{{ $cmp->website }}</td>
                                    <td>
                                        <a href="{{ route('companies.edit', $cmp->id) }}" value="{{ $cmp->id }}" class="edit_btn btn-success btn-sm">Edit</a>
                                    </td>
                                    <td>
                                        <form action="{{ route('companies.destroy', $cmp->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" value="{{ $cmp->id }}" class="delete_btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<script>
    $(document).ready(function() {
        let table = new DataTable('#companyTable', {
            responsive: true,
            order: [
                [0, 'desc']
            ]
        });
    });
</script>
@endpush