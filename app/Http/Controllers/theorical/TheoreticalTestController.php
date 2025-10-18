<?php

namespace App\Http\Controllers\theorical;

use App\Http\Controllers\BaseTestController;
use App\SimulatedType;

class TheoreticalTestController extends BaseTestController
{
    protected function getSessionPrefix(): string
    {
        return 'theoretical_test';
    }

    protected function getShowRouteName(): string
    {
        return 'theoretical.show';
    }

    protected function getFinishRouteName(): string
    {
        return 'theoretical.simulated.finish';
    }

    protected function getQuestionViewName(): string
    {
        return 'theoretical_test.theoricalTestPage';
    }

    protected function getFinishViewName(): string
    {
        return 'theoretical_test.finish';
    }

    protected function getQuestionType(): SimulatedType
    {
        return SimulatedType::TEORICO; // Define o filtro para 'teórico'
    }


    // protected const TIME_LIMIT_MINUTES = 30; // Tempo diferente
    // protected const PASSING_PERCENTAGE = 60; // Porcentagem diferente
}
