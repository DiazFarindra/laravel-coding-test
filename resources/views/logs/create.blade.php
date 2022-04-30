@extends('layouts.matrix.app', ['bc' => 'create'])

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/libs/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
@endpush

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-body">
            <h5 class="mb-0 card-title">Create</h5>
            <form action="{{ route('logs.store') }}" method="post">
                @csrf

                <input type="hidden" name="package_id" value="{{ $package->id }}">

                <div class="mt-3 form-group">
                    <label class="mt-3">Date</label>
                    <div class="input-group">
                        <input type="text" name="log_date" class="form-control @error('log_date') is-invalid @enderror"" id="datepicker-autoclose" placeholder="mm/dd/yyyy">
                        <div class="input-group-append">
                            <span class="input-group-text h-100"><i class="fa fa-calendar"></i></span>
                        </div>
                        @error('log_date')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="mt-3 form-group">
                    <label class="mt-3 col-md-3">Sort To Packages</label>
                    <div class="col-6">
                        <select name="to_package_id" class="shadow-none select2 form-select @error('to_package_id') is-invalid @enderror">
                            <option selected disabled>select packages</option>
                            @forelse ($ponds as $pond)
                            <optgroup label="pond code - {{ $pond->pond_code }}">
                                @forelse ($pond->packages->except($package->id) as $pack)
                                    <option value="{{ $pack->id }}">
                                        package code - {{ $pack->package_code }} |
                                        total unit - {{ $pack->total_unit }}
                                    </option>
                                @empty
                                    <option disabled>create package first</option>
                                @endforelse
                            </optgroup>
                            @empty
                                <option disabled>create new pond first</option>
                            @endforelse
                        </select>
                        @error('to_package_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="mt-3 form-group">
                    <label>Sort Total Unit <small><sup class="font-bold text-danger h6">*</sup></small></label>
                    <input type="number" name="total_unit" class="form-control date-inputmask @error('total_unit') is-invalid @enderror" placeholder="total unit...">
                    @error('total_unit')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection

@push('js')
    <script src="{{ asset('assets/libs/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/libs/select2/dist/js/select2.min.js') }}"></script>

    <script src="{{ asset('assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>

    <script>
        $(".select2").select2();

        jQuery('#datepicker-autoclose').datepicker({
            autoclose: true,
            todayHighlight: true
        });
    </script>
@endpush
