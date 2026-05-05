<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait Searchable
{
    /**
     * Scope a query to search for a term in specific columns.
     *
     * @param Builder $query
     * @param string|null $term
     * @param array $columns
     * @return Builder
     */
    public function scopeSearch(Builder $query, ?string $term, array $columns = [])
    {
        if (!$term) {
            return $query;
        }

        if (empty($columns)) {
            $columns = $this->searchable ?? [];
        }

        return $query->where(function (Builder $query) use ($term, $columns) {
            foreach ($columns as $column) {
                if (str_contains($column, '.')) {
                    $relation = explode('.', $column);
                    $columnName = array_pop($relation);
                    $relationPath = implode('.', $relation);

                    $query->orWhereHas($relationPath, function (Builder $query) use ($columnName, $term) {
                        $query->where($columnName, 'like', "%{$term}%");
                    });
                } else {
                    $query->orWhere($column, 'like', "%{$term}%");
                }
            }
        });
    }
}
