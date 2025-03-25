<?php

namespace Ludovicdevio\UX\DataTables\Tests\Builder;

use Ludovicdevio\UX\DataTables\Builder\DataTableResponseBuilder;
use Symfony\Component\HttpFoundation\JsonResponse;
use PHPUnit\Framework\TestCase;

class DataTableResponseBuilderTest extends TestCase
{
    public function testBuildResponseWithDefaultValues(): void
    {
        $builder = new DataTableResponseBuilder();
        $response = $builder->buildResponse();

        $this->assertInstanceOf(JsonResponse::class, $response);
        $data = json_decode($response->getContent(), true);

        $this->assertEquals(1, $data['draw']);
        $this->assertEquals(0, $data['recordsTotal']);
        $this->assertEquals(0, $data['recordsFiltered']);
        $this->assertEquals([], $data['data']);
    }

    public function testBuildResponseWithData(): void
    {
        $builder = new DataTableResponseBuilder();
        $data = [
            ['id' => 1, 'name' => 'Item 1'],
            ['id' => 2, 'name' => 'Item 2']
        ];
        $response = $builder->buildResponse(2, $data);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $jsonData = json_decode($response->getContent(), true);

        $this->assertEquals(2, $jsonData['draw']);
        $this->assertEquals(2, $jsonData['recordsTotal']);
        $this->assertEquals(2, $jsonData['recordsFiltered']);
        $this->assertEquals($data, $jsonData['data']);
    }

    public function testBuildResponseWithCustomRecordCounts(): void
    {
        $builder = new DataTableResponseBuilder();
        $data = [['id' => 1, 'name' => 'Item 1']];
        $response = $builder->buildResponse(1, $data, 10, 5);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $jsonData = json_decode($response->getContent(), true);

        $this->assertEquals(1, $jsonData['draw']);
        $this->assertEquals(10, $jsonData['recordsTotal']);
        $this->assertEquals(5, $jsonData['recordsFiltered']);
        $this->assertEquals($data, $jsonData['data']);
    }
}
