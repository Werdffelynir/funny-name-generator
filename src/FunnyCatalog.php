<?php

namespace FunnyNameGenerator;

class FunnyCatalog implements IFunnyCatalog
{
    protected int $length = 0;
    protected string $catalog = '';
    protected array $catalogArray = [];

    public function __construct()
    {
        if (empty($this->catalog)) {
            throw new \ErrorException('Catalog file not sets!');
        }

        $this->catalogArray = $this->set($this->catalog);
        $this->length = count($this->catalogArray);
    }

    public function set(string $catalog)
    {
        $path = __DIR__ . DIRECTORY_SEPARATOR . $catalog;

        return array_values(array_filter(file($path), function ($line) {
            return !empty(trim($line));
        }));
    }

    public function extract(): array
    {
        return $this->catalogArray;
    }

    public function random(): string
    {
        $catalog = $this->extract();

        if (!empty($catalog)) {
            $index = rand(0, count($catalog) - 1);

            return $catalog[$index];
        }

        return '';
    }
}
