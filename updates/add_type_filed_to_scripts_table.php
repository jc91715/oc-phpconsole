<?php namespace RV\PhpConsole\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class AddTypeFiledToScriptsTable extends Migration
{
    public function up()
    {
        Schema::table('rv_phpconsole_scripts', function(Blueprint $table) {
            $table->string('type')->default('');
        });
    }

    public function down()
    {

    }
}
