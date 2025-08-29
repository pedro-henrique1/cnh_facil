<?php

namespace App;

enum SimulatedType: string
{
    case TEORICO = 'teorico';
    case PRATICO = 'pratico';

    public function label(): string
    {
        return match($this) {
            self::TEORICO => 'Teórico',
            self::PRATICO => 'Prático',
        };
    }
}
