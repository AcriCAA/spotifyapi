
@extends('layouts.master')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
             <p>Playing Time Across All Albums: {{$playing_time_minutes}}</p>

             <p>Tracks totaled: {{$count}}</p>

             <table class="table table-responsive caption-top">
                <tbody>
             @foreach($tracks_array as $t)
             <tr>
               
               <td>{{$t["name"]}}</td> <td>{{$t["time"]}}</td>
           </tr>
             @endforeach
            </tbody>
            </table>
        </div>            
    </div>
</div>

@endsection
