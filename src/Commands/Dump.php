<?php

namespace Liwe\Tools\Commands;

use Illuminate\Console\Command;

class Dump extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'liwe-tools:dump {model : Example App\Models\User}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Dump data from a model to a file in database/seeders/json';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $model = $this->argument('model');

        $table = (new $model)->getTable();

        if (method_exists($model, "dump")) {
            $all = $model::dump();
        } else {
            $all = $model::all()->each(
                fn ($instance) =>
                $instance->setAppends([])->makeHidden(["created_at", "updated_at"])
            );
        }


        $json = $all->toJson(JSON_PRETTY_PRINT);

        $output = database_path("seeders/json/$table.json");

        file_put_contents($output, $json);

        $this->info("Dumped data from $model to $output");
    }
}