@extends('layouts.matrix.app', ['bc' => 'spell-counter'])

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-body">
            <h5 class="mb-0 card-title">Spell Counter</h5>
            <form action="{{ route('spell-checker.index') }}" method="post">
                @csrf

                <div class="mt-3 form-group">
                    <label>Words <small><sup class="font-bold text-danger h6">*</sup></small></label>
                    <input type="text" name="words" class="form-control date-inputmask @error('words') is-invalid @enderror" placeholder="abcde...">
                    @error('words')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mt-3 form-group">
                    <label>Sentence <small><sup class="font-bold text-danger h6">*</sup></small></label>
                    <input type="text" name="sentence" class="form-control date-inputmask @error('sentence') is-invalid @enderror" placeholder="lorem ipsum dolor sit amet...">
                    @error('sentence')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Count</button>
            </form>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <h2 class="mb-0 card-title">Result</h2>
            <p>{{ $result ?? '' }}</p>
        </div>
    </div>
</div>
@endsection
