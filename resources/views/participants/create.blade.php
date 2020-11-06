
    @extends('layouts.app')
    @section('content')  
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add Participants') }}</div>

                @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

                <div class="card-body">
                    <form method="POST" action="/participant/store">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="dob" class="col-md-4 col-form-label text-md-right">{{ __('DOB') }}</label>

                            <div class="col-md-6">
                                <input id="dob" type="text" class="date form-control @error('dob') is-invalid @enderror" name="dob" value="{{ old('dob') }}" required autocomplete="dob">

                                @error('dob')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="profession" class="col-md-4 col-form-label text-md-right">{{ __('Profession') }}</label>

                            <div class="col-md-6">
                                <select id="profession" type="text" class="date form-control @error('profession') is-invalid @enderror" name="profession" >
                                  <option value="0">Choose One</option>
                                  <option value="Employed">Employed</option>
                                  <option value="Student">Student</option>
                                </select>

                                @error('profession')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="locality" class="col-md-4 col-form-label text-md-right">{{ __('Locality') }}</label>

                            <div class="col-md-6">
                                <input id="locality" type="text" class="form-control" name="locality" required autocomplete="locality">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="number_of_guests" class="col-md-4 col-form-label text-md-right">{{ __('Number Of Guests') }}</label>

                            <div class="col-md-6">
                                <select id="number_of_guests" type="text" class="date form-control @error('number_of_guests') is-invalid @enderror" name="number_of_guests" >
                                  <option value="0">0</option>
                                  <option value="1">1</option>
                                  <option value="2">2</option>
                                </select>

                                @error('number_of_guests')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>

                            <div class="col-md-6">
                                <textarea id="address" type="text" class="form-control" name="address" required autocomplete="address"></textarea>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Submit') }}
                                </button>
                                <button type="button" onclick="window.history.back();" class="btn btn-secondary">
                                    {{ __('Back') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
 