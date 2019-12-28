# Query String 

This project is a query builder from request parameters applying global scopes

## Supported
- [Laravel/Eloquent](https://github.com/illuminate/database/tree/master/Eloquent)

## How to use?
1. composer require pams/query-string
2. add use in your model file ```use Pams\QueryString\Trait\EloquentRequestQuery"```
3. add use in your model class ```use EloquentRequestQuery;```
4. send request with specify parameters: only, search, operators, sort, with..

## How does it work?
1. Use `?only` separated by commas to filter columns like 'select' in SQL
```
query: only=field1;field2;field3...
```
2. Use `?search` with key and value to apply where or whereHas
```
query: search=key:value

model: 
public static function searchable() {
    'key' => 'operator',
}

```
> define searchable method on model is needed and relationships are identified by dot relation.column
3. Use `?operators` to change search operator dynamically
```
query: field1:operator1
```
4. Use `?order` to sort results
```
query: field:direction
```
5. Use `?with` to load relation data separated by commas
```
query: relation1;relation2;relation3...
```
