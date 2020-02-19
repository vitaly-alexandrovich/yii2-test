<?php

namespace common\models\search;

use common\interfaces\DatesFilterCompatible;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Data;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

/**
 * DataSearch represents the model behind the search form of `common\models\Data`.
 */
class DataSearch extends Data implements DatesFilterCompatible
{
    public $year = null;
    public $month = null;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['card_number', 'year', 'month'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        return Model::scenarios();
    }

    /**
     * @return null|string
     */
    public function getYear()
    {
        return intval($this->year);
    }

    /**
     * @return null|string
     */
    public function getMonth()
    {
        return intval($this->month);
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Data::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query
            ->andFilterWhere(['ilike', 'card_number', $this->card_number])
            ->andFilterWhere(['=', new Expression('extract(year from date)'), $this->year])
            ->andFilterWhere(['=', new Expression('extract(month from date)'), $this->month]);

        return $dataProvider;
    }

    /**
     * @return array
     */
    public function getStructure()
    {
        $result = static::find()
            ->select([
                new Expression('extract(year from date) as year'),
                new Expression('extract(month from date) as month'),
                new Expression('count(*)'),
            ])
            ->groupBy(['year', 'month'])
            ->orderBy([
                'year' => SORT_DESC,
                'month' => SORT_DESC,
            ])
            ->asArray()
            ->all();

        $structure = [];
        foreach ($result as $row) {
            list($year, $month, $count) = array_values($row);

            ArrayHelper::setValue($structure, sprintf('%d.%s', $year, $month), $count);
        }

        return $structure;
    }
}
