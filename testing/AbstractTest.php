<?php

/*
 * Abstract class all tests should extend.
 */

namespace Programster\LeadDyno\Testing;

abstract class AbstractTest
{
    protected $m_passed = false;
    protected string $m_errorMessage = "";
    abstract public function getDescription() : string;
    abstract public function run();
    public function getPassed(): bool { return $this->m_passed; }


    public function runTest()
    {
        try
        {
            $this->run();
        }
        catch (Exception $ex)
        {
            $this->m_passed = false;
        }
    }


    public function getErrorMessage() : string { return $this->m_errorMessage; }
}