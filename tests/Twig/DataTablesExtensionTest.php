<?php

namespace Ludovicdevio\UX\DataTables\Tests\Twig;

use Ludovicdevio\UX\DataTables\Model\Column;
use PHPUnit\Framework\TestCase;
use Ludovicdevio\UX\DataTables\Builder\DataTableBuilderInterface;
use Ludovicdevio\UX\DataTables\Tests\Kernel\TwigAppKernel;

class DataTablesExtensionTest extends TestCase
{
    public function testRenderDataTable(): void
    {
        $kernel = new TwigAppKernel('test', true);
        $kernel->boot();
        $container = $kernel->getContainer()->get('test.service_container');

        /** @var DataTableBuilderInterface $builder */
        $builder = $container->get('test.datatables.builder');

        $table = $builder->createDataTable('table');

        $table->columns([
            Column::new(name: 'firstColumn', title: 'Column 1'),
            Column::new(name: 'firstColumn', title: 'Column 2'),
        ]);

        $table->data([
            ['Row 1 Column 1', 'Row 1 Column 2'],
            ['Row 2 Column 1', 'Row 2 Column 2'],
        ],);

        $rendered = $container->get('test.datatables.twig_extension')->renderDataTable(
            $table,
            ['data-controller' => 'mycontroller', 'class' => 'myclass']
        );

        $this->assertSame(
            expected: '<table id="table" data-controller="mycontroller Ludovicdevio--ux-datatables--datatable" data-Ludovicdevio--ux-datatables--datatable-view-value="{&quot;columns&quot;:[{&quot;name&quot;:&quot;firstColumn&quot;,&quot;orderable&quot;:true,&quot;searchable&quot;:true,&quot;type&quot;:&quot;string&quot;,&quot;title&quot;:&quot;Column 1&quot;,&quot;visible&quot;:true},{&quot;name&quot;:&quot;firstColumn&quot;,&quot;orderable&quot;:true,&quot;searchable&quot;:true,&quot;type&quot;:&quot;string&quot;,&quot;title&quot;:&quot;Column 2&quot;,&quot;visible&quot;:true}],&quot;data&quot;:[[&quot;Row 1 Column 1&quot;,&quot;Row 1 Column 2&quot;],[&quot;Row 2 Column 1&quot;,&quot;Row 2 Column 2&quot;]]}" class="myclass"></table>',
            actual: $rendered
        );
    }
}
