
@extends('layouts.master')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
              <form role="form" method="POST" action="/get/artist">
                        @csrf




                  <div class="col-lg-6">
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
                        </div>

                

                  <div class="form-group row">
                            <div class="col-lg-6 offset-lg-4">
                                <button type="submit" class="btn btn-outline-success">
                                    Submit
                                </button>
                            </div>
                        </div>


            </form>
        </div>            
    </div>
</div>

@endsection
