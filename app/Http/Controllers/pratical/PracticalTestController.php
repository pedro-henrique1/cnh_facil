<?php

namespace App\Http\Controllers\pratical;

use App\Http\Controllers\BaseTestController;
use App\Models\Question;
use App\SimulatedType;

class PracticalTestController extends BaseTestController
{
    protected const TIME_LIMIT_MINUTES = 10;
    // protected const PASSING_PERCENTAGE = 80; // Porcentagem maior

    protected function getSessionPrefix(): string
    {
        return 'practical_test';
    }

    protected function getShowRouteName(): string
    {
        return 'practical.show';
    }

    protected function getFinishRouteName(): string
    {
        return 'practical.finish';
    }

    protected function getQuestionViewName(): string
    {
        return 'practical_test.practicalTestPage';
    }

    protected function getFinishViewName(): string
    {
        return 'practical_test.finish';
    }

    protected function getQuestionType(): SimulatedType
    {
        return SimulatedType::PRATICO;
    }

}
