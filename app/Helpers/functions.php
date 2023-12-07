<?php

use Illuminate\Support\Facades\File;

function slug($text )
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
function deleteImageStorage($img){
    $imgThumb = dirname($img).'/thumbs/'.basename($img); // do có folder thumbs bên trong server tạo thumb với mỗi file khác nhau
    File::delete(public_path($img));
    File::delete(public_path($imgThumb));
}
