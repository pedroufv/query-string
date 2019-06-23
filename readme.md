# Query String 

This project is a query builder from request parameters

## Supported
- [Laravel/Eloquent](https://github.com/illuminate/database/tree/master/Eloquent)

## How to use?
1. composer require pams/query-string
2. add use in your model file ```use Pams\QueryString\Trait\EloquentBuildable"```
3. add use in your model class ```use EloquentBuildable;```
4. send request with specify parameters: only, search, sort, with..
