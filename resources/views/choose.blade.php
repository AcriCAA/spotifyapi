
@extends('layouts.master')

@section('content')


<div class="container">
    <div class="row justify-content-center">
              <h1>Choose artist</h1>
                        



                @foreach($artists as $a)
                @if($loop->first)
                <h4 class="mt-4">Recommended choice</h4>
                        <div class="col-sm-12"> 

                @else
                
                                <div class="col mt-3">

                @endif                
                    <form role="form" method="POST" action="/artist/albums">
                       @csrf 
                               
                        
                        

                     
                            

                                 <input
                                        type="hidden"
                                        name="artist_id"
                                        value="{{$a["id"]}}"
                                        required
                                >
                                
                                <button type="submit" 
                                @if($loop->first)

                                class="btn btn-outline-success"
                                @else 

                                class="btn btn-outline-secondary"
                                @endif

                                >
                                    {{$a["name"]}}
                                </button>
                            
                        

            </form>
            </div>

            @if($loop->first)
            <h4 class="mt-4">Other options</h4>
            @endif
                @endforeach

                 
        </div>            
    </div>
</div>

@endsection
