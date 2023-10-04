<?php

namespace App\Traits;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;

trait MapTrait
{

    protected $map_key = "AIzaSyBfjVre0paUOf4kvUNUPTNU3omF6iV-c5Q";
    // public function getMapDetails($lat, $lng)
    // {
    //     try {
    //         $client = new Client();
    //         $response = $client->request('Get', "https://maps.google.com/maps/api/geocode/json?latlng=$lat,$lng&key=". config('app.google_maps_api_key'), [
    //             'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json'],
    //         ]);
    //         return json_decode($response->getBody(), true);
    //     } catch (ClientException $exception) {
    //         return $exception->getResponse()->getBody();
    //     }
    // }

    public function getMapAddressDetails($latitude, $longitude)
    {

        $client = new Client();

        try {
            $response = $client->get("https://maps.google.com/maps/api/geocode/json?latlng=$latitude,$longitude&key=$this->map_key");
            $response = json_decode($response->getBody(), true);
            if ($response['status'] === 'OK' && count($response['results']) > 0) {
                $result = $response['results'][0];
                $address = $result['formatted_address'];

                return $address;
            }
        } catch (ClientException $exception) {
            // Handle exception
        }

        return null;
    }
}

