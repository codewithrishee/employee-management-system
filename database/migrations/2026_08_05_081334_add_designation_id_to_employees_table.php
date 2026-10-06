<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up(): void
{
    Schema::table('employees', function (Blueprint $table) {

        $table->foreignId('designation_id')
              ->after('department_id')
              ->constrained()
              ->cascadeOnDelete();

        $table->dropColumn('designation');

    });
}

  public function down(): void
{
    Schema::table('employees', function (Blueprint $table) {

        $table->dropForeign(['designation_id']);

        $table->dropColumn('designation');

        $table->string('designation');

    });
}
};
