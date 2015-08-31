<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Contracts\Search;
use Illuminate\Support\Facades\DB;

class AlgoliaIndexer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'search:index {table}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Index a table for search.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(Search $search)
    {
        $table = $this->argument('table');

        $collection = collect(
            DB::table($table)->get()
        )->map( function($item) {
            $item->objectID = $item->id;

            return (array) $item;
        });

        // save to algolia
        $search->index($table)->saveObjects($collection);

        // completion message
        $this->info('All Done!');
    }
}
