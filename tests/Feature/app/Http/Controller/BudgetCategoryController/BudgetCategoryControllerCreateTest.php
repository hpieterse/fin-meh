<?php

namespace Tests\Feature\app\Http\Controller;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\Concerns\ImpersonatesUsers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use Tests\TestCase;

class BudgetCategoryControllerCreateTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_it_should_return_create_view()
    {
        // arrange
        $user = User::factory()
        ->create();

        // act
        $response = $this
        ->actingAs($user)
        ->get('/budget_category/create');

        // assert
        $response->assertViewIs('budget_category.create');
    }

    public function test_create_it_should_redirect_to_login_when_not_authenticated()
    {
        // arrange

        // act
        $response = $this
            ->get('/budget_category/create');

        // assert
        $response->assertRedirect('/login');
    }
}
