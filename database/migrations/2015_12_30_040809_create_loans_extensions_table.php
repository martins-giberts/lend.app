<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoansExtensionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loans_extensions', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('loan_id');
			$table->decimal('interest', 2, 2);
			$table->date('pay_back_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('loans_extensions');
    }
}
