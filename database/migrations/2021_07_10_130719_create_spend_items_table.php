<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpendItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spend_items', function (Blueprint $table) {
            $table->id();
            $table->date("date");
            $table->text('description');
            $table->decimal('amount', $precision = 8, $scale = 2);
            $table->timestamps();

            $table->foreignId('spend_category_id')
                ->constrained('spend_categories')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spend_items');
    }
}
