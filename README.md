# UniqueDigits (for Laravel and another php based code)


## About
Создание цифрового значения для разных нужд (номера билетов и прочего)
Особой защиты нет, но для создания QR кода будет достаточно.

## Установка

`composer require daaner/unique-digits`

В нужном месте подключаем класс `use UniqueDigits\UniqueDigits;`



## Использование

Создание номера
```php
$uniid = new UniqueDigits;
$uniid->Unique(ID, TEXT, DATE->timestamp, LEN);
//len длина значения от 10 до 80 знаков
//более 19 знаков - значение принимает строковой вид
```

Проверка номера
```php
$uniid = new UniqueDigits;
$uniid->UniqueCheck(123456789012345);
//возвращает ID

$uniid->UniqueCheck(123456789012345, ID);
//возвращает true или false
```

## Контакты
https://t.me/neodaan по всем вопросам


## License
UniqueDigits is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
