<?php namespace RV\PhpConsole\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class AddRunFiledToScriptsTable extends Migration
{
    public function up()
    {
        Schema::table('rv_phpconsole_scripts', function(Blueprint $table) {
            $table->tinyInteger('if_run')->default(1);
        });
    }

    public function down()
    {
        Schema::table('rv_phpconsole_scripts', function(Blueprint $table) {
            $table->dropColumn('if_run');
        });
    }
}
