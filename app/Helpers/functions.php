<?php
function slug( $text )
{
    $trans = [
        'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'jo', 'ж' => 'zh', 'з' => 'z', 'и' => 'i', 'й' => 'jj',
        'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o', 'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f',
        'х' => 'kh', 'ц' => 'c', 'ч' => 'ch', 'ш' => 'sh', 'щ' => 'shh', 'ъ' => '', 'ы' => 'y', 'ь' => '', 'э' => 'eh', 'ю' => 'ju', 'я' => 'ja',
    ];
    $text  = mb_strtolower( $text, 'UTF-8' ); // lowercase cyrillic letters too
    $text  = strtr( $text, $trans ); // transliterate cyrillic letters
    $text  = preg_replace( '/[^A-Za-z0-9 _.]/', '', $text );
    $text  = preg_replace( '/[ _.]+/', '-', trim( $text ) );
    $text  = trim( $text, '-' );
    return $text;
}
function getCategories($categories, $old = '', $parentId = 0, $char = '') {
    $id = request()->category;
    if ($categories) {
        foreach ($categories as $key => $category) {
            if ($category->parent_id === $parentId && $id!=$category->id) {
                echo '<option value="' . $category->id . '"';
                if ($old == $category->id) {
                    echo ' selected';
                }
                echo '>';
                echo $char . $category->name;
                echo '</option>';
                unset($categories[$key]);
                getCategories($categories, $old, $category->id, $char . '|-');
            }
        }
    }
}
