@extends('layouts.matrix.app', ['bc' => 'create'])

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-body">
            <h5 class="mb-0 card-title">Create</h5>
            <form action="{{ route('ponds.store') }}" method="post">
                @csrf

                <div class="mt-3 form-group">
                    <label>Pond Code <small><sup class="font-bold text-danger h6">*</sup> max: 5 character</small></label>
                    <input type="text" name="pond_code" class="form-control date-inputmask @error('pond_code') is-invalid @enderror" placeholder="pond code...">
                    @error('pond_code')
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
