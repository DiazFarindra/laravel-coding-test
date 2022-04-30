@extends('layouts.matrix.app', ['bc' => 'logs'])

@push('css')
    <link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="card">
    <div class="card-body">
        <h5 class="card-title">Logs</h5>

        <div class="table-responsive">
            <table id="zero_config" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Log Date</th>
                        <th>From</th>
                        <th>To</th>
                        <th>Total Unit</th>
                        <th>Updated At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($logs as $log)
                        <tr>
                            <td>{{ $log->log_date }}</td>
                            <td>
                                pond code - {{ $log->fromPond() }} <br>
                                package code - {{ $log->fromPackage() }}
                            </td>
                            <td>
                                pond code - {{ $log->toPond() }} <br>
                                package code - {{ $log->toPackage() }}
                            </td>
                            <td>{{ $log->total_unit }}</td>
                            <td>{{ $log->updatedAt() }}</td>
                            <td>
                                <a href="{{ route('logs.edit', $log->id) }}" class="btn btn-sm btn-warning">edit</a> |
                                <form class="d-inline" action="{{ route('logs.destroy', $log->id) }}" method="post">
                                    @csrf
                                    @method('delete')

                                    <button class="btn btn-sm btn-danger" type="submit">delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-center" colspan="5">No data</td>
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
