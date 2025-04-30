<?php

namespace Programster\LeadDyno\Testing;

use Programster\CoreLibs\Filesystem;

require_once(__DIR__ . '/../vendor/autoload.php');
require_once(__DIR__ . '/settings.php');


$tests = Filesystem::getDirContents(
    $dir = __DIR__ . '/tests',
    $recursive = true,
    $includePath = false,
    $onlyFiles = true
);


foreach ($tests as $testFilename)
{
    $testName = substr($testFilename, 0, -4);
    $testName = __NAMESPACE__ . "\\Tests\\" . $testName;

    /* @var $testToRun AbstractTest */
    $testToRun = new $testName();
    $testToRun->runTest();

    if ($testToRun->getPassed())
    {
        print $testName . ": \e[32mPASSED\e[0m" . PHP_EOL;
    }
    else
    {
        print $testName . ": \e[31mFAILED\e[0m - {$testToRun->getErrorMessage()}" . PHP_EOL;
    }
}