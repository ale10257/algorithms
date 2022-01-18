# Классические алгоритмы на php (прокачиваем скилл)

#### Калькулятор на php (вычисляем арифметическое выражение из строки)

* [алгоритм приоритета стековых операций (обратная польская запись, класс ArithmeticCalculator)](https://ru.wikipedia.org/wiki/%D0%9E%D0%B1%D1%80%D0%B0%D1%82%D0%BD%D0%B0%D1%8F_%D0%BF%D0%BE%D0%BB%D1%8C%D1%81%D0%BA%D0%B0%D1%8F_%D0%B7%D0%B0%D0%BF%D0%B8%D1%81%D1%8C)
* [алгоритм рекурсивного спуска, класс LexemeCalculator](https://ru.wikipedia.org/wiki/%D0%9C%D0%B5%D1%82%D0%BE%D0%B4_%D1%80%D0%B5%D0%BA%D1%83%D1%80%D1%81%D0%B8%D0%B2%D0%BD%D0%BE%D0%B3%D0%BE_%D1%81%D0%BF%D1%83%D1%81%D0%BA%D0%B0)

В учебных целях, для алгоритма рекурсивного спуска реализованы функции: min(), rand(), average().

Для работы с проектом необходимо установить библиотеку ds:
```php
pecl install ds
```

Использование:
```
make up
make cd
cd src/calculate/
./index.php
```

#### Работаем с простыми числами

* Алгоритм [Решето Эратосфена](https://ru.wikipedia.org/wiki/%D0%A0%D0%B5%D1%88%D0%B5%D1%82%D0%BE_%D0%AD%D1%80%D0%B0%D1%82%D0%BE%D1%81%D1%84%D0%B5%D0%BD%D0%B0)
* Алгоритм оптимизированной проверки числа на простоту

Использование:
```
make up
make cd
cd src/primeNumbers/
./index.php
```

#### Комбинаторика

* Алгоритм [Заполняем рюкзак (knapsack problem)](https://neerc.ifmo.ru/wiki/index.php?title=%D0%97%D0%B0%D0%B4%D0%B0%D1%87%D0%B0_%D0%BE_%D1%80%D1%8E%D0%BA%D0%B7%D0%B0%D0%BA%D0%B5)

Использование:
```
make up
make cd
cd src/knapsackProblem/
./index.php
```