<?php

namespace App;

use Illuminate\Contracts\Database\Query\Builder as QueryBuilder;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait CanLoadRalationships
{
    public function loadRelationships(
        Model| EloquentBuilder | QueryBuilder | HasMany $for, ?array $relations = null
    ):Model| EloquentBuilder | QueryBuilder | HasMany{
        $relations = $relations ?? $this->relations ?? [];
        foreach ($relations as $relation) {
            $for->when($this->shouldIncludeRalation($relation), function ($q) use ($relation,$for) {
                return $for instanceof Model ? $for->load($relation) : $q->with($relation);
              });
        }
        return $for;
    }

    protected function shouldIncludeRalation(string $relation):bool{
        $include = request()->query('include');
        if(!$include){
            return false;
        }
      $relations = array_map('trim',explode(',', $include));

      return in_array($relation, $relations);
    }
}
