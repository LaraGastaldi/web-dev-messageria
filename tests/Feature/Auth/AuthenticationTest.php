<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Livewire\Volt\Volt;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_screen_can_be_rendered(): void
    {
        $response = $this->get('/login');

        $response
            ->assertOk()
            ->assertSeeVolt('pages.auth.login');
    }

    public function test_can_login()
    {
        $user = User::factory()->create([
            'email' => 'test@test.com',
            'password' => bcrypt('password'),
            'username' => 'test',
            'name' => 'Test User',
        ]);

        $component = Volt::test('pages.auth.login')
            ->set('form.email', 'test@test.com')
            ->set('form.password', 'password')
            ->call('login');
        $component->assertHasNoErrors();
        $component->assertRedirect(route('messages'));
        $this->assertAuthenticatedAs($user);
    }

    public function test_can_register()
    {
        $component = Volt::test('pages.auth.register')
            ->set('name', 'Test User')
            ->set('email', 'test@test.com')
            ->set('username', 'test')
            ->set('password', 'password')
            ->set('password_confirmation', 'password')
            ->call('register');
        $component->assertHasNoErrors();
        $component->assertRedirect(route('messages'));
        $this->assertDatabaseHas('users', [
            'email' => 'test@test.com',
            'username' => 'test',
            'name' => 'Test User',
        ]);
        $user = User::where('email', 'test@test.com')->first();
        $this->assertTrue(
            Hash::check('password', $user->password), 
            'Password should be hashed'
        );
        $this->assertAuthenticated();
        $this->assertAuthenticatedAs($user);
    }
}
