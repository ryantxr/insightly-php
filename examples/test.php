<?php
require_once dirname(__DIR__) . '/vendor/autoload.php';
use \Ryantxr\Insightly\Client as Insightly;


class InsightlyTest {
    static function runTests($apikey) {
        $that = new InsightlyTest;
        $that->test1($apikey);
        $that->test2($apikey);
    }

    function test1($apikey) {
        $this->out(__METHOD__);
        $insightly = new Insightly($apikey);
    }

    function test2($apikey) {
        $insightly = new Insightly($apikey);
        $insightly->test();
    }

    function out($s) {
        echo $s . "\n";
    }
}
InsightlyTest::runTests($argv[1] ?? null);
