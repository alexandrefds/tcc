<?php

namespace Tests\Unit;

use App\Models\Property;
use App\Repositories\Contracts\PropertyRepositoryContract;
use App\Services\PropertyService;
use Mockery;
use Tests\TestCase;

class PropertyServiceTest extends TestCase
{
    private PropertyRepositoryContract $propertyRepository;

    private $service;

    public function setUp(): void
    {
        parent::setUp();
        $this->propertyRepository = Mockery::mock(PropertyRepositoryContract::class);

        $this->service = new PropertyService($this->propertyRepository);
    }

    public function test_can_create_property()
    {
        $data = Property::factory()->create();
        $dataArray = $data->toArray();

        $this->propertyRepository
            ->shouldReceive('store')
            ->with($dataArray)
            ->once()
            ->andReturn($data);

        $result = $this->service->createProperty($dataArray);

        $this->assertEquals($dataArray, $result);
    }

    public function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
