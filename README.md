# Laravel pagination
Multiple `distinct(['field_a', 'field_b'])` with `paginate()`


## Problem 
- ORM select return error when calculate `total` rows for `pagination`
```sql
SomeModel::select(['*'])
    ->distinct(['field_a', 'field_b'])
    ->orderBy('field_a')
    ->orderBy('field_b')
    ->paginate($perPage)
```

- Exception example
```sql 
SQLSTATE[42883]: Undefined function: 7 ERROR: function count(bigint, bigint) does not exist\nLINE 1: select count(distinct \"field_a\", \"field_b\") as aggregate from \"...\n
```

## Install
```composer
composer require larahook/distinct-on-pagination
```

## Usage

- Add `DistinctOnPagination` trait in `SomeModel` class
- Pagination total must be calc without Exception
```php
class SomeModel extends Model
{
    use DistinctOnPagination; // <-- add DistinctOnPagination trait
    use HasFactory;

    /** @var string */
    protected $table = 'some_table';
}
```




## Config
- You can also publish the config file to change implementations (concat delimiter)
```composer
php artisan vendor:publish --provider="Larahook\DistinctOnPagination\DistinctOnPaginationServiceProvider" --tag=config
```