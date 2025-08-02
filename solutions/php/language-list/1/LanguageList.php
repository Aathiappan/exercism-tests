<?php

function language_list(...$langs)
{
    return $langs;
    // implement the language list function
}
function add_to_language_list(array $langList, string $newLang){
    array_push($langList,$newLang);
    return $langList;
}
function prune_language_list(array $langList){
    return array_slice($langList,1,(count($langList) - 1));
}
function current_language(array $langList){
    return current($langList);
}
function language_list_length(array $langList){
    return count($langList);
}