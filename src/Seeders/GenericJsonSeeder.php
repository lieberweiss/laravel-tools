<?php

namespace Liwe\Tools\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

abstract class GenericJsonSeeder extends Seeder
{
    protected $hasIdentity = true;
    protected $table;
    protected $model;

    function indentityInsert($enable)
    {
        if ($this->hasIdentity && DB::getConfig("driver") === "sqlsrv") {
            $value = $enable ? 'ON' : 'OFF';
            DB::unprepared("SET IDENTITY_INSERT $this->table $value");
        }
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->table = (new $this->model)->getTable();
        if (DB::getDriverName() === 'sqlite') {
            DB::unprepared("DELETE FROM $this->table");
        } else {
            DB::unprepared("TRUNCATE TABLE $this->table");
        }
        $path = database_path("seeders/json/{$this->table}.json");
        $json = file_get_contents($path);
        $rows = json_decode($json, true);
        $this->indentityInsert(true);
        foreach ($rows as $row) {
            $this->model::create($row);
        }
        $this->indentityInsert(false);
    }
}