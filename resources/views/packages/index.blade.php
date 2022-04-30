@extends('layouts.matrix.app', ['bc' => 'packages'])

@push('css')
    <link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="card">
    <div class="card-body">
        <a href="{{ route('packages.create') }}" class="mb-3 btn btn-primary">Create</a>

        <h5 class="card-title">Packages</h5>

        <div class="table-responsive">
            <table id="zero_config" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Pond Code</th>
                        <th>Package Code</th>
                        <th>Total Unit</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($packages as $package)
                        <tr>
                            <td>{{ $package->pond->pond_code }}</td>
                            <td>{{ $package->package_code }}</td>
                            <td>{{ $package->total_unit }}</td>
                            <td>
                                <a href="{{ route('logs.create', $package->id) }}" class="btn btn-sm btn-secondary">Harvest</a> |
                                <a href="{{ route('packages.edit', $package->id) }}" class="btn btn-sm btn-warning">edit</a> |
                                <form class="d-inline" action="{{ route('packages.destroy', $package->id) }}" method="post">
                                    @csrf
                                    @method('delete')

                                    <button class="btn btn-sm btn-danger" type="submit">delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-center" colspan="4">No data</td>
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
