<?php



namespace Ludovicdevio\UX\DataTables\Builder;

use Symfony\Component\HttpFoundation\JsonResponse;

interface DataTableResponseBuilderInterface
{
    public function buildResponse(int $draw = 1, array $data = [], ?int $recordsTotal = null, ?int $recordsFiltered = null): JsonResponse;
}
