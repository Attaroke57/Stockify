<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttributesTables extends Migration
{
    public function up()
    {
        if (! Schema::hasTable('attributes')) {
            Schema::create('attributes', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('slug')->nullable()->unique();
                $table->timestamps();
            });
        }

        if (! Schema::hasTable('attribute_options')) {
            Schema::create('attribute_options', function (Blueprint $table) {
                $table->id();
                $table->foreignId('attribute_id')->constrained('attributes')->onDelete('cascade');
                $table->string('value');
                $table->timestamps();
            });
        }

        // Optional: products.attributes JSON column if you want to store values on products
        if (Schema::hasTable('products') && ! Schema::hasColumn('products', 'attributes')) {
            Schema::table('products', function (Blueprint $table) {
                $table->json('attributes')->nullable()->after('description');
            });
        }
    }

    public function down()
    {
        if (Schema::hasTable('attribute_options')) {
            Schema::dropIfExists('attribute_options');
        }
        if (Schema::hasTable('attributes')) {
            Schema::dropIfExists('attributes');
        }
        if (Schema::hasTable('products') && Schema::hasColumn('products', 'attributes')) {
            Schema::table('products', function (Blueprint $table) {
                $table->dropColumn('attributes');
            });
        }
    }
}
