<?php

namespace Ludovicdevio\UX\DataTables\Model;

class AjaxOptions
{
    public function __construct(
        private readonly string $url,
        private readonly ?string $dataSrc = null,
        private readonly ?string $type = null,
    ) {
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getDataSrc(): ?string
    {
        return $this->dataSrc;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function toArray(): array
    {
        $array = [
            'url' => $this->url,
        ];

        if ($this->dataSrc !== null) {
            $array['dataSrc'] = $this->dataSrc;
        }

        if ($this->type !== null) {
            $array['type'] = $this->type;
        }

        return $array;
    }
}
