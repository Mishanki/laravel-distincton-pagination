# Laravel distinct on multiple field pagination

### Calc total rows for pgsql query

### Usage

Add `DistinctOnPagination` trait in `SomeModel`
```php
use DistinctOnPagination;
```

- Call your ORM model with `distinct(['field_a', 'field_b'])` and `paginate($perPage)`.
- Total must be calc without Exception
```sql

SomeModel::select(['*'])
    ->distinct(['field_a', 'field_b'])
    ->orderBy('field_a')
    ->orderBy('field_b')
    ->paginate($perPage)
```