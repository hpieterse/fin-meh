<?php

namespace Tests\Feature\app\Http\Controller;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\Concerns\ImpersonatesUsers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use Tests\TestCase;

class BudgetCategoryControllerIndexTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_it_should_return_current_users_categories()
    {
        // arrange
        $user = User::factory()
            ->hasBudgetCategories(3)
            ->create();

        // act
        $response = $this
            ->actingAs($user)
            ->get('/budget_category');

        // assert
        $response->assertViewIs('budget_category.index');
        $this->assertEquals(3, $response['budgetCategories']->count());
    }

    public function test_index_it_should_redirect_to_login_when_not_authenticated()
    {
        // arrange

        // act
        $response = $this
            ->get('/budget_category');

        // assert
        $response->assertRedirect('/login');
    }
}
