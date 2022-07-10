<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Str;

use Spotify; 

class MusicProducedController extends Controller
{
    //
    public function searchArtist(){

        $artist = Spotify::searchArtists('The Clash')->get();

        dd($artist); 


    }

    public function searchAlbums(){


        $albums = Spotify::searchAlbums('3RGLhK1IP9jnYFH4BRFJBS')->get(); 

        dd($albums); 

    }

    public function artistAlbums(){


        $albums = Spotify::artistAlbums('3RGLhK1IP9jnYFH4BRFJBS')->get(); 

        $album_id_array = []; 
        foreach($albums["items"] as $a){

            $album_id_array[] = $a["id"]; 
        }

        return $album_id_array; 

    }

    

    public function albumTracks(){

        $artist_album_ids = $this->artistAlbums(); 
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

        public function calculateTotalAlbumTime(){


            $playing_time_array = []; 

            $albums = $this->albumTracks(); 

            foreach($albums as $a){

                foreach($a["items"] as $track){



            if(isset($track["name"]) && Str::contains($track["name"], ['remastered','Remastered'])){
                var_dump('it is remastered');
            }
            else{
                var_dump('it is not');

                $tracks_array[] = [
                    'name' => $track["name"], 
                    'time' => $track["duration_ms"]


                ];
            }




                    if($track)

                    $playing_time_array[] = $track["duration_ms"]; 
                }

            }

            dd($tracks_array); 
            // dd($playing_time_array); 
            $playing_time = .1; 
            foreach($playing_time_array as $p){

                $playing_time+= $p; 

            }

            dd($playing_time/60000); 

        }


    
}
