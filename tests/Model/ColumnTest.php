<?php

namespace Ludovicdevio\UX\DataTables\Tests\Model;

use Ludovicdevio\UX\DataTables\Model\Column;
use PHPUnit\Framework\TestCase;

class ColumnTest extends TestCase
{
    public function testColumnToArray(): void
    {
        $column = Column::new('name', 'Name')
            ->setClassName('text-center')
            ->setCellType('th')
            ->setOrderable(false)
            ->setSearchable(false)
            ->setWidth('100px');

        $expectedArray = [
            'name' => 'name',
            'title' => 'Name',
            'className' => 'text-center',
            'cellType' => 'th',
            'orderable' => false,
            'searchable' => false,
            'width' => '100px',
            'type' => 'string',
            'visible' => true,
        ];

        $this->assertEquals($expectedArray, $column->toArray());
    }
}
