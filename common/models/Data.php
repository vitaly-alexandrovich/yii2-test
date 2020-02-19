<?php

namespace common\models;

use common\helpers\DateHelper;
use Yii;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "data".
 *
 * @property int $id
 * @property string|null $card_number
 * @property string $date
 * @property float $volume
 * @property string $service
 * @property int|null $address_id
 * @property-read  string $year
 * @property-read string $month
 */
class Data extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'data';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date', 'volume', 'service'], 'required'],
            [['date'], 'safe'],
            [['volume'], 'number'],
            [['address_id'], 'default', 'value' => null],
            [['address_id'], 'integer'],
            [['card_number'], 'string', 'max' => 20],
            [['service'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'card_number' => 'Номер карты',
            'date' => 'Дата',
            'volume' => 'Сумма',
            'service' => 'Услуга',
            'address_id' => 'Адрес',
            'year' => 'Год',
            'month' => 'Месяц',
        ];
    }

    /**
     * @return false|string
     */
    public function getYear()
    {
        return date('Y', strtotime($this->date));
    }

    /**
     * @return false|string
     */
    public function getMonth()
    {
        return DateHelper::getMonthName(date('m', strtotime($this->date)));
    }

    /**
     * @return array
     */
    public static function availableYears()
    {
        $result = static::find()
            ->select(new Expression('distinct extract(year from date) as year'))
            ->asArray()
            ->all();

        return ArrayHelper::map($result, 'year', 'year');
    }
}
