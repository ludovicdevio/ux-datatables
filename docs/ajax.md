# Ajax

## Introduction

The `ajax` option in the UX DataTables library allows dynamic loading of table data from an external source via an HTTP request. This feature is particularly useful for handling large datasets without overloading the browser.

## Using with Symfony

You can configure data loading using the `AjaxOption` class. Here’s how to use this option with a `DataTable` instance:

```php
use Ludovicdevio\UX\DataTables\Model\DataTable;
use Ludovicdevio\UX\DataTables\Model\AjaxOptions;

class MyTableService
{
    public function createTable(): DataTable
    {
        $dataTable = new DataTable('example_table');
        
        $ajaxOption = new AjaxOptions(
            url: '/api/data', // API endpoint to fetch data
            dataSrc: 'data',  // Key in the JSON response containing the data (optional)
            type: 'POST'      // HTTP method used (default is GET)
        );

        $dataTable->ajax($ajaxOption);
        
        return $dataTable;
    }
}
```

## Expected JSON Response Format

The server should return a JSON response containing the data under the key defined in `dataSrc` (default is `data`). Here is an example of a correct response:

```json
{
    "data": [
        { "id": 1, "name": "Product A", "price": 10.5 },
        { "id": 2, "name": "Product B", "price": 20.0 }
    ],
    "recordsTotal": 100,
    "recordsFiltered": 100
}
```

- `data`: Array containing the records to display.
- `recordsTotal`: Total number of records in the database.
- `recordsFiltered`: Total number of records after filtering.

### Using the Helper to Format JSON Response

To ensure the correct response format, you can use the `DataTableResponseBuilder` helper:

```php
use Ludovicdevio\UX\DataTables\Builder\DataTableResponseBuilder;

$responseBuilder = new DataTableResponseBuilder();

$response = $responseBuilder->buildResponse(
    draw: 1,
    data: $data,
    recordsTotal: $totalRecords,
    recordsFiltered: $filteredRecords
);

return $response;
```

### Error Handling

If the server returns an error, ensure that the JSON response format contains an explicit structure to handle the error on the client side.

Example of an error response:

```json
{
    "error": "An error occurred while loading the data."
}
```

On the frontend, you can intercept these errors and display an appropriate message to the user.

---

By properly configuring the `ajax` option, you can significantly improve the performance and user experience of your data tables in Symfony.

