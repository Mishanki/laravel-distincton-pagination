# Laravel distinct on multiple field pagination

#### Calc total rows for pgsql query

```sql

SomeModel::select(['*'])
    ->distinct(['field_a', 'field_b'])
    ->orderBy('field_a')
    ->orderBy('field_b')
    ->paginate($perPage)
```