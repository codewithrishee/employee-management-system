<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
{
    Schema::create('employees', function (Blueprint $table) {
        $table->id();

        $table->string('employee_id')->unique();

        $table->foreignId('department_id')
              ->constrained()
              ->cascadeOnDelete();

        $table->string('name');
        $table->string('email')->unique();
        $table->string('phone');

        $table->string('designation');

        $table->decimal('salary', 10, 2);

        $table->date('joining_date');

        $table->enum('gender', ['Male', 'Female', 'Other']);

        $table->date('date_of_birth')->nullable();

        $table->text('address')->nullable();

        $table->string('image')->nullable();

        $table->boolean('status')->default(1);

        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
