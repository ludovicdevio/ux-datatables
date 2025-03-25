<?php

namespace Ludovicdevio\UX\DataTables\Model;

class DataTable
{

    public function __construct(
        private readonly string $id,
        private array $options = [],
        private array $attributes = []
    ){
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getOptions(): array
    {
        return $this->options;
    }

    public function setOptions(array $options): static
    {
        $this->options = $options;

        return $this;
    }

    public function getAttributes(): array
    {
        return $this->attributes;
    }

    public function setAttributes(array $attributes): static
    {
        $this->attributes = $attributes;

        return $this;
    }

    public function getDataController(): ?string
    {
        return $this->attributes['data-controller'] ?? null;
    }

    /**
     * Feature control DataTables' smart column width handling.
     */
    public function autoWidth(bool $autoWidth): static
    {
        $this->options['autoWidth'] = $autoWidth;

        return $this;
    }
    /**
     * Initial order (sort) to apply to the table.
     * @param array $order Array of order configurations. Each element can be:
     *                     - An array with [column_index, direction]
     *                     - An object with {idx: number, dir: 'asc'|'desc'}
     *                     - An object with {name: string, dir: 'asc'|'desc'}
     */
    public function order(array $order): static
    {
        $this->options['order'] = $order;

        return $this;
    }

    /**
     * Set a caption for the table
     */
    public function caption(string $caption): static
    {
        $this->options['caption'] = $caption;
    
        return $this;
    }

    public function add(Column $column): static
    {
        $this->options['columns'][] = $column->toArray();
    
        return $this;
    }

    /**
     * @param array|Column[] $columns
     */
    public function columns(array $columns): static
    {
        foreach ($columns as $column) {
            if ($column instanceof Column) {
                $this->options['columns'][] = $column->toArray();
            } else {
                $this->options['columns'][] = $column;
            }
        }
    
        return $this;
    }

    /**
     * Feature control deferred rendering for additional speed of initialisation.
     */
    public function deferRender(bool $deferRender): static
    {
        $this->options['deferRender'] = $deferRender;
    
        return $this;
    }

    /**
     * Feature control table information display field.
     */
    public function info(bool $info): static
    {
        $this->options['info'] = $info;
    
        return $this;
    }

    /**
     * Feature control the end user's ability to change the paging display length of the table.
     */
    public function lengthChange(bool $lengthChange): static
    {
        $this->options['lengthChange'] = $lengthChange;
    
        return $this;
    }

    /**
     * Feature control ordering (sorting) abilities in DataTables.
     */
    public function ordering(bool $ordering): static
    {
        $this->options['ordering'] = $ordering;
    
        return $this;
    }

    /**
     * Enable or disable table pagination.
     */
    public function paging(bool $paging): static
    {
        $this->options['paging'] = $paging;
    
        return $this;
    }

    /**
     * Feature control the processing indicator.
     */
    public function processing(bool $processing): static
    {
        $this->options['processing'] = $processing;
    
        return $this;
    }

    /**
     * Horizontal scrolling
     */
    public function scrollX(bool $scrollX): static
    {
        $this->options['scrollX'] = $scrollX;
    
        return $this;
    }

    /**
     * Vertical scrolling
     */
    public function scrollY(string $scrollY): static
    {
        $this->options['scrollY'] = $scrollY;
    
        return $this;
    }

    /**
     * Feature control search (filtering) abilities
     */
    public function searching(bool $searching): static
    {
        $this->options['searching'] = $searching;
    
        return $this;
    }

    /**
     * Feature control table information display field.
     */
    public function serverSide(bool $serverSide): static
    {
        $this->options['serverSide'] = $serverSide;
    
        return $this;
    }

    /**
     * Feature control table information display field.
     */
    public function stateSave(bool $stateSave): static
    {
        $this->options['stateSave'] = $stateSave;
    
        return $this;
    }
    /**
     * Define the starting point for data display when using DataTables with pagination.
     */
    public function displayStart(int $displayStart): static
    {
        $this->options['displayStart'] = $displayStart;
    
        return $this;
    }

    /**
     * Load data for the table's content from an Ajax source.
     */
    public function ajax(AjaxOptions $ajaxOption): static
    {
        $this->options['ajax'] = $ajaxOption->toArray();
    
        return $this;
    }

    /**
     * Data to use as the display data for the table.
     */
    public function data(array $data): static
    {
        $this->options['data'] = $data;
    
        return $this;
    }
}
