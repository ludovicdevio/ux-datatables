<?php

namespace Ludovicdevio\UX\DataTables\Tests;

use PHPUnit\Framework\TestCase;
use Ludovicdevio\UX\DataTables\Tests\Kernel\TwigAppKernel;

class DataTablesBundleTest extends TestCase
{
    public function testBootKernel()
    {
        $kernel = new TwigAppKernel('test', true);

        $kernel->boot();

        $this->assertArrayHasKey('DataTablesBundle', $kernel->getBundles());

        $kernel->shutdown();
    }
}
