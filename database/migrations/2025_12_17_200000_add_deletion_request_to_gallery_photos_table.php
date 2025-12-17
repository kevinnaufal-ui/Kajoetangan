<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('gallery_photos', function (Blueprint $table) {
            $table->boolean('deletion_requested')->default(false);
            $table->text('deletion_request_reason')->nullable();
        });
    }

    public function down()
    {
        Schema::table('gallery_photos', function (Blueprint $table) {
            $table->dropColumn(['deletion_requested', 'deletion_request_reason']);
        });
    }
};
