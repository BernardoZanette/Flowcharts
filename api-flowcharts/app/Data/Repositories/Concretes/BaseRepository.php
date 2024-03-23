<?php

namespace App\Data\Repositories\Concretes;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\DatabaseManager;

class BaseRepository {
    
    protected $table = null;
    private $connection;
    protected $excludedFields = [];

    public function __construct(DatabaseManager $databaseManager) {

        $this->connection = $databaseManager->connection();
    }

    protected function getBuilder(string $table = null): Builder {

        $table = $table ?? $this->table;
        $query = $this->connection->table($table);
        $query->select("$table.*");
        return $query;
    }

    protected function mapModelToArray(Model $model): array {

        $row = [];
        foreach ($model->toArray() as $key => $value) {
            if (in_array($key, $this->excludedFields)) {
                continue;
            };

            $row[Str::snake($key)] = $value;
        }
        return $row;
    }

    protected function getIdsFromCollection(Collection $childrenIds): array {
        
        $ids = [];
        foreach($childrenIds as $childrenId) {
            $ids[] = $childrenId->step_id;
        }
        return $ids;
    }

}