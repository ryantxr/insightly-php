<?php
require 'Insightly.php';

function run_tests($apikey){
  $insightly = new Insightly($apikey);
  $insightly->test();
}

run_tests($argv[1]);
?>