<?php namespace common\interfaces;

/**
 * Interface ChronologyWidgetCompatible
 * @package common\interfaces
 */
interface DatesFilterCompatible
{
    /**
     * Должен возвращать выбранный год
     * @return int
     */
    public function getYear();

    /**
     * Должен возвращать номер выбранного месяца
     * @return int
     */
    public function getMonth();

    /**
     * Должен возвращать структуру в виде многомерного массива.
     * Первый уровень массива - ключ (индекс) определяет год, значение - массив с месяцами,
     * Массив с месяцами имеет формат ключ (индекс) - значение, где в качестве ключа выступает индекс месяца, а в качестве значения кол. записей в данном месяце
     * Пример структуры массива:
     * ```php
     * [
     *   2020 => [
     *     1 => 30, // 30 записей в январе 2020 года
     *     2 => 15, // 15 записей в феврале 2020 года
     *     5 => 20  // 20 записей в мае 2020 года
     *   ]
     * ]
     * ```
     *
     * @var array
     */
    public function getStructure();
}