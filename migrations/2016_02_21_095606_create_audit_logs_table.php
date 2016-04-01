<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuditLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('audit_logs', function ( Blueprint $table ) {
            $table->increments('id');
            $table->string('application');
            $table->integer('user_id')->nullable();
            $table->string('owner_type');
            $table->integer('owner_id');
            $table->string('type');
            $table->text('old_value')->nullable();
            $table->text('new_value')->nullable();
            $table->timestamps('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('audit_logs');
    }
}
