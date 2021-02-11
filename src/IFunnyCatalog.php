<?php

namespace FunnyNameGenerator;

interface IFunnyCatalog
{
    /** @return array */
    public function extract(): array;

    /**
     * @param string $catalog
     * @return void
     */
    public function set(string $catalog);

    /** @return string */
    public function random(): string;
}
