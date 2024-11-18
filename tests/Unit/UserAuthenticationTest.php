<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class UserAuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function testUserCanRegister(){
        $response = $this->post('/register',[
            'name' => 'Tharun Kavindu',
            'email' => 'tharunKavindu@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123'
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('users', [
            'name' => 'Tharun Kavindu',
            'email' => 'tharunKavindu@example.com'
        ]);
    }

    public function testUserCanLogin()
    {
        $user = User::factory()->create([
        'email' => 'john@example.com',
        'password' => bcrypt('password'),
    ]);
        
        $this->actingAs($user);
        
        //Check if the user is authenticated
        $this->assertAuthenticatedAs($user);
    }
        
    
    public function testUserCannotLoginWithIncorrectCredentials(){
        $user = User::factory()->create([
            'email' => 'tharunKavindu@example.com',
            'password' => bcrypt('password123')
        ]);

        $response = $this->post('/login', [
            'email' => 'tharunKavindu@example.com',
            'password' => 'wrongpassword'
        ]);

        $response->assertStatus(302);
        $this->assertGuest();
    }
}
