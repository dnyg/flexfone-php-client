<?php
namespace Flexfone;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\CurlHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Uri;
use Psr\Http\Message\RequestInterface;

class WebClient extends Client
{
    public const BASE_URL = 'https://public.sippeer.dk/api/';

    public function __construct(string $pbxId, string $apiKey)
    {
        $handler = new HandlerStack();
        $handler->setHandler(new CurlHandler());

        $defaultParameters = [
            'account' => $pbxId,
            'hash' => $apiKey
        ];

        $middleware = Middleware::mapRequest(function(RequestInterface $request) use ($defaultParameters) {
            $uri = $request->getUri();

            foreach ($defaultParameters as $key => $value) {
                $uri = Uri::withQueryValue($uri, $key, $value);
            }

            return $request->withUri($uri);
        });

        $handler->unshift($middleware);

        parent::__construct([
            'base_uri' => self::BASE_URL,
            'handler' => $handler
        ]);
    }
}
