<?php

namespace App\Support;

use JonnyW\PhantomJs\Client;

class PhantomJSClient
{
    /**
     * Gets the DOM string or returns false is failed.
     *
     * @param String $url
     * @return bool|string
     */
    public static function getDOMString(String $url)
    {
        $client = Client::getInstance();
        $client->getEngine()->setPath(base_path('/node_modules/phantomjs/bin/phantomjs'));

        $request  = $client->getMessageFactory()->createRequest($url, 'GET');
        $response = $client->getMessageFactory()->createResponse();
        $client->send($request, $response);

        if ($response->getStatus() === 200) {
            return $response->getContent();
        }

        return false;
    }
}
