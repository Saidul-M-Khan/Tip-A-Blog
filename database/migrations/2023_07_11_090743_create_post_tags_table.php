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
        Schema::create('post_tags', function (Blueprint $table) {
            $table->unsignedBigInteger( 'post_id' );
            $table->unsignedBigInteger( 'tag_id' );
            $table->timestamp( 'created_at' )->useCurrent();
            $table->timestamp( 'updated_at' )->useCurrent()->useCurrentOnUpdate();

            $table->foreign( 'post_id' )
                ->references( 'id' )->on( 'posts' )
                ->restrictOnDelete()
                ->cascadeOnUpdate();

            $table->foreign( 'tag_id' )
                ->references( 'id' )->on( 'tags' )
                ->restrictOnDelete()
                ->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_tags');
    }
};
