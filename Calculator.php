<?php

/**
 * Класс для работы с рассчетами стоимости услуг
 */
class Calculator
{
    /**
     * @var int Первая стоимость за 1 километр
     */
    public $priceFirst = 100;

    /**
     * @var int Вторая стоимость за 1 километр
     */
    public $priceSecond = 80;

    /**
     * @var int Третья стоимость за 1 километр
     */
    public $priceThird = 70;

    /**
     * @var int Первый потолок дистанции
     */
    public $maxDistanceFirst = 100;

    /**
     * @var int Второй потолок дистанции
     */
    public $maxDistanceSecond = 300;

    /**
     * Получение полной стоимости за первую дистанцию
     * @return int Стоимость в рублях
     */
    private function getDefaultCoastOver100(): int {
        return $this->maxDistanceFirst * $this->priceFirst;
    }

    /**
     * Получение полной стоимости за вторую дистанцию
     * @return int Стоимость в рублях
     */
    private function getDefaultCoastOver300(): int {
        return ($this->maxDistanceSecond - $this->maxDistanceFirst) * $this->priceSecond + $this->getDefaultCoastOver100();
    }

    /**
     * Метод рассчета стоимости услуг
     * @param int $distance Расстояние в километрах
     * @return int Стоимость услуг в рублях
     * @throws Exception
     */
    public function calculate(int $distance): int {
        try {
            if ($this->maxDistanceFirst > $this->maxDistanceSecond) {
                throw new Exception('Значение maxDistanceFirst больше, чем maxDistanceSecond !');
            }

            if ($distance > $this->maxDistanceSecond) {
                $cost = ($distance - $this->maxDistanceSecond) * $this->priceThird + $this->getDefaultCoastOver300();
            } else if ($distance > $this->maxDistanceFirst && $distance <= $this->maxDistanceSecond) {
                $cost = ($distance - $this->maxDistanceFirst) * $this->priceSecond + $this->getDefaultCoastOver100();
            } else {
                $cost = $distance * $this->priceFirst;
            }

            return $cost;
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
}
