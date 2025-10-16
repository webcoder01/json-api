## About

Query parsing is not automatic, you must call the handler.

The handler parses the query parameters specified in the URL.
Then, it returns an object of type `QueryParametersModel`.
That object contains attributes related to pagination and sorting.

### Pagination

The following parameters must be specified in the URL:
- `page[offset]`: it is the page number
- `page[limit]`: it is the number of items per page

Example: `https://someapi.com/dogs?page[offset]=1&page[limit]=10`

#### Getting the data

To retrieve the data parsed, call the handler:
```php
$url = 'https://someapi.com/dogs?page[offset]=1&page[limit]=10';
$handler = new JsonApiQueryHandler();
$queryParameters = $handler->getQueryParsedFromUrl($url);

/** @var JsonApi\Query\Models\PaginationFieldsModel $pagination */
$pagination = $queryParameters->getPaginationFields();

$pagination->getOffset(); // returns 1
$pagination->getLimit(); // returns 10
```

If the parameter `page[offset]` is not specified, `$pagination->getOffset()` is null.

If the parameter `page[limit]` is not specified, `$pagination->getLimit()` is null.

### Sorting

Specify the fields to sort in the URL, like this: `https://someapi.com/dogs?sort=name,age`.
The fields must be separated by commas.

#### Ascending and descending sorting

The default sorting order is ascending.
To sort in descending order, add a minus sign before the field name.

In the following example, `name` is sorted in the descending order (DESC),
and `age` is sorted in the ascending order (ASC):

`https://someapi.com/dogs?sort=-name,age`

#### Getting the data

To retrieve the data parsed, call the handler:
```php
$url = 'https://someapi.com/dogs?sort=-name,age';
$handler = new JsonApiQueryHandler();
$queryParameters = $handler->getQueryParsedFromUrl($url);

/** @var JsonApi\Query\Models\SortFieldModel[] $sortFields */
$sortFields = $queryParameters->getSortFields();

$sortFields[0]->getField(); // returns 'name'
$sortFields[0]->isAscending(); // returns false

$sortFields[1]->getField(); // returns 'age'
$sortFields[1]->isAscending(); // returns true
```