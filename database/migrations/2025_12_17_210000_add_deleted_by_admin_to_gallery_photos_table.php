<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('gallery_photos', function (Blueprint $table) {
            $table->integer('deleted_by_admin')->nullable();
            $table->text('deletion_reason')->nullable();
        });
    }

    public function down()
    {
        Schema::table('gallery_photos', function (Blueprint $table) {
            $table->dropColumn(['deleted_by_admin', 'deletion_reason']);
        });
    }
};
