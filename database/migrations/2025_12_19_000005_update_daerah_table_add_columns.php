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
        Schema::table('daerah', function (Blueprint $table) {
            if (!Schema::hasColumn('daerah', 'nama_daerah')) {
                $table->string('nama_daerah')->after('id');
            }
            if (!Schema::hasColumn('daerah', 'provinsi')) {
                $table->string('provinsi')->after('nama_daerah');
            }
            if (!Schema::hasColumn('daerah', 'created_at')) {
                $table->timestamps();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('daerah', function (Blueprint $table) {
            $table->dropColumn(['nama_daerah', 'provinsi']);
            $table->dropTimestamps();
        });
    }
};
