@extends('layouts.main')

@section('title_page', 'Edit city')
@section('content')
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Edit city</h6>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('cities.update', $city->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group row">
                        <label for="state_id" class="col-md-4 col-form-label text-md-right">{{ __('State Name') }}</label>

                        <div class="col-md-6">
                            <select class="form-control select2 @error('state_id') is-invalid @enderror" name="state_id" required>
                                <option selected disabled>Select Country</option>
                                @foreach ($states as $state)
                                    <option value="{{ $state->id }}"
                                        @if ($state->id == $city->state_id)
                                            selected
                                        @endif>{{ $state->name }}</option>
                                @endforeach
                            </select>

                            @error('state_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $state->name) }}" required autocomplete="name" autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Update') }}
                            </button>
                            <a href="{{ route('cities.index') }}" class="btn btn-secondary" type="button">Back</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection