<?php
/**
 * Giphy SDK for PHP
 *
 * @author SnipesCode <snipescode@gmail.com>
 */
namespace Snipes\GiphySDK;

use GuzzleHttp\Client as GuzzleClient;

class Giphy
{

    const UPLOAD_ENDPOINT = '/v1/gifs';

    const HOST_UPLOAD_ENDPOINT = 'http://upload.giphy.com';

    private $options;

    /**
     * @param $apiKey
     * @param $username
     * @param array $config
     */
    public function __construct($apiKey, $username, $config = array())
    {
        if (empty($config['base_uri'])) {
            $config['base_uri'] = self::HOST_UPLOAD_ENDPOINT;
        }
        $this->options['api_key'] = "api_key=$apiKey";
        $this->options['username'] = "username=$username";
        $this->guzzle = new GuzzleClient($config);
    }

    /**
     * @param string $file Could be a file or URL
     * @tags array
     * @return integer FileId
     * @throws GiphyUploadException
     */
    public function upload($file, $tags = array())
    {
        $params = array();
        if (file_exists($file)) {
            $params['multipart'] = [
                    ['name' => 'file', 'contents' => fopen($file, 'r')
                ]
            ];
        } else {
            $this->options['source_image_url'] = 'source_image_url='.$file;
        }
        if (!empty($tags)) {
            $this->options['tags'] = 'tags='.implode(',', $tags);
        }
        try {
            $response = $this->guzzle->post(self::UPLOAD_ENDPOINT.'?'.implode('&', $this->options), $params);
            $json = $response->getBody()->getContents();
            $decodedJson = json_decode($json);
        } catch (\Exception $e) {
            throw new GiphyUploadException('Upload Giphy failed: '.$e->getMessage(), $e->getCode());
        }
        if ($decodedJson->meta->status != 200) {
            throw new GiphyUploadException('Upload Giphy failed: '.$decodedJson->meta->msg, $decodedJson->meta->status);
        }
        return $decodedJson->data->id;
    }
}