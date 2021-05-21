<?php
    include 'AffiliateApi.php';
    $affAPI = new AffiliateApi();

    // set values for testing
    $creative_id = '';
    $asset_id = '';
    $offer_id = '1b4e7482-b62c-40e5-9a44-3b66f721176d';
    $campaign_id = '54a07636-0ea0-4b17-b869-c2e9d1dbbddd';
    

    function test_getAffiliateReports() {
        global $affAPI;
        $start = new DateTime();
        $start->modify("-45 days");
        $result = $affAPI->getAffiliateReportsWithHttpInfo("8c4da671-18d3-46fa-a049-d90aef43cd61", "sales", $start, new DateTime());
        print("<pre>".print_r($result,true)."</pre>");
    }

    function test_getAffiliateCampaigns() {
        global $affAPI;
        $result = $affAPI->getAffiliateCampaigns();
        print("<pre>".print_r($result,true)."</pre>");
    }
    
    function test_getCampaign() {
        global $campaign_id, $affAPI;
        $result = $affAPI->getCampaign($campaign_id);
        print("<pre>".print_r($result,true)."</pre>");
    }

    function test_getCampaignCreatives() {
        global $campaign_id, $affAPI;
        $result = $affAPI->getCampaignCreatives($campaign_id);
        print("<pre>".print_r($result,true)."</pre>");
    }

    function test_getCampaignCreative() {
        global $campaign_id, $affAPI, $creative_id;
        $preview = 'http';
        $result = $affAPI->getCampaignCreative($campaign_id, $creative_id, $preview);
        print("<pre>".print_r($result,true)."</pre>");
    }

    function test_getAssetsForCreative() {
        global $campaign_id, $affAPI, $creative_id;
        $result = $affAPI->getAssetsForCreative($campaign_id, $creative_id);
        echo $result;
    }

    function test_getZippedAffiliatesCampaignsAssets() {
        global $campaign_id, $affAPI;

        $result = $affAPI->getZippedAffiliatesCampaignsAssets($campaign_id);

        $fname = "testzip.zip";
        $fp = fopen($fname, 'w');
        fwrite($fp, $result);
        fclose($fp);
    
        header('Content-type: application/zip');
        header("Content-Disposition: attachment; filename=$fname");
        readfile($fname);
    }

    function test_getAssetPreview() {
        global $campaign_id, $affAPI, $creative_id, $asset_id;
        $result = $affAPI->getAssetPreview($campaign_id, $creative_id, $asset_id);

        header('Content-type: image/jpeg');
        echo $result;
    }
    
    /**
    * for testing, supply the variables:  
    * $key = 'your key here';
    * $brand_domain = 'your brand domain here';
    * $creative_id = '';
    * $asset_id = '';
    * $offer_id = '';
    * $campaign_id = '';
    * then call any of the above functions, one at a time
    */
    test_getAffiliateReports();
    
?>