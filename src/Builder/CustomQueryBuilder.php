<?php

namespace Larahook\DistinctOnPagination\Builder;

use Illuminate\Database\Query\Builder;
use Illuminate\Database\Query\Expression;
use Illuminate\Database\Query\Grammars\Grammar;
use Illuminate\Support\HigherOrderTapProxy;

class CustomQueryBuilder extends Builder
{
    /**
     * Run a pagination count query.
     *
     * @param array $columns
     *
     * @return array
     */
    protected function runPaginationCountQuery($columns = ['*']): array
    {
        if ($this->groups || $this->havings) {
            $clone = $this->cloneForPaginationCount();

            if ($clone->columns === null && !empty($this->joins)) {
                $clone->select($this->from.'.*');
            }

            return $this->newQuery()
                ->from(new Expression('('.$clone->toSql().') as '.$this->grammar->wrap('aggregate_table')))
                ->mergeBindings($clone)
                ->setAggregate('count', $this->withoutSelectAliases($columns))
                ->get()->all()
            ;
        }

        $without = $this->unions ? ['orders', 'limit', 'offset'] : ['columns', 'orders', 'limit', 'offset'];

        return $this->cloneWithout($without)
            ->cloneWithoutBindings($this->unions ? ['order'] : ['select', 'order'])
            ->concatDistinct()
            ->setAggregate('count', $this->withoutSelectAliases($columns))
            ->get()->all()
        ;
    }

    /**
     * @return HigherOrderTapProxy|mixed
     */
    protected function concatDistinct(): mixed
    {
        return tap($this->clone(), static function ($clone) {
            if (\is_array($clone->distinct) && \count($clone->distinct) > 1) {
                $delimiter = config('distincton.delimiter');
                $fields = $clone->distinct;
                $implodeFields = [];
                foreach ($fields as $field) {
                    if (\is_object($field)) {
                        $field = $field->getValue(new Grammar());
                    }

                    $implodeFields[] = $field;
                    if ($delimiter) {
                        $implodeFields[] = '\''.$delimiter.'\'';
                    }
                }

                $clone->distinct = [];
                $clone->distinct[] = \DB::raw('concat('.implode(',', $implodeFields).')');
            }
        });
    }
}
