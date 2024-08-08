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
        Schema::table('countries', function($table){

            $table->integer('status')->default(1)->after('currency');
        });

        Schema::table('states', function($table){

            $table->integer('status')->default(1)->after('country_id');
        });

        Schema::table('cities', function($table){

            $table->integer('status')->default(1)->after('isCapital');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('countries', function($table){

            $table->dropColumn('status');
        });

        Schema::table('states', function($table){

            $table->dropColumn('status');
        }); 

        Schema::table('cities', function($table){

            $table->dropColumn('status');
        });        
    }
};
