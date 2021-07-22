<?php
        //Enter your code here, enjoy!

$text = "Жила была злая женщина Зинаида Степановна и была у нее дочь Фетинья и был у нее возлюбленных Леопольд.Молодые люди хотели пожениться,

но мать сама хотела выйти замуж за молодого Леопольда, и решила насильно женить его на себе.

Она накопила всю свою пенисию, порылась в карманах Леопольда и сумочке Фетиньи, в итоге набралось целых 500 ₽. Затем Зинаида Степановна нашла обычного полицейского Семена (который любезно согласился ей помочь, за небольшое вознаграждение).

Семен мастерски проследил Фетинью до парка, используя свой незаметный и абсолютно «безпалевный» синий пиджачок. А когда Фетинья стала рассматривать крысу с пушистым хвостом, и даже попыталась ее снять с дерева чтобы приготовить вкусный обед для Леопольда, он тихо подкраслся и подбросил ей пару своих любимых препаратов.";

function most_frequent_words_rus($str, $stop_words = ['и', 'в', 'у', 'с'], $limit = 5) {
    $str = strtolower($str);
    $str = preg_split('/\s+/', $str);
    $str = array_diff($str, $stop_words);
    $str = array_count_values($str);
    
    arsort($str);
    return array_slice($str, 0, $limit);
}

function most_frequent_words_eng($string, $stop_words = [], $limit = 5) {
    // Работает только с английским текстом
    $string = strtolower($string);

    $words = str_word_count($string, 1);
    $words = array_diff($words, $stop_words); 
    $words = array_count_values($words);

    arsort($words);

    return array_slice($words, 0, $limit);
}

$result_1 = get_5_most_common_words($text);
$result_2 = most_frequent_words_eng('Hello world');
print_r($result_1);
print_r($result_2);