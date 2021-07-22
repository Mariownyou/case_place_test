# Тестовое задание в Case Place
[Google Docs](https://docs.google.com/document/u/0/d/1uCx2hwCvpnQjfVCc7Y8YN5R9vAxhnUOX/edit?usp=gmail_attachment_preview)

## 1. PHP

Написать на php функцию, которая принимает строку — текст на любом языке и возвращает массив из 5 наиболее часто встречающихся слов в этом тексте. Ключ массива — слово, значение — количество. Ни веб-сервер, ни база данных не понадобятся; версия php не имеет значения.

```php
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

$result_1 = get_5_most_common_words('Текст на любом языке');
$result_2 = most_frequent_words_eng('Hello world');
print_r($result_1);
print_r($result_2);
```
> Проверить можно [тут](https://sandbox.onlinephpfunctions.com)

<br><br>

## 2. JS

1. Создать канвас 1000x1000
2. Внутри создать прямоугольник посередине 200x100
3. Сделать кнопку, которая увеличит прямоугольник до 300х200 и повернет его на 45 градусов, при этом он должен остаться также в середине.


`canvas.html`
```html
<canvas id="canvas" class="canvas" width="1000px" height="1000px"></canvas>
<button id="button" class="button">Повернуть</button>
```
<br>

`script.js`
```js
let canvas = document.getElementById('canvas');
let button = document.getElementById('button');
let ctx = canvas.getContext("2d");

function get_canvas_center(canvas) {
    let w = canvas.width;
    let h = canvas.height;
    return [w / 2, h / 2];
}

function draw_rect(w, h, angle) {
    ctx.clearRect(0, 0, 1000, 1000);
    let x = get_canvas_center(canvas)[0];
    let y = get_canvas_center(canvas)[1];

    ctx.fillStyle = "#000000";
    if (angle != 0) {
        ctx.translate(w + w / 2, -h / 2);
        ctx.rotate(angle * Math.PI / 180);
    } else {
        ctx.translate(w / 2, h /2);
    }
    ctx.fillRect(x - w, y - h, w, h);
}

draw_rect(200, 100, 0);

button.addEventListener('click', (e) => {
    e.preventDefault();
    draw_rect(300, 200, 45);
}, { once: true });
```
> Проверить можно [тут](https://frosty-aryabhata-1ac3f5.netlify.app)

<br><br>


## 3. SQL

Написать запрос для получения из таблицы с продуктами по 2 последних товара из каждой коллекции без использования HAVING.
| Id  | Name    | Date                | Id_collection | Price |
|-----|---------|---------------------|---------------|-------|
| 1   | Товар 1 | 2017-02-22 11:04:16 | 2             | 10    |
| 2   | Товар 2 | 2017-02-21 11:04:16 | 1             | 101   |
| 3   | Товар 3 | 2017-01-22 13:04:16 | 3             | 102   |
| 4   | Товар 4 | 2016-02-22 11:04:16 | 7             | 10    |
| 5   | Товар 5 | 2017-02-22 12:04:16 | 2             | 10    |
| ... |         |                     |               |       |

```sql
SELECT t1.* FROM docs t1
WHERE (select count(*) from docs t2 where t1.id_collection=t2.id_collection and t2.date > t1.date) < 2
ORDER BY id_collection;
```

> Проверить можно [тут](http://sqlfiddle.com/#!9/2c657b/1/1)

*Schema*
```sql
CREATE TABLE IF NOT EXISTS `docs` (
  `id` int(6) unsigned NOT NULL,
  `name` varchar(200) NOT NULL,
  `date` DATETIME NOT NULL,
  `id_collection` int(8) unsigned NOT NULL,
  `Price` int(100) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) DEFAULT CHARSET=utf8;
INSERT INTO `docs` (`id`, `name`, `date`, `id_collection`, `Price`) VALUES
  ('1', 'Товар 1', '2017-02-22 11:04:16', '2', '10'),
  ('2', 'Товар 2', '2017-02-21 11:04:16', '2', '103'),
  ('3', 'Товар 3', '2017-01-22 13:04:16', '3', '20423'),
  ('4', 'Товар 4', '2017-01-22 13:04:16', '4', '504'),
  ('5', 'Товар 5', '2017-01-22 13:04:16', '3', '4504'),
  ('6', 'Товар 6', '2017-01-22 13:04:16', '4', '30'),
  ('7', 'Товар 6', '2017-01-22 13:04:16', '2', '450'),
  ('8', 'Товар 6', '2017-01-22 13:04:16', '1', '760'),
  ('9', 'Товар 7', '2017-01-22 13:04:10', '4', '3067');
```