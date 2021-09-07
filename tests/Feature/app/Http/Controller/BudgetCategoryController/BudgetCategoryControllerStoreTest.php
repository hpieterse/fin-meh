<?php

namespace Tests\Feature\app\Http\Controller;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\Concerns\ImpersonatesUsers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use Tests\TestCase;

class BudgetCategoryControllerStoreTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function test_store_it_should_redirect_to_login_when_not_authenticated(){
        // arrange

        // act
        $response = $this
            ->post('/budget_category');

        // assert
        $response->assertRedirect('/login');
    }

    public function test_store_it_should_create_category_when_data_is_valid(){
        // arrange
        $user = User::factory()
        ->create();

        // act
        $response = $this
            ->actingAs($user)
            ->post('/budget_category',[
                'name' => 'test category'
            ]);

        // assert
        $this->assertDatabaseHas('budget_categories', [
            'name' => 'test category',
            'user_id' => $user->id,
        ]);
        $response->assertRedirect('/budget_category');
    }


    public function test_store_it_should_return_error_when_name_is_missing(){
        // arrange
        $user = User::factory()
        ->create();

        // act
        $response = $this
            ->actingAs($user)
            ->post('/budget_category',[
                'name' => null
            ]);

        // assert
        $response
            ->assertStatus(302);
        $response->assertSessionHasErrors(['name']);
    }

    public function test_store_it_should_return_error_when_name_is_too_long(){
        // arrange
        $user = User::factory()
        ->create();

        $testName = $this->faker->regexify('[A-Z0-9]{256}');
        
        // act
        $response = $this
            ->actingAs($user)
            ->post('/budget_category',[
                'name' => $testName,
            ]);

        // assert
        $response
            ->assertStatus(302);
        $response->assertSessionHasErrors(['name']);
    }

    public function test_store_it_should_return_error_when_name_is_not_unique(){
        // arrange
        $user = User::factory()
        ->hasBudgetCategories(1)
        ->create();

        $testName = $user->budgetCategories->first()->name;

        // act
        $response = $this
            ->actingAs($user)
            ->post('/budget_category',[
                'name' => $testName,
            ]);

        // assert
        $response
            ->assertStatus(302);
        $response->assertSessionHasErrors(['name']);
    }

    public function test_store_it_should_success_when_name_is_unique_for_user(){
        // arrange
        $user = User::factory()
        ->hasBudgetCategories(1)
        ->create();

        $otherUser = User::factory()
        ->hasBudgetCategories(1)
        ->create();

        $testName = $otherUser->budgetCategories->first()->name;

        // act
        $response = $this
            ->actingAs($user)
            ->post('/budget_category',[
                'name' => $testName,
            ]);

        // assert
        $this->assertDatabaseHas('budget_categories', [
            'name' => $testName,
            'user_id' => $user->id,
        ]);
        $response->assertRedirect('/budget_category');
    }    
}