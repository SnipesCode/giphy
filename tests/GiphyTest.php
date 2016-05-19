<?php
/**
 * Giphy Test SDK for PHP
 *
 * @author SnipesCode <snipescode@gmail.com>
 */
namespace Snipes\GiphySDK\Test;

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Snipes\GiphySDK\Giphy;

class GiphyTest extends \PHPUnit_Framework_TestCase
{

    const BASE_URL = 'http://upload.giphy.com';


    public function successProvider()
    {
        return [
            [
                'dc6zaTOxFJmzC', 'username', '/tests/mocks/upload200.json',
                array(
                    'file_url' => 'http://media2.giphy.com/media/YvJr0wQP8yR8I/giphy.gif',
                    'labels' =>  array('Kirk (Alternate)', 'Star Trek (2009)', 'Kobayashi Maru')
                )
            ],
            [
                'dc6zaTOxFJmzC', 'username', '/tests/mocks/uploadFile200.json',
                array(
                    'file_url' => '/home/startrek/cut.mp4',
                    'labels' =>  array('Kirk (Alternate)', 'Star Trek (2009)', 'Kobayashi Maru')
                )
            ]
        ];
    }

    /**
     * @test
     * @dataProvider successProvider
     */
    public function uploadSuccess($apiKey, $username, $mockFile, $params = array())
    {
        $body = file_get_contents(getcwd().$mockFile);
        $mock = new MockHandler([
            new Response(json_decode($body)->meta->status,
                ['Content-Type' => 'application/vnd.api+json'],
                $body
            )
        ]);
        $handler = HandlerStack::create($mock);

        $giphySDK = new Giphy($apiKey, $username, ['handler' => $handler, 'base_uri' => self::BASE_URL]);
        $response = $giphySDK->upload(
            $params['file_url'],
            $params['labels']
        );
        $this->assertEquals(json_decode($body)->data->id, $response);
    }


    public function forbiddenProvider()
    {
        return [
            [
                'fakeKey', 'username', '/tests/mocks/upload403.json',
                array(
                    'file_url' => 'http://media2.giphy.com/media/YvJr0wQP8yR8I/giphy.gif',
                    'labels' =>  array('Kirk (Alternate)', 'Star Trek (2009)', 'Kobayashi Maru')
                )
            ],
            [
                'dc6zaTOxFJmzC', 'username', '/tests/mocks/upload400.json',
                array(
                    'file_url' => 'https://upload.wikimedia.org/wikipedia/en/2/2d/ST_TOS_Cast.jpg',
                    'labels' =>  array('Star Trek Crew')
                )
            ]
        ];
    }

    /**
     * @test
     * @dataProvider forbiddenProvider
     * @expectedException Snipes\GiphySDK\GiphyUploadException
     */
    public function uploadForbidden($apiKey, $username, $mockFile, $params = array())
    {
        $body = file_get_contents(getcwd().$mockFile);
        $mock = new MockHandler([
            new Response(json_decode($body)->meta->status,
                ['Content-Type' => 'application/vnd.api+json'],
                $body
            )
        ]);
        $handler = HandlerStack::create($mock);

        $giphySDK = new Giphy($apiKey, $username, ['handler' => $handler, 'base_uri' => self::BASE_URL]);
        $giphySDK->upload(
            $params['file_url'],
            $params['labels']
        );
    }
}

