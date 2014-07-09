<?php
    require_once 'classes/RateLookup.php';
    $deliveryType = $_REQUEST['deliveryType'];
    $category = $_REQUEST['category'];
    //now get the calculating mechanism for this
    $rateLookupObj = RateLookUp::getRateLookupForThisCategoryAndDeliveryType($category,$deliveryType);
    echo $rateLookupObj->calculating_mechanism;
?>