
@extends('layouts.master')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        
              <form role="form" method="POST" action="/get/artist">
                        @csrf




                  <div class="col-lg-6">
                    <h1>Search</h1>
                    <label>Enter Artist Name</label>
                                <input
                                        type="text"
                                        class="form-control{{ $errors->has('artist') ? ' is-invalid' : '' }}"
                                        name="artist"
                                        value=""
                                        required
                                >
                                
                                
                                @if ($errors->has('artist'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('artist') }}</strong>
                                    </div>
                                @endif
                            </div>
                        

                

                  <div class="row mt-2">
                            <div class="col-lg-12">
                                <button type="submit" class="btn btn-outline-success text-right">
                                    Submit
                                </button>
                            </div>
                        </div>


            </form>
        </div>            
    </div>
</div>

@endsection
