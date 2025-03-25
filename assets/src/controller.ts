import { Controller } from '@hotwired/stimulus';
import DataTable from 'datatables.net-dt';

export default class extends Controller {
    declare readonly viewValue: any;

    static values = {
        view: Object,
    };

    private table: DataTable | null = null;
    private isDataTableInitialized = false;

    connect() {
        if (this.isDataTableInitialized) {
            return;
        }

        if (!(this.element instanceof HTMLTableElement)) {
            throw new Error('Invalid element');
        }

        const payload = this.viewValue;

        this.dispatchEvent('pre-connect', {
            config: payload,
        });

        this.table = new DataTable(this.element as HTMLElement, payload);

        this.dispatchEvent('connect', { table: this.table });

        this.isDataTableInitialized = true;
    }

    private dispatchEvent(name: string, payload: any) {
        this.dispatch(name, { detail: payload, prefix: 'datatables' });
    }
}
