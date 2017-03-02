<?php
/**
 * Created by PhpStorm.
 * User: fabrice
 * Date: 2017/03/02
 * Time: 10:18 AM
 */
namespace FabriceKabongo\Http;

/**
 * Class HttpClient
 * @package FabriceKabongo\HttpClient
 */
class HttpClient
{

    /**
     * Does a post request to the url provided.
     *
     * @todo handle file uplaod
     * @todo handle request content
     *
     * @param $url
     * @param array $postData
     * @param array $files
     * @param null $requestContent
     * @return mixed
     */
    public function post($url, $postData = array(), $files = array(), $requestContent = null)
    {
        $postData = $this->convertArrayToQueryString($postData);

        $resource = $this->prepareQuery($url);

        curl_setopt($resource, CURLOPT_POST, 1);
        curl_setopt($resource, CURLOPT_POSTFIELDS, $postData);

        $result = curl_exec($resource);

        curl_close($resource);

        return $result;
    }

    /**
     * Does a get request to the url provided
     *
     * @param $url
     * @param array $queryParams
     * @return mixed
     */
    public function get($url, $queryParams = array())
    {
        $queryParams = $this->convertArrayToQueryString($queryParams);
        $resource = $this->prepareQuery($url . '?' . $queryParams);

        $result = curl_exec($resource);

        curl_close($resource);

        return $result;

    }

    /**
     * Initialise the Curl resource
     *
     * @param $url
     * @return resource
     */
    protected function prepareQuery($url)
    {
        $resource = curl_init();

        curl_setopt($resource, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($resource, CURLOPT_URL, $url);
        curl_setopt($resource, CURLOPT_FOLLOWLOCATION, 1);
        // Add whatever you need to do before and in common for all the request

        return $resource;
    }

    /**
     * Converts an array to query string
     *
     * @param array $postData
     * @return string
     */
    protected function convertArrayToQueryString($postData)
    {
        if (is_array($postData)) {
            $postData = http_build_query($postData);
        }

        return $postData;
    }

    /**
     * Performs a Base64 Upload
     *
     * @param $url
     * @param $fileLocation
     * @throws \Exception
     */
    public function base64Upload($url, $fileLocation)
    {
        if (!is_file($fileLocation)) {
            throw new \Exception("Couldn't locate the file");
        }
        $fileContent = file_get_contents($fileLocation);

        file_put_contents($url, $fileContent);
    }
}