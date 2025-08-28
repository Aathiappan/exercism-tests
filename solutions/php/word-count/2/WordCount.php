<?php
declare(strict_types=1);

function wordCount(string $words): array
{
    return array_count_values(preg_split("/[^\w']+/", strtolower($words), -1, PREG_SPLIT_NO_EMPTY));
}
