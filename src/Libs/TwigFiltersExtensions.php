<?php


namespace App\Libs;


use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class twigFiltersExtensions extends AbstractExtension
{

    public function getFilters(): array
    {
        return [
            new TwigFilter('dateFR', [$this, 'formatedDateFr']),
            new TwigFilter('truncate', [$this, 'truncateString'])
        ];
    }

    public function formatedDateFr(string $value): string
    {
        setlocale(LC_TIME, 'fr_FR');

        return strftime('%e %B %Y %H:%M', strtotime($value));
    }

    public function truncateString(string $value, string $max): string
    {
        $value = substr($value, 0, $max);
        $last_space = strrpos($value, " ");
        $value = substr($value, 0, $last_space)."...";

        return $value;
    }
}