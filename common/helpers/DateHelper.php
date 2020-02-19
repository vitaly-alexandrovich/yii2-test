<?php namespace common\helpers;
use yii\helpers\ArrayHelper;

class DateHelper
{
    /**
     * Возвращает одноуровневый массив, где ключ - номер месяца, значение его название
     * @return array
     */
    public static function getMonths()
    {
        return [
            1 => 'Январь',
            2 => 'Февраль',
            3 => 'Март',
            4 => 'Апрель',
            5 => 'Май',
            6 => 'Июнь',
            7 => 'Июль',
            8 => 'Август',
            9 => 'Сентябрь',
            10 => 'Октябрь',
            11 => 'Ноябрь',
            12 => 'Декабрь',
        ];
    }

    /**
     * Возвращает название месяца по его номеру
     *
     * @param integer $index
     * @return string
     */
    public static function getMonthName($index)
    {
        return ArrayHelper::getValue(static::getMonths(), intval($index));
    }
}