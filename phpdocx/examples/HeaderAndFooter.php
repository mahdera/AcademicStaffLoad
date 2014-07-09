<?php

/**
 * @author 2mdc.com
 * @version 
 */
/**
 * $arrParamsHeader
 *   'name' (image path): '../files/image.jpg'
 */
/**
 * $arrParamsFooter
 *   'pager' (pager): 'true'
 *   'pagerAlignment' (pager alignment): 'left', 'center', 'right'
 */
require_once('../classes/cCreateDocx.inc');

$objDocx = new cCreateDocx();

$objDocx->fAddHeader('Header');

$arrParamsFooter = array(
    'pager' => 'true',
    'pagerAlignment' => 'center'
);

$objDocx->fAddFooter('', $arrParamsFooter);
$objDocx->fCreateDocx('example_header_and_footer.docx');
?>