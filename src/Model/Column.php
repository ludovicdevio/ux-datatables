<?php

namespace Ludovicdevio\UX\DataTables\Model;

use Ludovicdevio\UX\DataTables\Enum\ColumnType;

use function array_filter;

class Column
{
    private ?string $cellType = null;

    private ?string $className = null;

    private ?string $name = null;

    private ColumnType $type;

    private ?string $width = null;

    private string $title;

    private bool $orderable = true;

    private bool $searchable = true;

    private bool $visible = true;


    public static function new(string $name, string $title, ColumnType $type = ColumnType::STRING): self
    {
        return (new self())
            ->setName($name)
            ->setTitle($title)
            ->setType($type);
    }

    public function setClassName(string $className): self
    {
        $this->className = $className;

        return $this;
    }

    /**
     * Change the cell type created for the column - either TD cells or TH cells.
     */
    public function setCellType(string $cellType): self
    {
        $this->cellType = $cellType;

        return $this;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Enable or disable ordering on this column.
     */
    public function setOrderable(bool $orderable): self
    {
        $this->orderable = $orderable;

        return $this;
    }

    /**
     * Enable or disable searching on this column.
     */
    public function setSearchable(bool $searchable): self
    {
        $this->searchable = $searchable;

        return $this;
    }

    /**
     * Set the column type - used for filtering and sorting string processing.
     */
    public function setType(ColumnType $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * This parameter can be used to define the width of a column, and may take any CSS value (3em, 20px etc).
     */
    public function setWidth(string $width): self
    {
        $this->width = $width;

        return $this;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Enable or disable the display of this column.
     */
    public function setVisible(bool $visible): self
    {
        $this->visible = $visible;

        return $this;
    }

    public function toArray(): array
    {
        return array_filter([
            'cellType' => $this->cellType,
            'className' => $this->className,
            'name' => $this->name,
            'orderable' => $this->orderable,
            'searchable' => $this->searchable,
            'type' => $this->type->value,
            'width' => $this->width,
            'title' => $this->title,
            'visible' => $this->visible,
        ], fn($value) => $value !== null);
    }
}
