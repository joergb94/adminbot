<?php

namespace Tests\Unit\invoices;

use Tests\TestCase;
use App\Models\InvoiceClient;

class InvoiceClientRegistersTest extends TestCase
{
    
    protected function setUp(): void
    {
        parent::setUp();
        
    }

    public function testGetAllInvoiceClients(): void
    {
        $invoiceClients = InvoiceClient::withAllRelations()->get();
        $this->assertTrue(true);
    }


    public function testGetAllInvoiceClient(): void
    {
        $invoiceClients = InvoiceClient::where('client_id',7)->withAllRelations()->get();
        dd($invoiceClients->count());
        $this->assertTrue(true);
    }
}
