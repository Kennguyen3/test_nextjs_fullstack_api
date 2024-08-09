<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoviesTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 */
	public function up() {
		Schema::create('movies', function (Blueprint $table) {
			$table->id();
			$table->string('title');
			$table->year('publish_year');
			$table->string('poster')->nullable();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 */
	public function down() {
		Schema::dropIfExists('movies');
	}
}
