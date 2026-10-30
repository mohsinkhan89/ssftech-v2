<?php

namespace Tests\Feature;

use App\Models\Service;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ServiceCatalogueTest extends TestCase
{
    use RefreshDatabase;

    public function test_expanded_catalogue_is_available_in_homepage_and_enquiry_form(): void
    {
        $this->assertSame(7, Service::where('category', 'development')->count());
        $this->assertSame(7, Service::where('category', 'crm')->count());
        $this->assertSame(8, Service::where('category', 'erp')->count());
        $this->assertSame(12, Service::where('category', 'marketing')->count());

        foreach (Service::all() as $service) {
            $this->assertFileExists(public_path($service->cardImagePath()));
        }

        $response = $this->get('/');
        $response->assertOk()
            ->assertSee('id="service-tab-crm"', false)
            ->assertSee('id="service-tab-erp"', false)
            ->assertSee('id="service-tab-marketing"', false)
            ->assertSee('<optgroup label="CRM Solutions">', false)
            ->assertSee('UI/UX Design')
            ->assertSee('Mobile App Development')
            ->assertSee('Custom CRM Development')
            ->assertSee('Inventory &amp; Warehouse System Development', false)
            ->assertSee('Search Engine Optimisation (SEO)');
    }

    public function test_disabled_services_are_removed_from_cards_and_enquiry_options(): void
    {
        Service::where('title', 'Custom CRM Development')->update(['status' => false]);

        $this->get('/')->assertOk()->assertDontSee('Custom CRM Development');
    }
}
