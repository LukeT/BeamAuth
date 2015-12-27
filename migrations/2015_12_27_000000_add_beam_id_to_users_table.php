<?php
namespace LukeT\BeamAuth\Migration;

use Flarum\Database\AbstractMigration;
use Illuminate\Database\Schema\Blueprint;

class AddBeamIDToUsersTable extends AbstractMigration
{
    public function up()
    {
        $this->schema->table('users', function (Blueprint $table) {
            $table->string('beam_id')->nullable();
        });
    }

    public function down()
    {
        $this->schema->table('users', function (Blueprint $table) {
            $table->dropColumn('beam_id');
        });
    }
}
