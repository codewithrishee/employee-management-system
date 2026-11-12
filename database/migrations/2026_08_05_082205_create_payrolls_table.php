<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
{
    Schema::create('payrolls', function (Blueprint $table) {

        $table->id();

        $table->foreignId('employee_id')
              ->constrained()
              ->cascadeOnDelete();

        $table->string('month');

        $table->decimal('basic_salary',10,2);

        $table->decimal('bonus',10,2)->default(0);

        $table->decimal('deduction',10,2)->default(0);

        $table->decimal('net_salary',10,2);

        $table->enum('payment_status',[
            'Pending',
            'Paid'
        ])->default('Pending');

        $table->date('payment_date')->nullable();

        $table->timestamps();

    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payrolls');
    }
};
