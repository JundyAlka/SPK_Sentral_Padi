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
        Schema::table('nilai_daerahs', function (Blueprint $table) {
            // Drop the old foreign key referencing 'daerahs'
            $table->dropForeign(['daerah_id']); // Laravel should guess 'nilai_daerahs_daerah_id_foreign'

            // Add new foreign key referencing 'daerah'
            $table->foreign('daerah_id')->references('id')->on('daerah')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('nilai_daerahs', function (Blueprint $table) {
            $table->dropForeign(['daerah_id']);
            $table->foreign('daerah_id')->references('id')->on('daerahs')->onDelete('cascade');
        });
    }
};
