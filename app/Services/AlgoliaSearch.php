<?php
namespace App\Services;

use AlgoliaSearch\Client;
use App\Contracts\Search;

class AlgoliaSearch implements Search {
    
    protected $client;

    protected $index;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function index($index)
    {
        return $this->index = $this->client->initIndex($index);
    }

    public function get($query)
    {
        return $this->index->search($query)['hits'];
    }
}