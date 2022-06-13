<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Customer;
use App\Models\User;
use App\Providers\RouteServiceProvider;

class CustomerTest extends TestCase
{

    public function test_customer_form()
    {
        $customer_data = [
            'name' => 'Customer',
            'email' => 'customer@gmail.com',
            'phone_number' => '1100110011',
            'desired_budget' => '1000',
            'message' => 'My message'
        ];
        $response = $this->call('POST', route('customer.store'), $customer_data);
        $this->assertDatabaseHas('customers', ['email' => $customer_data['email']]);
    }

    public function test_customer_export_to_wp()
    {
        // Create User
        $user = User::factory()->create();
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);
        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);

        // Create Customer
        $customer_data = [
            'name' => 'Customer',
            'email' => 'customer@gmail.com',
            'phone_number' => '1100110011',
            'desired_budget' => '1000',
            'message' => 'My message'
        ];
        $response = $this->call('POST', route('customer.store'), $customer_data);
        $this->assertDatabaseHas('customers', ['email' => $customer_data['email']]);
        
        // Create WP User
        $customer_id = Customer::where('email', $customer_data['email'])->first()->id;
        $response = $this->call('POST', route('customer.create.wpuser'), ['id' => $customer_id]);

        $response->assertStatus(200);
    }
}
