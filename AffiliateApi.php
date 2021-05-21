<?php

class ApiException extends \Exception
{

    /**
     * The HTTP body of the server response either as Json or string.
     *
     * @var mixed
     */
    protected $responseBody;

    /**
     * The HTTP header of the server response.
     *
     * @var string[]
     */
    protected $responseHeaders;

    /**
     * The deserialized response object
     *
     * @var $responseObject;
     */
    protected $responseObject;

    /**
     * Constructor
     *
     * @param string   $message         Error message
     * @param int      $code            HTTP status code
     * @param string[] $responseHeaders HTTP response header
     * @param mixed    $responseBody    HTTP decoded body of the server response either as \stdClass or string
     */
    public function __construct($message = "", $code = 0, $responseHeaders = [], $responseBody = null)
    {
        parent::__construct($message, $code);
        $this->responseHeaders = $responseHeaders;
        $this->responseBody = $responseBody;
    }

    /**
     * Gets the HTTP response header
     *
     * @return string[] HTTP response headers
     */
    public function getResponseHeaders()
    {
        return $this->responseHeaders;
    }

    /**
     * Gets the HTTP body of the server response either as Json or string
     *
     * @return mixed HTTP body of the server response either as \stdClass or string
     */
    public function getResponseBody()
    {
        return $this->responseBody;
    }

    /**
     * Sets the deseralized response object (during deserialization)
     *
     * @param mixed $obj Deserialized response object
     *
     * @return void
     */
    public function setResponseObject($obj)
    {
        $this->responseObject = $obj;
    }

    /**
     * Gets the deseralized response object (during deserialization)
     *
     * @return mixed the deserialized response object
     */
    public function getResponseObject()
    {
        return $this->responseObject;
    }
}


class AffiliateApi
{

    public static $POST = "POST";
    public static $GET = "GET";
    public static $PUT = "PUT";
    public static $DELETE = "DELETE";
    private static $API_KEY = "8c4da671-18d3-46fa-a049-d90aef43cd61";
    private static $BASE_URL = "reports.statloader.com";


    protected $user_agent;
    
    /**
     * Constructor
     * @param string $user_agent Custom User-Agent for all requests (optional)
     */
    public function __construct($user_agent = null)
    {
        if ( isset( $user_agent ) ) {
            $this->user_agent = $user_agent;
        } else {
            $this->user_agent = $_SERVER['HTTP_USER_AGENT'] ?? null;
        }
    }
    
    /**
     * Operation getAffiliateReports
     *
     * @param string $type Report type (clicks/sales) (required)
     * @param \DateTime $start Report start date (required)
     * @param \DateTime $end Report end date (optional)
     * @param string $format Report format (csv/json) (optional)
     * @throws ApiException on non-2xx response
     * @return mixed The report in the specified $format
     */
    public function getAffiliateReports($type, $start, $end = null, $format = null)
    {
        $key = self::$API_KEY;
        list($response) = $this->getAffiliateReportsWithHttpInfo($key, $type, $start, $end, $format);
        return $response;
    }

    /**
     * Operation getAffiliateReportsWithHttpInfo
     *
     * @param string $key Affiliate API key (required)
     * @param string $type Report type (clicks/sales) (required)
     * @param \DateTime $start Report start date (required)
     * @param \DateTime $end Report end date (optional)
     * @param string $format Report format (csv/json) (optional)
     * @throws ApiException on non-2xx response
     * @return array of AffiliatesReportList, HTTP status code, HTTP response headers (array of strings)
     */
    public function getAffiliateReportsWithHttpInfo($key, $type, $start, $end = null, $format = null)
    {
        // verify the required parameter 'key' is set
        if ($key === null) {
            throw new \InvalidArgumentException('Missing the required parameter $key when calling affiliatesReportsList');
        }
        // verify the required parameter 'type' is set
        if ($type === null) {
            throw new \InvalidArgumentException('Missing the required parameter $type when calling affiliatesReportsList');
        }
        // verify the required parameter 'start' is set
        if ($start === null) {
            throw new \InvalidArgumentException('Missing the required parameter $start when calling affiliatesReportsList');
        }
        // parse inputs
        $resourcePath = "/affiliates/reports";
        $httpBody = '';
        $queryParams = [];
        $headerParams = [];
        $formParams = [];
        $_header_accept = $this->selectHeaderAccept(['application/json', 'text/csv']);
        if (!is_null($_header_accept)) {
            $headerParams['Accept'] = $_header_accept;
        }
        $headerParams['Content-Type'] = $this->selectHeaderContentType(['application/json']);

        // query params
        if ($key !== null) {
            $queryParams['key'] = $this->toQueryValue($key);
        }
        // query params
        if ($type !== null) {
            $queryParams['type'] = $this->toQueryValue($type);
        }
        // query params
        if ($start !== null) {
            $queryParams['start'] = $this->toQueryValue($start);
        }
        // query params
        if ($end !== null) {
            $queryParams['end'] = $this->toQueryValue($end);
        }
        // query params
        if ($format !== null) {
            $queryParams['format'] = $this->toQueryValue($format);
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            $httpBody = $_tempBody; // $_tempBody is the method argument, if present
        } elseif (count($formParams) > 0) {
            $httpBody = $formParams; // for HTTP post (form)
        }
        // make the API Call
        try {
            return $this->callApi(
                $resourcePath,
                'GET',
                $queryParams,
                $httpBody,
                $headerParams
            );
        } catch (ApiException $e) {
            //your custom error-handling
            return $e;
            throw $e;
        }
    }
    
    /**
     * Operation affiliatesCampaignsAssetsList
     *
     * @param string $campaign_id  (required)
     * @throws ApiException on non-2xx response
     * @return mixed The zip content
     */
    public function getZippedAffiliatesCampaignsAssets($campaign_id)
    {
        $key = self::$API_KEY;
        list($response) = $this->zippedAffiliatesCampaignsAssetsWithHttpInfo( $campaign_id, $key );
        return $response;
    }

    /**
     * Operation affiliatesCampaignsAssetsListWithHttpInfo
     *
     * @param string $campaign_id  (required)
     * @param string $key Affiliate API key (required)
     * @throws ApiException on non-2xx response
     * @return mixed The zip content, status code and http header
     */
    public function zippedAffiliatesCampaignsAssetsWithHttpInfo($campaign_id, $key)
    {
        // verify the required parameter 'campaign_id' is set
        if (null === $campaign_id) {
            throw new \InvalidArgumentException('Missing the required parameter $campaign_id when calling affiliatesCampaignsAssetsList');
        }
        // verify the required parameter 'key' is set
        if (null === $key) {
            throw new \InvalidArgumentException('Missing the required parameter $key when calling affiliatesCampaignsAssetsList');
        }
        // parse inputs
        $format = "zip";
        $resourcePath = "/affiliates/campaigns/{campaign_id}/assets/";
        $httpBody = '';
        $queryParams = [];
        $headerParams = [];
        
        $headerParams['Content-Type'] = $this->selectHeaderContentType(['application/json']);
        $headerParams['Accept-Encoding'] = "gzip,deflate,br";
        $queryParams['key'] = $this->toQueryValue($key);
        
        $queryParams['format'] = $this->toQueryValue($format);

        $resourcePath = str_replace(
            "{" . "campaign_id" . "}",
            $this->toPathValue($campaign_id),
            $resourcePath
        );

        // for model (json/xml)
        if (isset($_tempBody)) {
            $httpBody = $_tempBody; // $_tempBody is the method argument, if present
        }
        
        // make the API Call
        try {
            return $this->callApi(
                $resourcePath,
                'GET',
                $queryParams,
                $httpBody,
                $headerParams
            );
        } catch (ApiException $e) {
            // your custom error handling
            throw $e;
        }
    }

    /**
     * Operation affiliatesCampaignsCreativesAssetsList
     *
     * @param string $campaign_id  (required)
     * @param string $creative_id  (required)
     * @throws ApiException on non-2xx response
     * @return mixed
     */
    public function getAssetsForCreative($campaign_id, $creative_id)
    {
        $key = self::$API_KEY;
        list($response) = $this->getAssetsForCreativeWithHttpInfo($campaign_id, $creative_id, $key);
        return $response;
    }

    /**
     * Operation affiliatesCampaignsCreativesAssetsListWithHttpInfo
     *
     * @param string $campaign_id  (required)
     * @param string $creative_id  (required)
     * @param string $key Affiliate API key (required)
     * @throws ApiException on non-2xx response
     * @return mixed
     */
    public function getAssetsForCreativeWithHttpInfo($campaign_id, $creative_id, $key)
    {
        // verify the required parameter 'campaign_id' is set
        if ($campaign_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $campaign_id when calling affiliatesCampaignsCreativesAssetsList');
        }
        // verify the required parameter 'creative_id' is set
        if ($creative_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $creative_id when calling affiliatesCampaignsCreativesAssetsList');
        }
        // verify the required parameter 'key' is set
        if ($key === null) {
            throw new \InvalidArgumentException('Missing the required parameter $key when calling affiliatesCampaignsCreativesAssetsList');
        }
        // parse inputs
        $resourcePath = "/affiliates/campaigns/{campaign_id}/creatives/{creative_id}/assets";
        $httpBody = '';
        $queryParams = [];
        $headerParams = [];
        $formParams = [];
        $_header_accept = $this->selectHeaderAccept(['application/json', 'text/csv']);
        if (!is_null($_header_accept)) {
            $headerParams['Accept'] = $_header_accept;
        }
        $headerParams['Content-Type'] = $this->selectHeaderContentType(['application/json']);

        // query params
        if ($key !== null) {
            $queryParams['key'] = $this->toQueryValue($key);
        }
        // path params
        if ($campaign_id !== null) {
            $resourcePath = str_replace(
                "{" . "campaign_id" . "}",
                $this->toPathValue($campaign_id),
                $resourcePath
            );
        }
        // path params
        if ($creative_id !== null) {
            $resourcePath = str_replace(
                "{" . "creative_id" . "}",
                $this->toPathValue($creative_id),
                $resourcePath
            );
        }

        // make the API Call
        try {
            return $this->callApi(
                $resourcePath,
                'GET',
                $queryParams,
                $httpBody,
                $headerParams
            );
        } catch (ApiException $e) {
            // your custom error-handling
            throw $e;
        }
    }

    /**
     * Operation affiliatesCampaignsCreativesAssetsRead
     *
     * @param string $campaign_id  (required)
     * @param string $creative_id  (required)
     * @param string $asset_id  (required)
     * @throws ApiException on non-2xx response
     * @return File file content of the selected asset
     */
    public function getAssetPreview($campaign_id, $creative_id, $asset_id)
    {
        $key = self::$API_KEY;
        list($response) = $this->getAssetPreviewWithHttpInfo($campaign_id, $creative_id, $asset_id, $key);
        return $response;
    }

    /**
     * Operation affiliatesCampaignsCreativesAssetsReadWithHttpInfo
     *
     * @param string $campaign_id  (required)
     * @param string $creative_id  (required)
     * @param string $asset_id  (required)
     * @param string $key Affiliate API key (required)
     * @throws ApiException on non-2xx response
     * @return array of response, HTTP status code, HTTP response headers (array of strings)
     */
    public function getAssetPreviewWithHttpInfo($campaign_id, $creative_id, $asset_id, $key)
    {
        // verify the required parameter 'campaign_id' is set
        if ($campaign_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $campaign_id when calling affiliatesCampaignsCreativesAssetsRead');
        }
        // verify the required parameter 'creative_id' is set
        if ($creative_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $creative_id when calling affiliatesCampaignsCreativesAssetsRead');
        }
        // verify the required parameter 'asset_id' is set
        if ($asset_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $asset_id when calling affiliatesCampaignsCreativesAssetsRead');
        }
        // verify the required parameter 'key' is set
        if ($key === null) {
            throw new \InvalidArgumentException('Missing the required parameter $key when calling affiliatesCampaignsCreativesAssetsRead');
        }
        // parse inputs
        $resourcePath = "/affiliates/campaigns/{campaign_id}/creatives/{creative_id}/assets/{asset_id}";
        $httpBody = '';
        $queryParams = [];
        $headerParams = [];
        
        $headerParams['Content-Type'] = $this->selectHeaderContentType(['application/json']);

        // query params
        if ($key !== null) {
            $queryParams['key'] = $this->toQueryValue($key);
        }
        $queryParams['preview'] = "true";
        // path params
        if ($campaign_id !== null) {
            $resourcePath = str_replace(
                "{" . "campaign_id" . "}",
                $this->toPathValue($campaign_id),
                $resourcePath
            );
        }
        // path params
        if ($creative_id !== null) {
            $resourcePath = str_replace(
                "{" . "creative_id" . "}",
                $this->toPathValue($creative_id),
                $resourcePath
            );
        }
        // path params
        if ($asset_id !== null) {
            $resourcePath = str_replace(
                "{" . "asset_id" . "}",
                $this->toPathValue($asset_id),
                $resourcePath
            );
        }

        // make the API Call
        try {
            return $this->callApi(
                $resourcePath,
                'GET',
                $queryParams,
                $httpBody,
                $headerParams
            );
        } catch (ApiException $e) {
            //your custom error-handling
            throw $e;
        }
    }

    /**
     * Operation affiliatesCampaignsCreativesList
     *
     * @param string $campaign_id  (required)
     * @throws ApiException on non-2xx response
     * @return mixed
     */
    public function getCampaignCreatives($campaign_id)
    {
        $key = self::$API_KEY;
        list($response) = $this->getCampaignCreativesWithHttpInfo($campaign_id, $key);
        return $response;
    }

    /**
     * Operation affiliatesCampaignsCreativesListWithHttpInfo
     *
     * @param string $campaign_id  (required)
     * @param string $key Affiliate API key (required)
     * @throws ApiException on non-2xx response
     * @return mixed
     */
    public function getCampaignCreativesWithHttpInfo($campaign_id, $key)
    {
        // verify the required parameter 'campaign_id' is set
        if ($campaign_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $campaign_id when calling affiliatesCampaignsCreativesList');
        }
        // verify the required parameter 'key' is set
        if ($key === null) {
            throw new \InvalidArgumentException('Missing the required parameter $key when calling affiliatesCampaignsCreativesList');
        }
        // parse inputs
        $resourcePath = "/affiliates/campaigns/{campaign_id}/creatives";
        $httpBody = '';
        $queryParams = [];
        $headerParams = [];
        $formParams = [];
        $_header_accept = $this->selectHeaderAccept(['application/json', 'text/csv']);
        if (!is_null($_header_accept)) {
            $headerParams['Accept'] = $_header_accept;
        }
        $headerParams['Content-Type'] = $this->selectHeaderContentType(['application/json']);

        // query params
        if ($key !== null) {
            $queryParams['key'] = $this->toQueryValue($key);
        }
        // path params
        if ($campaign_id !== null) {
            $resourcePath = str_replace(
                "{" . "campaign_id" . "}",
                $this->toPathValue($campaign_id),
                $resourcePath
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            $httpBody = $_tempBody; // $_tempBody is the method argument, if present
        } elseif (count($formParams) > 0) {
            $httpBody = $formParams; // for HTTP post (form)
        }
        // make the API Call
        try {
            return $this->callApi(
                $resourcePath,
                'GET',
                $queryParams,
                $httpBody,
                $headerParams
            );
        } catch (ApiException $e) {
            // your custom error-handling

            throw $e;
        }
    }

    /**
     * Operation affiliatesCampaignsCreativesRead
     *
     * @param string $campaign_id  (required)
     * @param string $creative_id  (required)
     * @param string $preview preview/render the creative in a browser (optional)
     * @throws ApiException on non-2xx response
     * @return mixed
     */
    public function getCampaignCreative($campaign_id, $creative_id, $preview = null)
    {
        list($response) = $this->getCampaignCreativeWithHttpInfo($campaign_id, $creative_id, $this->api_key, $preview);
        return $response;
    }

    /**
     * Operation affiliatesCampaignsCreativesReadWithHttpInfo
     *
     * @param string $campaign_id  (required)
     * @param string $creative_id  (required)
     * @param string $key Affiliate API key (required)
     * @param string $preview preview/render the creative in a browser (optional)
     * @throws ApiException on non-2xx response
     * @return mixed
     */
    public function getCampaignCreativeWithHttpInfo($campaign_id, $creative_id, $key, $preview = null)
    {
        // verify the required parameter 'campaign_id' is set
        if ($campaign_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $campaign_id when calling affiliatesCampaignsCreativesRead');
        }
        // verify the required parameter 'creative_id' is set
        if ($creative_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $creative_id when calling affiliatesCampaignsCreativesRead');
        }
        // verify the required parameter 'key' is set
        if ($key === null) {
            throw new \InvalidArgumentException('Missing the required parameter $key when calling affiliatesCampaignsCreativesRead');
        }
        // parse inputs
        $resourcePath = "/affiliates/campaigns/{campaign_id}/creatives/{creative_id}";
        $httpBody = '';
        $queryParams = [];
        $headerParams = [];
        $formParams = [];
        $_header_accept = $this->selectHeaderAccept(['application/json', 'text/csv']);
        if (!is_null($_header_accept)) {
            $headerParams['Accept'] = $_header_accept;
        }
        $headerParams['Content-Type'] = $this->selectHeaderContentType(['application/json']);

        // query params
        if ($key !== null) {
            $queryParams['key'] = $this->toQueryValue($key);
        }
        // query params
        if ($preview !== null) {
            $queryParams['preview'] = $this->toQueryValue($preview);
        }
        // path params
        if ($campaign_id !== null) {
            $resourcePath = str_replace(
                "{" . "campaign_id" . "}",
                $this->toPathValue($campaign_id),
                $resourcePath
            );
        }
        // path params
        if ($creative_id !== null) {
            $resourcePath = str_replace(
                "{" . "creative_id" . "}",
                $this->toPathValue($creative_id),
                $resourcePath
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            $httpBody = $_tempBody; // $_tempBody is the method argument, if present
        } elseif (count($formParams) > 0) {
            $httpBody = $formParams; // for HTTP post (form)
        }
        // make the API Call
        try {
            return $this->callApi(
                $resourcePath,
                'GET',
                $queryParams,
                $httpBody,
                $headerParams
            );
        } catch (ApiException $e) {
            //your custom error-handling

            throw $e;
        }
    }

        /**
     * Operation affiliatesCampaignsList
     *
     * @throws ApiException on non-2xx response
     * @return mixed
     */
    public function getAffiliateCampaigns()
    {
        $key = self::$API_KEY;
        list($response) = $this->getAffiliateCampaignsWithHttpInfo($key);
        return $response;
    }

    /**
     * Operation affiliatesCampaignsListWithHttpInfo
     *
     * @param string $key Affiliate API key (required)
     * @throws ApiException on non-2xx response
     * @return array of response, HTTP status code, HTTP response headers (array of strings)
     */
    public function getAffiliateCampaignsWithHttpInfo($key)
    {
        // verify the required parameter 'key' is set
        if ($key === null) {
            throw new \InvalidArgumentException('Missing the required parameter $key when calling affiliatesCampaignsList');
        }
        // parse inputs
        $resourcePath = "/affiliates/campaigns";
        $httpBody = '';
        $queryParams = [];
        $headerParams = [];
        $formParams = [];
        $_header_accept = $this->selectHeaderAccept(['application/json', 'text/csv']);
        if (!is_null($_header_accept)) {
            $headerParams['Accept'] = $_header_accept;
        }
        $headerParams['Content-Type'] = $this->selectHeaderContentType(['application/json']);

        // query params
        if ($key !== null) {
            $queryParams['key'] = $this->toQueryValue($key);
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            $httpBody = $_tempBody; // $_tempBody is the method argument, if present
        } elseif (count($formParams) > 0) {
            $httpBody = $formParams; // for HTTP post (form)
        }
        // make the API Call
        try {
            return $this->callApi(
                $resourcePath,
                'GET',
                $queryParams,
                $httpBody,
                $headerParams
            );
            
        } catch (ApiException $e) {
            //your custom error-handling

            throw $e;
        }
    }

    /**
     * Operation affiliatesCampaignsRead
     *
     * @param string $campaign_id  (required)
     * @throws ApiException on non-2xx response
     * @return mixed
     */
    public function getCampaign($campaign_id)
    {
        $key = self::$API_KEY;
        list($response) = $this->getCampaignWithHttpInfo($campaign_id, $key);
        return $response;
    }

    /**
     * Operation affiliatesCampaignsReadWithHttpInfo
     *
     * @param string $campaign_id  (required)
     * @param string $key Affiliate API key (required)
     * @throws ApiException on non-2xx response
     * @return mixed
     */
    public function getCampaignWithHttpInfo($campaign_id, $key)
    {
        // verify the required parameter 'campaign_id' is set
        if ($campaign_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $campaign_id when calling affiliatesCampaignsRead');
        }
        // verify the required parameter 'key' is set
        if ($key === null) {
            throw new \InvalidArgumentException('Missing the required parameter $key when calling affiliatesCampaignsRead');
        }
        // parse inputs
        $resourcePath = "/affiliates/campaigns/{campaign_id}";
        $httpBody = '';
        $queryParams = [];
        $headerParams = [];
        $formParams = [];
        $_header_accept = $this->selectHeaderAccept(['application/json', 'text/csv']);
        if (!is_null($_header_accept)) {
            $headerParams['Accept'] = $_header_accept;
        }
        $headerParams['Content-Type'] = $this->selectHeaderContentType(['application/json']);

        // query params
        if ($key !== null) {
            $queryParams['key'] = $this->toQueryValue($key);
        }
        // path params
        if ($campaign_id !== null) {
            $resourcePath = str_replace(
                "{" . "campaign_id" . "}",
                $this->toPathValue($campaign_id),
                $resourcePath
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            $httpBody = $_tempBody; // $_tempBody is the method argument, if present
        } elseif (count($formParams) > 0) {
            $httpBody = $formParams; // for HTTP post (form)
        }
        // make the API Call
        try {
            return $this->callApi(
                $resourcePath,
                'GET',
                $queryParams,
                $httpBody,
                $headerParams
            );
        } catch (ApiException $e) {
            //your custom error-handling

            throw $e;
        }
    }
    
    /// Helper functions

    /**
     * Make the HTTP call (Sync)
     *
     * @param string $resourcePath path to method endpoint
     * @param string $method       method to call
     * @param array  $queryParams  parameters to be place in query URL
     * @param array  $postData     parameters to be placed in POST body
     * @param array  $headerParams parameters to be place in request header
     * @param string $responseType expected response type of the endpoint
     *
     * @throws ApiException on a non 2xx response
     * @return mixed
     */
    public function callApi($resourcePath, $method, $queryParams, $postData, $headerParams, $responseType = null)
    {
        $headers = [];

        foreach ($headerParams as $key => $val) {
            $headers[] = "$key: $val";
        }

        // form data
        if ($postData and in_array('Content-Type: application/x-www-form-urlencoded', $headers, true)) {
            $postData = http_build_query($postData);
        }
        // json model
        elseif ( ( is_object( $postData ) or is_array( $postData ) ) and !in_array( 'Content-Type: multipart/form-data', $headers, true ) ) {
            $postData = json_encode( $postData );
        }

        $url = "https://" . self::$BASE_URL . "/api/v1" . $resourcePath;

        $curl = curl_init();

        // return the result on success, rather than just true
        \curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true );

        \curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        var_dump($headers);
        if ( !empty( $queryParams ) ) {
            $url = ( $url . '?' . \http_build_query( $queryParams ) );
        }

        // handle method. default is GET
        switch($method) {
            case self::$GET:
                // Do nothing. This is the default
                break;
            case self::$POST:
                \curl_setopt( $curl, CURLOPT_POST, true );
                \curl_setopt( $curl, CURLOPT_POSTFIELDS, $postData );
                break;
            case self::$PUT:
                \curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
                \curl_setopt($curl, CURLOPT_POSTFIELDS, $postData);
                break;
            case self::$DELETE:
                \curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
                \curl_setopt($curl, CURLOPT_POSTFIELDS, $postData);
                break;
            default:
                throw new ApiException( 'Method ' . $method . ' is not recognized.' );
                break;
        }

        \curl_setopt( $curl, CURLOPT_URL, $url );
        var_dump($url);
        if( isset( $this->user_agent ) ) {
            // Set user agent
            \curl_setopt( $curl, CURLOPT_USERAGENT, $this->user_agent );
        }
        
        \curl_setopt( $curl, CURLOPT_VERBOSE, 0 ); //set to 1 for debugging

        // obtain the HTTP response headers
        \curl_setopt( $curl, CURLOPT_HEADER, 1 );
        //work-around to fix CA issue. For ref: https://curl.se/libcurl/c/CURLOPT_SSL_VERIFYPEER.html
        \curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        // Make the request
        $response = curl_exec( $curl );
        $http_header_size = curl_getinfo( $curl, CURLINFO_HEADER_SIZE );
        $http_header = $this->httpParseHeaders( substr( $response, 0, $http_header_size ) );
        $http_body = substr( $response, $http_header_size );
        $response_info = curl_getinfo( $curl );

        // Handle the response
        if ( $response_info['http_code'] === 0 ) {
            // curl_exec can sometimes fail but still return a blank message from curl_error().
            if ( !empty( $curl_error_message ) ) {
                $error_message = "API call to $url failed: $curl_error_message";
            } else {
                $error_message = "API call to $url failed, but for an unknown reason. " .
                    "This could happen if you are disconnected from the network.";
            }

            $exception = new ApiException( $error_message, 0, null, null );
            $exception->setResponseObject( $response_info );
            throw $exception;
        } elseif ( $response_info['http_code'] >= 200 && $response_info['http_code'] <= 299 ) {
            // return raw body if response is a file
            if ( $responseType === '\SplFileObject' || $responseType === 'string' ) {
                return [$http_body, $response_info['http_code'], $http_header];
            }

            $data = \json_decode( $http_body );
            if ( \json_last_error() > 0 ) { // if response is a string
                $data = $http_body;
            }
        } else {
            $data = \json_decode($http_body);
            if($data == null) {
                $data = $http_body;
            }
            if ( \json_last_error() > 0 ) { // if response is a string
                $data = $http_body;
            }

            throw new ApiException(
                "[".$response_info['http_code']."] Error connecting to the API ($url)",
                $response_info['http_code'],
                $http_header,
                $data
            );
        }
        return [$data, $response_info['http_code'], $http_header];
    }

    /**
     * Return the header 'Accept' based on an array of Accept provided
     *
     * @param string[] $accept Array of header
     *
     * @return string Accept (e.g. application/json)
     */
    public function selectHeaderAccept($accept)
    {
        if ( count( $accept ) === 0 or ( count( $accept ) === 1 and $accept[0] === '') ) {
            return null;
        } elseif ( preg_grep("/application\/json/i", $accept ) ) {
            return 'application/json';
        } else {
            return implode( ',', $accept );
        }
    }

    public function selectHeaderContentType($content_type)
    {
        if (count($content_type) === 0 or (count($content_type) === 1 and $content_type[0] === '')) {
            return 'application/json';
        } elseif (preg_grep("/application\/json/i", $content_type)) {
            return 'application/json';
        } else {
            return implode(',', $content_type);
        }
    }

    protected function httpParseHeaders($raw_headers)
    {
        
        $headers = [];
        $key = '';

        foreach (explode("\n", $raw_headers) as $h) {
            $h = explode(':', $h, 2);

            if (isset($h[1])) {
                if (!isset($headers[$h[0]])) {
                    $headers[$h[0]] = trim($h[1]);
                } elseif (is_array($headers[$h[0]])) {
                    $headers[$h[0]] = array_merge($headers[$h[0]], [trim($h[1])]);
                } else {
                    $headers[$h[0]] = array_merge([$headers[$h[0]]], [trim($h[1])]);
                }

                $key = $h[0];
            } else {
                if (substr($h[0], 0, 1) === "\t") {
                    $headers[$key] .= "\r\n\t".trim($h[0]);
                } elseif (!$key) {
                    $headers[0] = trim($h[0]);
                }
                trim($h[0]);
            }
        }

        return $headers;
    }

    public function toQueryValue($object)
    {
        if (is_array($object)) {
            return implode(',', $object);
        } else {
            return $this->toString($object);
        }
    }

    public function toString($value)
    {
        if ($value instanceof \DateTime) { // datetime in ISO8601 format
            return $value->format(\DateTime::ATOM);
        } else {
            return $value;
        }
    }

    public function toPathValue($value)
    {
        return rawurlencode($this->toString($value));
    }
    
}
