<?php
require_once("../lib/HighriseAPI.class.php");

if (count($argv) != 3)
	die("Usage: php categories.test.php [account-name] [access-token]\n");

$hr = new HighriseAPI();
$hr->debug = false;
$hr->setAccount($argv[1]);
$hr->setToken($argv[2]);

list_categories('deal', $hr->findAllDealCategories());
list_categories('task', $hr->findAllTaskCategories());

function list_categories($type, $categories) {
  echo "-----------------------\n";
  echo "Found " . sizeof($categories) . " $type categories\n";
  echo "-----------------------\n";

  $count = 1;
  foreach ($categories as $category)
  {
    echo "\n$count. ";
    print_r($category);
    echo $category->toXML();
    $count += 1;
  }
}
