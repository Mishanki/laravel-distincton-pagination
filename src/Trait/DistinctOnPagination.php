<?php

namespace Trait;

use Builder\CustomQueryBuilder;
use Illuminate\Database\Query\Builder as QueryBuilder;

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
