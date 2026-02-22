<?php

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
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('borrower_id')->constrained('users');
            $table->foreignId('tool_id')->constrained('tools');
            $table->foreignId('approved_by')->nullable()->constrained('users')->onDelete('set Null');
            $table->enum('approve_type',['admin', 'officer'])->nullable();
            $table->enum('status',['pending', 'borrow', 'return'])->default('pending');
            $table->integer('qty')->default(1);
            $table->integer('penalty')->default(0);
            $table->date('due_date');
            $table->date('return_date')->nullable();
            $table->date('loan_date');
            $table->timestamp('request_return_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};


