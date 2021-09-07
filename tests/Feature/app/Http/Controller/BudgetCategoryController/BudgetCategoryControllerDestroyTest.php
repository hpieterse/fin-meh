<?php

namespace Tests\Feature\app\Http\Controller;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\Concerns\ImpersonatesUsers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use Tests\TestCase;

class BudgetCategoryControllerDestroyTest extends TestCase
{
    use RefreshDatabase;

    public function test_destroy_it_should_redirect_to_login_when_not_authenticated(){
        // arrange

        // act
        $response = $this
            ->put('/budget_category/1');

        // assert
        $response->assertRedirect('/login');
    }

    public function test_destroy_it_should_delete_the_category(){
        // arrange
        $user = User::factory()
        ->hasBudgetCategories(1)
        ->create();

        $id = $user->budgetCategories->first()->id;

        // act
        $response = $this
            ->actingAs($user)
            ->delete("/budget_category/{$id}");

        // assert
        $this->assertDatabaseMissing('budget_categories', [
            'id' => $id,
        ]);
        $response->assertRedirect('/budget_category');
    }

    public function test_destroy_it_should_return_forbidden_when_category_not_owned_by_user()
    {
        // arrange
        $user = User::factory()
            ->hasBudgetCategories(1)
            ->create();

        $otherUser = User::factory()
            ->hasBudgetCategories(1)
            ->create();

        $category = $otherUser->budgetCategories()->first();
        $url = "/budget_category/{$category->id}";

        // act
        $response = $this
            ->actingAs($user)
            ->delete($url);

        // assert
        $response->assertStatus(403);
    }
}