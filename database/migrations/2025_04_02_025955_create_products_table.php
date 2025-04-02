<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products',function(Blueprint $table){
            $table->id();
            $table->string('title',2000);
            $table->string('slug',2000);
            $table->string('description')->nullable();
            $table->foreignId('department_id')->index()->constrained('departments');
            $table->foreignId('category_id')->index()->constrained('categories');
            $table->decimal('price',20,4);
            $table->string('status')->nullable();;
            $table->integer('quantity')->default(0);
            $table->foreignIdFor(User::class,'created_by');
            $table->foreignIdFor(User::class,'updated_by');
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
