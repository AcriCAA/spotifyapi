
@extends('layouts.master')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h1>Artist Results</h1>
             <h2>Playing Time Across All Albums: {{round($playing_time_minutes,2)}} min </h2>

             <p>Tracks totaled: {{$count}}</p>

             <table class="table table-responsive caption-top">
                <tbody>
                    <tr>
                        <th>Album</th>
                        <th>Track</th>
                        <th>Duration</th>
                    </tr>
             @foreach($tracks_array as $t)

             <tr>
               
               <td>{{$t["album_name"]}}</td><td><a href="{{$t["link"]}}" target="_blank">{{$t["name"]}}</a></td> <td>{{round($t["time"]/60000,2)}} min</td>
           </tr>
             @endforeach
            </tbody>
            </table>
        </div>            
    </div>
</div>

@endsection
