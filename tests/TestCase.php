<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;


abstract class TestCase extends BaseTestCase
{
    public $seed = true;
    use RefreshDatabase;
}
