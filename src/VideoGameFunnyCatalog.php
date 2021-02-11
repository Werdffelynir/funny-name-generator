<?php

namespace FunnyNameGenerator;

class VideoGameFunnyCatalog extends FunnyCatalog
{
    public string $catalog = 'catalogs/video-game.catalog';

    public function extract(): array
    {
        $this->catalogArray = array_filter($this->catalogArray, function (string $word) {
            if (strpos($word, '#') === 0)
                return false;
            return true;
        });

        return $this->catalogArray;
    }
}