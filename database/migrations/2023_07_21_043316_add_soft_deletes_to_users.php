<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */

    // usersテーブルにdeleted_atカラムを追加。
    // SoftDeletes()も追加することで、deleteしても論理削除になる。
    // データ自体は削除はされず、deleted_atに時刻が追加される。
    // 続きはUserモデル参照。
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropColumn('deleted_at');
        });
    }
};
