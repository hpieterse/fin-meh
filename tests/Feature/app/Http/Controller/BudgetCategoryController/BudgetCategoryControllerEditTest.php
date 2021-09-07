<?php

namespace Tests\Feature\app\Http\Controller;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\Concerns\ImpersonatesUsers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use Tests\TestCase;

class BudgetCategoryControllerEditTest extends TestCase
{
    use RefreshDatabase;

    public function test_edit_it_should_return_edit_view_with_category()
    {
        // arrange
        $user = User::factory()
            ->hasBudgetCategories(1)
            ->create();

        $category = $user->budgetCategories()->first();
        $url = "/budget_category/{$category->id}/edit";

        // act
        $response = $this
            ->actingAs($user)
            ->get($url);
 
        // assert
        $response->assertViewIs('budget_category.edit');
        $this->assertEquals($category->id, $response['budgetCategory']->id);
    }

    public function test_edit_it_should_return_forbidden_when_category_not_owned_by_user()
    {
        // arrange
        $user = User::factory()
            ->hasBudgetCategories(1)
            ->create();

        $otherUser = User::factory()
            ->hasBudgetCategories(1)
            ->create();

        $category = $otherUser->budgetCategories()->first();
        $url = "/budget_category/{$category->id}/edit";

        // act
        $response = $this
            ->actingAs($user)
            ->get($url);

        // assert
        $response->assertStatus(403);
    }

    public function test_edit_it_should_redirect_to_login_when_not_authenticated()
    {
        // arrange

        // act
        $response = $this
            ->get('/budget_category/create');

        // assert
        $response->assertRedirect('/login');
    }
}