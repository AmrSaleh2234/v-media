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

        Schema::create('currencies', function (Blueprint $table) {
            $table->id('id');
            $table->string('code',50)->unique();
            $table->mediumText('name');
            $table->integer('order_id')->default(1);
            $table->tinyInteger('active')->default(1);
            $table->timestamps();
        });

        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('iso3',3)->nullable();
            $table->string('numeric_code',3)->nullable();
            $table->string('iso2',2)->nullable();
            $table->string('phonecode')->nullable();
            $table->string('capital')->nullable();
            $table->string('currency')->nullable();
            $table->string('currency_name')->nullable();
            $table->string('currency_symbol')->nullable();
            $table->string('tld')->nullable();
            $table->string('native')->nullable();
            $table->string('region')->nullable();
            $table->string('subregion')->nullable();
            $table->text('timezones')->nullable();
            $table->text('translations')->nullable();
            $table->decimal('latitude',10,8)->nullable();
            $table->decimal('longitude',10,8)->nullable();
            $table->string('emoji')->nullable();
            $table->string('emojiU')->nullable();
            $table->boolean('flag')->nullable();
            $table->string('wikiDataId')->nullable();
            $table->timestamps();
        });

        Schema::create('states', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('country_id');
            $table->string('country_code',2);
            $table->string('fips_code')->nullable();
            $table->string('iso2')->nullable();
            $table->string('type')->nullable();
            $table->decimal('latitude',10,8)->nullable();
            $table->decimal('longitude',10,8)->nullable();
            $table->boolean('flag')->nullable();
            $table->string('wikiDataId')->nullable();
            $table->timestamps();
            $table->foreign('country_id')->references('id')->on('countries')->onUpdate('cascade')->onUpdate('cascade')->onDelete('cascade');

        });

        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('state_id');
            $table->string('state_code');
            $table->unsignedBigInteger('country_id');
            $table->string('country_code',2);
            $table->decimal('latitude',10,8)->nullable();
            $table->decimal('longitude',10,8)->nullable();
            $table->boolean('flag')->nullable();
            $table->string('wikiDataId')->nullable();
            $table->timestamps();
            $table->foreign('state_id')->references('id')->on('states')->onUpdate('cascade')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('country_id')->references('id')->on('countries')->onUpdate('cascade')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('currencies');
        Schema::dropIfExists('countries');
        Schema::dropIfExists('states');
        Schema::dropIfExists('cities');
    }
};
