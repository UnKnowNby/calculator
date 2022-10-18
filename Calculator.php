<?php

/**
 * Класс для работы с рассчетами стоимости услуг
 */
class Calculator
{
    const PRICE_FIRST = 100; //Первая стоимость за 1 километр
    const PRICE_SECOND  = 80; //Вторая стоимость за 1 километр
    const PRICE_LAST = 70; //Третья стоимость за 1 километр

    const MAX_DISTANCE_FIRST = 100; //Первый потолок дистанции
    const MAX_DISTANCE_SECOND = 300; //Второй потолок дистанции

    /**
     * Получение полной стоимости за первую дистанцию
     * @return int Стоимость в рублях
     */
    private function getDefaultCoastOver100(): int {
        return self::MAX_DISTANCE_FIRST * self::PRICE_FIRST;
    }

    /**
     * Получение полной стоимости за вторую дистанцию
     * @return int Стоимость в рублях
     */
    private function getDefaultCoastOver300(): int {
        return (self::MAX_DISTANCE_SECOND - self::MAX_DISTANCE_FIRST) * self::PRICE_SECOND + $this->getDefaultCoastOver100();
    }

    /**
     * Метод рассчета стоимости услуг
     * @param int $distance Расстояние в километрах
     * @return int Стоимость услуг в рублях
     */
    public function calculate(int $distance): int {
        if ($distance > self::MAX_DISTANCE_SECOND) {
            $cost = ($distance - self::MAX_DISTANCE_SECOND) * self::PRICE_LAST + $this->getDefaultCoastOver300();
        } else if ($distance > self::MAX_DISTANCE_FIRST && $distance <= self::MAX_DISTANCE_SECOND) {
            $cost = ($distance - self::MAX_DISTANCE_FIRST) * self::PRICE_SECOND + $this->getDefaultCoastOver100();
        } else {
            $cost = $distance * self::PRICE_FIRST;
        }

        return $cost;
    }
}
