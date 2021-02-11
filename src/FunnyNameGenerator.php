<?php

namespace FunnyNameGenerator;

class FunnyNameGenerator implements IGenerator
{
    /**
     * @var array [FunnyCatalog]
     */
    private array $catalogs = [];

    public function __construct(...$catalogs)
    {
        if (empty($catalogs)) {
            $catalogs = [
                \FunnyNameGenerator\AdjectivesFunnyCatalog::class,
                \FunnyNameGenerator\VideoGameFunnyCatalog::class,
                \FunnyNameGenerator\NounsFunnyCatalog::class,
            ];
        }

        foreach ($catalogs as $catalog) {
            $this->catalogs[$catalog] = new $catalog();
        }
    }

    public function getName()
    {
        $words = [];
        /** @var NounsFunnyCatalog $catalog */
        foreach ($this->catalogs as $catalog) {
            $parsed = $this->parse(trim($catalog->random()));
            $words[] = ucfirst($parsed);
        }

        return implode(' ', $words);
    }

    private function parse(string $word)
    {
        $words = [];

        $position = strpos($word, '^');
        if ($position !== false) {
            $words = explode('^', substr($word, 0, $position));
            $word = substr($word, $position + 1);
        }

        $position = strpos($word, '|');
        if ($position !== false) {
            $words = array_merge($words, explode('|', $word));

            $words = array_values(array_filter($words, function ($line) {
                return !empty(trim($line));
            }));
            $word = $words[array_rand($words)];
        }

        return $word;
    }
}
