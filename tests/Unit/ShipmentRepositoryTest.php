<?php

namespace Tests\Unit;

use App\Enums\ShipmentStatus;
use App\Models\Shipment;
use App\Repositories\Shipment\ShipmentReadRepository;
use App\Repositories\Shipment\ShipmentWriteRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShipmentRepositoryTest extends TestCase
{
    use RefreshDatabase;

    protected ShipmentReadRepository $readRepo;
    protected ShipmentWriteRepository $writeRepo;

    protected function setUp(): void
    {
        parent::setUp();

        $this->readRepo = new ShipmentReadRepository(new Shipment());
        $this->writeRepo = new ShipmentWriteRepository(new Shipment());
    }

    public function test_add_creates_new_shipment()
    {
        $data = [
            'customer_name' => 'Ali Veli',
            'address' => 'Test Address',
            'country' => 'Turkey',
            'weight' => 2.5,
            'dimensions' => json_encode(['width' => 10, 'length' => 20, 'height' => 5]),
            'shipping_company' => 'DHL',
            'tracking_number' => 'TR123456',
            'status' => ShipmentStatus::PENDING
        ];

        $shipment = $this->writeRepo->add($data);

        $this->assertDatabaseHas('shipments', ['id' => $shipment->id, 'customer_name' => 'Ali Veli']);
        $this->assertEquals('DHL', $shipment->shipping_company);
    }

    public function test_find_returns_model_or_null()
    {
        $shipment = Shipment::factory()->create();

        $found = $this->readRepo->find($shipment->id);
        $this->assertNotNull($found);
        $this->assertEquals($shipment->id, $found->id);

        $notFound = $this->readRepo->find(99999);
        $this->assertNull($notFound);
    }

    public function test_update_changes_model_attributes()
    {
        $shipment = Shipment::factory()->create(['customer_name' => 'Old Name']);

        $updated = $this->writeRepo->update($shipment, ['customer_name' => 'New Name']);
        $this->assertEquals('New Name', $updated->customer_name);
        $this->assertDatabaseHas('shipments', ['id' => $shipment->id, 'customer_name' => 'New Name']);
    }

    public function test_delete_removes_model()
    {
        $shipment = Shipment::factory()->create();

        $result = $this->writeRepo->delete($shipment);
        $this->assertTrue($result);
        $this->assertDatabaseMissing('shipments', ['id' => $shipment->id]);
    }
}
