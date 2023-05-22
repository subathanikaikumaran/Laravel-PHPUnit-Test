<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Config;
use Exception;
use Illuminate\Support\Facades\Session;

class HttpConnection
{

    
    public function apiConnection($action, $data)
    {
        $client = new Client();
        $arrayResponse = array();
        try {
            $response = $client->post(Config::get('api-config.api.Client') . $action, [
                'json' => $data,
                'verify' => false
            ]);
            $dataJson = mb_convert_encoding($response->getBody()->getContents(), 'UTF-8', 'UTF-8');
            $arrayResponse["response"] = json_decode($dataJson, true);
            
        } catch (\GuzzleHttp\Exception\ConnectException $e) {
            $arrayResponse["error"] = "There is server connection issue.";
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            $execptionJson = $e->getResponse()->getBody()->getContents();            
            $err = json_decode($execptionJson);
            $arrayResponse["error"] =$err->Message ;               
        }catch(Exception $e){
            $arrayResponse["error"] = $e->getMessage();
         }
        return $arrayResponse;
    }    
}
