<?php

namespace App\Traits\Orm;

use App\Helper\Db\CustomQueryBuilder;
use Illuminate\Database\Query\Builder as QueryBuilder;

trait CustomPagination
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
