<?php

namespace Larahook\DistinctOnPagination\Trait;

use Illuminate\Database\Query\Builder as QueryBuilder;
use Larahook\DistinctOnPagination\Builder\CustomQueryBuilder;

trait DistinctOnPagination
{
    /**
     * @return QueryBuilder
     */
    protected function newBaseQueryBuilder(): QueryBuilder
    {
        $conn = $this->getConnection();
        $grammar = $conn->getQueryGrammar();

        return new CustomQueryBuilder($conn, $grammar, $conn->getPostProcessor());
    }
}
