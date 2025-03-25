<?php

namespace Ludovicdevio\UX\DataTables\Tests\Model;

use Ludovicdevio\UX\DataTables\Model\DataTable;
use PHPUnit\Framework\TestCase;

class DataTableTest extends TestCase
{
    public function testDataTable(): void
    {
        $table = new DataTable('tableId');

        $table
            ->autoWidth(true)
            ->caption('Table caption')
            ->deferRender(true)
            ->info(true)
            ->lengthChange(true)
            ->ordering(true)
            ->paging(true)
            ->processing(true)
            ->scrollX(true)
            ->scrollY('200px')
            ->searching(true)
            ->serverSide(true)
            ->stateSave(true);

        $this->assertEquals('tableId', $table->getId());
    }
}
