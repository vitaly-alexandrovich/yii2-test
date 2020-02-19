<?php
namespace common\widgets;

use common\helpers\DateHelper;
use common\interfaces\DatesFilterCompatible;
use Yii;
use yii\db\ActiveRecord;
use yii\helpers\Html;
use yii\helpers\Url;

class DatesFilter extends \yii\bootstrap\Widget
{
    /**
     * Определяет search модель.
     * Необходима для корректного формирования
     *
     * @var ActiveRecord|DatesFilterCompatible
     */
    public $filterModel;

    /**
     * @var string
     */
    public $_cacheClassName;


    public function init()
    {
        parent::init();

        if (!is_null($this->filterModel)) {
            try {
                $this->_cacheClassName = (new \ReflectionClass($this->filterModel))->getShortName();
            } catch (\ReflectionException $e) {}
        }
    }

    /**
     * {@inheritdoc}
     */
    public function run()
    {
        return Html::ul($this->filterModel->getStructure(), ['item' => \Closure::fromCallable([$this, 'renderYear'])]);
    }

    /**
     * @param $months
     * @param $year
     * @return string
     */
    protected function renderYear($months, $year)
    {
        $yearLink = Html::a($year, $this->createYearUrl($year));

        if ($this->filterModel->getYear() === $year) {
            $yearLink = $year;
        }

        $yearElement = sprintf('%s (%d)', $yearLink, array_sum($months));
        $yearElement .= Html::ul($months, ['item' => function ($counter, $month) use ($year) {
            return $this->renderMonth($counter, $month, $year);
        }]);

        return Html::tag('li', $yearElement);
    }

    /**
     * @param $counter
     * @param $month
     * @param $year
     * @return string
     */
    protected function renderMonth($counter, $month, $year)
    {
        $monthLink = Html::a(DateHelper::getMonthName($month), $this->createMonthUrl($year, $month));

        if ($this->filterModel->getYear() === $year && $this->filterModel->getMonth() === $month) {
            $monthLink = DateHelper::getMonthName($month);
        }

        $monthName = sprintf('%s (%d)', $monthLink, $counter);

        return Html::tag('li', $monthName);
    }

    /**
     * @param $year
     * @return string
     */
    protected function createYearUrl($year)
    {
        return Url::to(array_merge([''], [sprintf('%s[year]', $this->_cacheClassName) => $year]));
    }

    /**
     * @param $year
     * @param $month
     * @return string
     */
    protected function createMonthUrl($year, $month)
    {
        $params = [];
        foreach (compact('year', 'month') as $param => $value) {
            $params[sprintf('%s[%s]', $this->_cacheClassName, $param)] = $value;
        }

        return Url::to(array_merge([''], $params));
    }
}
