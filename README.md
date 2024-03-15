# Laravel pagination with distinct on (field_a, field_b,...)

### Calc total rows (pgsql)

### Install
```composer
composer require larahook/distinct-on-pagination
```

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