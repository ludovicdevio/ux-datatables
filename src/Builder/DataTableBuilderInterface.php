<?php



namespace Ludovicdevio\UX\DataTables\Builder;

use Ludovicdevio\UX\DataTables\Model\DataTable;

interface DataTableBuilderInterface
{
    public function createDataTable(?string $id = null): DataTable;
}
