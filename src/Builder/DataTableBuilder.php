<?php



namespace Ludovicdevio\UX\DataTables\Builder;

use Ludovicdevio\UX\DataTables\Model\DataTable;

class DataTableBuilder implements DataTableBuilderInterface
{
    public function createDataTable(?string $id = null): DataTable
    {
        return new DataTable($id);
    }
}
