<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Str;
use Illuminate\Support\Arr;

use Spotify; 

class MusicProducedController extends Controller
{
    //
    public function show_form(){

            return view('layouts.form'); 

    }
    public function searchArtist(Request $request){

        $request->validate(

            ['artist' => 'required|max:150']

        );

        $artists_result = Spotify::searchArtists($request->input('artist'))->get();

        if(isset($artists_result))
            $artists = $artists_result["artists"]["items"]; 

         
        return view('choose', compact('artists'));

    }

    public function searchAlbums($artist_id){
    
        return Spotify::searchAlbums($artist_id)->get(); 

    }

    public function test(){

        $artist_id = '3RGLhK1IP9jnYFH4BRFJBS'; 
       
          $a = Spotify::artistAlbums($artist_id)->limit(50)->get(); 



        $total = $a["total"]; 


        $offset = 50; 

        $albums = []; 
        $albums[] = $a; 

        if($total > 50){ 
            while($offset < $total){

                $albums[] = Spotify::artistAlbums($artist_id)->includeGroups('album,single')->limit(50)->offset($offset)->get();
                $offset+=50; 
            }
        }
       

        dd($albums); 
        
    }

    public function artistAlbums($artist_id){


          $a = Spotify::artistAlbums($artist_id)->includeGroups('album,single')->limit(50)->get(); 



        $total = $a["total"]; 


        $offset = 50; 

        $albums = []; 
        $albums[] = $a; 

        if($total > 50){ 
            while($offset < $total){

                $albums[] = Spotify::artistAlbums($artist_id)->includeGroups('album,single')->limit(50)->offset($offset)->get();
                $offset+=50; 
            }
        }
       

        

        $album_id_array = []; 

        foreach($albums as $album){

        foreach($album["items"] as $a){

            $album_id_array[] = 
            [

                'id' => $a["id"],
                'name' => $a["name"]
 
            ];
            
        }

        }
        
        
        return $album_id_array; 

    }

    

    public function albumTracks($artist_id){

        $artist_album_ids = $this->artistAlbums($artist_id); 
        $tracks_array = []; 

        foreach($artist_album_ids as $a){

            $tracks_array[] = [

                'tracks' => Spotify::albumTracks($a[
                "id"])->get(),

                'album_name' => $a["name"],


            ];


        }
            
            return $tracks_array;
            //returns this: 
  //           ^ array:20 [▼
  // 0 => array:7 [▼
  //   "href" => "https://api.spotify.com/v1/albums/7nL9UERtRQCB5eWEQCINsh/tracks?offset=0&limit=20"
  //   "items" => array:20 [▼
  //     0 => array:14 [▼
  //       "artists" => array:1 [ …1]
  //       "available_markets" => array:183 [ …183]
  //       "disc_number" => 1
  //       "duration_ms" => 219946
  //       "explicit" => false
  //       "external_urls" => array:1 [ …1]
  //       "href" => "https://api.spotify.com/v1/tracks/1BrkLr0Nk5oYd7kdDIbet1"
  //       "id" => "1BrkLr0Nk5oYd7kdDIbet1"
  //       "is_local" => false
  //       "name" => "Know Your Rights - Remastered"
  //       "preview_url" => "https://p.scdn.co/mp3-preview/75ad55f63c9a8bcd5caa4799d06a549703f7d9ad?cid=62d6f88e0bc7453588f854453caf1135"
  //       "track_number" => 1
  //       "type" => "track"
  //       "uri" => "spotify:track:1BrkLr0Nk5oYd7kdDIbet1"
  //     ]
  //     1 => array:14 [▶] 
        }


        public function inTracksArray($name, $tracks_array){

                $exploded = explode(' -',$name); 
                $contains = false; 

                //will be empty first time
                if(empty($tracks_array)){
                    return false; 
                }

                else{
                 
                 $names_array = Arr::pluck($tracks_array, 'name');

                     // $exploded_track_name = explode(' -',$array[0]); 
                     foreach($names_array as $a){
                        $exploded_track_name = explode(' -',$a); 
                        if(Str::contains($exploded_track_name[0],$exploded[0])){
                            $contains = true; 
                        }

                     }
                     

                 }

                    return $contains; 


 
  
                }
                 

        public function calculateTotalAlbumTime(Request $request){

             $request->validate(
            [
                'artist_id' => 'alpha_num'

            ]
        );

            $playing_time_array = []; 

            //get array of albums
            $albums = $this->albumTracks($request->input('artist_id')); 


           

            $tracks_array = $this->constructTracksArray($albums); 

            //grab the count
            $count = $tracks_array["count"]; 

            //remove count from the array
            $tracks_array = Arr::except($tracks_array, ['count']);

                    
            $playing_time_ms = $this->sumPlayingTime($tracks_array); 

            $playing_time_minutes = $this->convertToMinutes($playing_time_ms); 
           
          return view('layouts.results', compact('tracks_array', 'playing_time_minutes','count'));


        }

        public function constructTracksArray($albums){


            $tracks_array = []; 

            $count = 0; 
            foreach($albums as $a){

                foreach($a["tracks"]["items"] as $track){

                if(isset($track["name"])){
                       

                // if($this->notDuplicate($track["name"], $tracks_array) && !Str::contains($track["name"], ['remastered','Remastered'])){

                // if(!$this->inTracksArray($track["name"], $tracks_array) && !Str::contains($track["name"], ['remastered','Remastered', 'Outtake', 'live', 'Live', 'Different Lyrics'])){


                if(!$this->inTracksArray($track["name"], $tracks_array) && !Str::contains($track["name"], ['Outtake', 'live', 'Live', 'Different Lyrics'])){

                // if(!$this->inTracksArray($track["name"], $tracks_array)){

                    $tracks_array[] =  [
                    'album_name' => $a['album_name'],                       
                    'name' => $track["name"], 
                    'time' => $track["duration_ms"],
                    'link' => $track["uri"]


                    ];
                    

                $count++;
                }
                

            } //if track name


            } // inner foreach



            } // outer foreach

            $tracks_array["count"] = $count; 



            return $tracks_array; 

        }

        public function sumPlayingTime($tracks_array){

                 // dd($playing_time_array); 
            $playing_time = 0; 

            foreach($tracks_array as $track){

                $playing_time+= $track["time"]; 

            }

            return $playing_time; 


        }

        public function convertToMinutes($playing_time_ms){

                return $playing_time_ms/60000; 

        }


    
}
