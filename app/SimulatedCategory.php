<?php

namespace App;

enum SimulatedCategory: string
{
    case LEGISLACAO = 'legislacao';
    case DIRECAO_DEFENSIVA = 'direcao_defensiva';
    case NOCOES_MECANICA = 'nocoes_mecanica';
    case PRIMEIROS_SOCORROS = 'primeiros_socorros';
    case MEIO_AMBIENTE = 'meio_ambiente';
    case SIMULADO_GERAL = 'simulado_geral';

    public function label(): string
    {
        return match($this) {
            self::LEGISLACAO => 'Legislação de Trânsito',
            self::DIRECAO_DEFENSIVA => 'Direção Defensiva',
            self::NOCOES_MECANICA => 'Noções de Mecânica e Manutenção',
            self::PRIMEIROS_SOCORROS => 'Primeiros Socorros',
            self::MEIO_AMBIENTE => 'Meio Ambiente e Cidadania',
            self::SIMULADO_GERAL => 'Simulado Geral',
        };
    }

}
