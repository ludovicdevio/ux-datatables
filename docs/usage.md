
# Usage

To use UX DataTables, inject the `DataTableBuilderInterface` service and
create tables in PHP:

``` php
// ...
use Ludovicdevio\UX\DataTables\Builder\DataTableBuilderInterface;
use Ludovicdevio\UX\DataTables\Model\DataTable;
use Ludovicdevio\UX\DataTables\Model\Column;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_homepage')]
    public function index(DataTableBuilderInterface $builder): Response
    {
        $table = $builder
            ->createDataTable('usersTable')
            ->columns([
                Column::new('firstName', 'First name'),
                Column::new('lastName', 'Last name'),
            ])
            ->data([
                ['John', 'Doe'],
                ['Jane', 'Smith'],
            ]);

        return $this->render('home/index.html.twig', [
            'table' => $table,
        ]);
    }
}
```

All options and data are provided as-is to DataTables. You can read
[DataTables documentation](https://datatables.net/manual/) to discover
them all.

Once created in PHP, a table can be displayed using Twig:

``` html+twig
{{ render_datatable(table) }}

{# You can pass HTML attributes as a second argument to add them on the <table> tag #}
{{ render_datatable(table, {'class': 'my-table'}) }}
```

### Extend the default behavior

Symfony UX DataTables allows you to extend its default behavior using a
custom Stimulus controller:

``` javascript
// mytable_controller.js

import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    connect() {
        this.element.addEventListener('datatables:pre-connect', this._onPreConnect);
        this.element.addEventListener('datatables:connect', this._onConnect);
    }

    disconnect() {
        // You should always remove listeners when the controller is disconnected to avoid side effects
        this.element.removeEventListener('datatables:pre-connect', this._onPreConnect);
        this.element.removeEventListener('datatables:connect', this._onConnect);
    }

    _onPreConnect(event) {
        // The table is not yet created
        // You can access the config that will be passed to "new DataTable()"
        console.log(event.detail.config);

        // For instance you can define a render callback for a given column
        event.detail.config.columns[0].render = function (data, type, row, meta) {
            return '<a href="' + data + '">Download</a>';
        }
    }

    _onConnect(event) {
        // The table was just created
        console.log(event.detail.table); // You can access the table instance using the event details

        // For instance you can listen to additional events
        event.detail.table.on('init', (event) => {
            /* ... */
        };
        event.detail.table.on('draw', (event) => {
            /* ... */
        };
    }
}
```

Then in your render call, add your controller as an HTML attribute:

``` twig
{{ render_datatable(table, {'data-controller': 'mytable'}) }}
```
