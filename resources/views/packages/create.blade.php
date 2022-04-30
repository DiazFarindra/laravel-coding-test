@extends('layouts.matrix.app', ['bc' => 'create'])

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-body">
            <h5 class="mb-0 card-title">Create</h5>
            <form action="{{ route('packages.store') }}" method="post">
                @csrf

                <div class="mt-3 form-group">
                    <label class="mt-3 col-md-3">Select Pond</label>
                    <div class="col-6">
                        <select name="pond_id" class="shadow-none select2 form-select @error('pond_id') is-invalid @enderror">
                            <option selected disabled>select pond</option>
                            @forelse ($ponds as $pond)
                                <option value="{{ $pond->id }}">pond code - {{ $pond->pond_code }}</option>
                            @empty
                                <option disabled>create pond first</option>
                            @endforelse
                        </select>
                        @error('pond_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="mt-3 form-group">
                    <label>Package Code <small><sup class="font-bold text-danger h6">*</sup></small></label>
                    <input type="text" name="package_code" class="form-control date-inputmask @error('package_code') is-invalid @enderror" placeholder="package code...">
                    @error('package_code')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mt-3 form-group">
                    <label>Total Unit <small><sup class="font-bold text-danger h6">*</sup></small></label>
                    <input type="number" name="total_unit" value="0" class="form-control date-inputmask @error('total_unit') is-invalid @enderror" placeholder="total unit...">
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
