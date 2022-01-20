<?php

namespace ale10257\algorithms\arraySort;

class MergeSortDto
{
    public array $arrayLeft;
    public int $arrayLeftStart;
    public array $arrayRight;
    public int $arrayRightStart;
    public array $dest;
    // с какого элемента начинать запись в массив приемник
    public int $destStart;
    // размер сливаемых подмассивов
    public int $size;
}