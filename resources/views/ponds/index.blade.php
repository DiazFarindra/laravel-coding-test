@extends('layouts.matrix.app', ['bc' => 'ponds'])

@push('css')
    <link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="card">
    <div class="card-body">
        <a href="{{ route('ponds.create') }}" class="mb-3 btn btn-primary">Create</a>

        <h5 class="card-title">Ponds</h5>

        <div class="table-responsive">
            <table id="zero_config" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Pond Code</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($ponds as $pond)
                        <tr>
                            <td>{{ $pond->pond_code }}</td>
                            <td>{{ $pond->createdAt() }}</td>
                            <td>{{ $pond->updatedAt() }}</td>
                            <td>
                                <a href="{{ route('ponds.edit', $pond->id) }}" class="btn btn-sm btn-warning">edit</a> |
                                <form class="d-inline" action="{{ route('ponds.destroy', $pond->id) }}" method="post">
                                    @csrf
                                    @method('delete')

                                    <button class="btn btn-sm btn-danger" type="submit">delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-center" colspan="3">No data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection

@push('js')
    <!-- this page js -->
    <script src="{{ asset('assets/extra-libs/multicheck/datatable-checkbox-init.js') }}"></script>
    <script src="{{ asset('assets/extra-libs/multicheck/jquery.multicheck.js') }}"></script>
    <script src="{{ asset('assets/extra-libs/DataTables/datatables.min.js') }}"></script>
    <script>
        $('#zero_config').DataTable();
    </script>
@endpush
