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
        $a = Spotify::artistAlbums($artist_id)->get(); 


        $total = $a["total"]; 

        $offset = 0; 

        $albums = []; 
        while($offset < $total){

            $albums[] = Spotify::artistAlbums($artist_id)->offset($offset)->get();
            $offset++; 
        }

        dd($albums); 
    }

    public function artistAlbums($artist_id){


          $a = Spotify::artistAlbums($artist_id)->get(); 


        $total = $a["total"]; 

        $offset = 0; 

        $albums = []; 
        while($offset < $total){

            $albums[] = Spotify::artistAlbums($artist_id)->offset($offset)->get();
            $offset++; 
        }

        $album_id_array = []; 

        foreach($albums as $album){

        foreach($album["items"] as $a){

            $album_id_array[] = $a["id"]; 
        }

        }
        
        
        return $album_id_array; 

    }

    

    public function albumTracks($artist_id){

        $artist_album_ids = $this->artistAlbums($artist_id); 
        $tracks_array = []; 

        foreach($artist_album_ids as $a){

            $tracks_array[] = Spotify::albumTracks($a)->get();


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

                //will be empty first time
                if(empty($tracks_array))
                    return false; 

                else{
                 
                    return in_array($exploded[0], Arr::flatten($tracks_array)); 
                }
                    


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


            $tracks_array = []; 

            $count = 0; 

            foreach($albums as $a){

                foreach($a["items"] as $track){



            if(isset($track["name"])){
               

                // if($this->notDuplicate($track["name"], $tracks_array) && !Str::contains($track["name"], ['remastered','Remastered'])){

                // if(!$this->inTracksArray($track["name"], $tracks_array) && !Str::contains($track["name"], ['remastered','Remastered', 'Outtake', 'live', 'Live', 'Different Lyrics'])){


                if(!Str::contains($track["name"], ['remastered','Remastered', 'Outtake', 'live', 'Live', 'Different Lyrics'])){


                    $tracks_array[] = [
                    'name' => $track["name"], 
                    'time' => $track["duration_ms"]

                ];

                $count++;
                }
                

            } //if track name




                    // if($track["duration_ms"])

                    // $playing_time_array[] = $track["duration_ms"]; 
                

            } // inner foreach

            } // outer foreach

            
            $playing_time_ms = $this->sumPlayingTime($tracks_array); 

            $playing_time_minutes = $this->convertToMinutes($playing_time_ms); 
           
          return view('layouts.results', compact('tracks_array', 'playing_time_minutes','count'));


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
