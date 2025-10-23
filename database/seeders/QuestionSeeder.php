<?php

namespace Database\Seeders;

use App\SimulatedCategory;
use App\SimulatedType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoryMappingData = [
            'SINALIZAÇÃO' => SimulatedCategory::SINALIZACAO->value,
            'LEGISLAÇÃO DE TRÂNSITO' => SimulatedCategory::LEGISLACAO->value,
            'DIREÇÃO DEFENSIVA' => SimulatedCategory::DIRECAO_DEFENSIVA->value,
            'MECÂNICA BÁSICA' => SimulatedCategory::NOCOES_MECANICA->value,
            'PRIMEIROS SOCORROS' => SimulatedCategory::PRIMEIROS_SOCORROS->value,
            'PRATICO' => SimulatedCategory::PRACTICAL_TEST->value,
        ];

        $categoryMap = [];

        foreach ($categoryMappingData as $longName => $slug) {
            $category = DB::table('categories')->where('category', $slug)->first();

            if ($category) {
                $categoryMap[$longName] = $category->id;
            } else {
                $this->command->error("Categoria '$longName' (slug: $slug) não encontrada. Execute o CategorySeeder primeiro.");
                return;
            }
        }

        $questionsData = [
            // --- SINALIZAÇÃO (20 Questões) ---
            [
                'category' => 'SINALIZAÇÃO',
                'question' => '1. Qual é a função principal da sinalização de trânsito?',
                'type' => SimulatedType::TEORICO->value,
                'answers' => [
                    ['answer_text' => 'A) Embelezar a via', 'is_correct' => false],
                    ['answer_text' => 'B) Informar e orientar os condutores e pedestres', 'is_correct' => true],
                    ['answer_text' => 'C) Regular o comércio local', 'is_correct' => false],
                    ['answer_text' => 'D) Garantir a velocidade máxima', 'is_correct' => false],
                ],
            ],
            [
                'category' => 'SINALIZAÇÃO',
                'question' => '2. Uma placa vermelha com um círculo branco no centro indica:',
                'type' => SimulatedType::TEORICO->value,
                'answers' => [
                    ['answer_text' => 'A) Proibido estacionar', 'is_correct' => true],
                    ['answer_text' => 'B) Proibido ultrapassar', 'is_correct' => false],
                    ['answer_text' => 'C) Perigo de colisão', 'is_correct' => false],
                    ['answer_text' => 'D) Área de pedestre', 'is_correct' => false],
                ],
            ],
            [
                'category' => 'SINALIZAÇÃO',
                'question' => '3. Qual é a cor das placas de advertência?',
                'type' => SimulatedType::TEORICO->value,
                'answers' => [
                    ['answer_text' => 'A) Azul', 'is_correct' => false],
                    ['answer_text' => 'B) Amarela', 'is_correct' => true],
                    ['answer_text' => 'C) Vermelha', 'is_correct' => false],
                    ['answer_text' => 'D) Verde', 'is_correct' => false],
                ],
            ],
            [
                'category' => 'SINALIZAÇÃO',
                'question' => '4. A faixa de pedestres deve ser respeitada por:',
                'type' => SimulatedType::TEORICO->value,
                'answers' => [
                    ['answer_text' => 'A) Apenas carros', 'is_correct' => false],
                    ['answer_text' => 'B) Pedestres e ciclistas', 'is_correct' => false],
                    ['answer_text' => 'C) Todos os veículos', 'is_correct' => true],
                    ['answer_text' => 'D) Apenas ônibus', 'is_correct' => false],
                ],
            ],
            [
                'category' => 'SINALIZAÇÃO',
                'question' => '5. Placa de parada obrigatória significa:',
                'type' => SimulatedType::TEORICO->value,
                'answers' => [
                    ['answer_text' => 'A) Reduzir a velocidade', 'is_correct' => false],
                    ['answer_text' => 'B) Parar completamente', 'is_correct' => true],
                    ['answer_text' => 'C) Seguir em frente', 'is_correct' => false],
                    ['answer_text' => 'D) Estacionar temporariamente', 'is_correct' => false],
                ],
            ],
            [
                'category' => 'SINALIZAÇÃO',
                'question' => '6. Qual a forma da placa de advertência?',
                'type' => SimulatedType::TEORICO->value,
                'answers' => [
                    ['answer_text' => 'A) Triangular', 'is_correct' => false],
                    ['answer_text' => 'B) Retangular', 'is_correct' => false],
                    ['answer_text' => 'C) Circular', 'is_correct' => false],
                    ['answer_text' => 'D) Quadrada', 'is_correct' => true],
                ],
            ],
            [
                'category' => 'SINALIZAÇÃO',
                'question' => '7. Qual placa indica velocidade máxima permitida?',
                'type' => SimulatedType::TEORICO->value,
                'answers' => [
                    ['answer_text' => 'A) Sinalização vertical regulatória', 'is_correct' => true],
                    ['answer_text' => 'B) Sinalização de advertência', 'is_correct' => false],
                    ['answer_text' => 'C) Sinalização de serviço', 'is_correct' => false],
                    ['answer_text' => 'D) Sinalização educativa', 'is_correct' => false],
                ],
            ],
            [
                'category' => 'SINALIZAÇÃO',
                'question' => '8. Placas azuis geralmente indicam:',
                'type' => SimulatedType::TEORICO->value,
                'answers' => [
                    ['answer_text' => 'A) Perigo', 'is_correct' => false],
                    ['answer_text' => 'B) Serviços ou informações', 'is_correct' => true],
                    ['answer_text' => 'C) Proibição', 'is_correct' => false],
                    ['answer_text' => 'D) Obrigação', 'is_correct' => false],
                ],
            ],
            [
                'category' => 'SINALIZAÇÃO',
                'question' => '9. Uma placa com fundo branco e borda vermelha indica:',
                'type' => SimulatedType::TEORICO->value,
                'answers' => [
                    ['answer_text' => 'A) Proibição', 'is_correct' => true],
                    ['answer_text' => 'B) Informação', 'is_correct' => false],
                    ['answer_text' => 'C) Advertência', 'is_correct' => false],
                    ['answer_text' => 'D) Estacionamento', 'is_correct' => false],
                ],
            ],
            [
                'category' => 'SINALIZAÇÃO',
                'question' => '10. Placas com símbolo de criança indicam:',
                'type' => SimulatedType::TEORICO->value,
                'answers' => [
                    ['answer_text' => 'A) Área escolar', 'is_correct' => true],
                    ['answer_text' => 'B) Posto de saúde', 'is_correct' => false],
                    ['answer_text' => 'C) Estacionamento', 'is_correct' => false],
                    ['answer_text' => 'D) Farmácia', 'is_correct' => false],
                ],
            ],
            [
                'category' => 'SINALIZAÇÃO',
                'question' => '11. Uma seta preta sobre fundo branco indica:',
                'type' => SimulatedType::TEORICO->value,
                'answers' => [
                    ['answer_text' => 'A) Obrigação de virar', 'is_correct' => true],
                    ['answer_text' => 'B) Proibição de virar', 'is_correct' => false],
                    ['answer_text' => 'C) Advertência', 'is_correct' => false],
                    ['answer_text' => 'D) Informação', 'is_correct' => false],
                ],
            ],
            [
                'category' => 'SINALIZAÇÃO',
                'question' => '12. Qual sinal indica “curva acentuada à esquerda”?',
                'type' => SimulatedType::TEORICO->value,
                'answers' => [
                    ['answer_text' => 'A) Triangular amarela com seta curva para esquerda', 'is_correct' => true],
                    ['answer_text' => 'B) Retangular azul', 'is_correct' => false],
                    ['answer_text' => 'C) Circular vermelha', 'is_correct' => false],
                    ['answer_text' => 'D) Quadrada verde', 'is_correct' => false],
                ],
            ],
            [
                'category' => 'SINALIZAÇÃO',
                'question' => '13. Placa de sentido obrigatório é:',
                'type' => SimulatedType::TEORICO->value,
                'answers' => [
                    ['answer_text' => 'A) Azul com seta', 'is_correct' => true],
                    ['answer_text' => 'B) Vermelha com círculo', 'is_correct' => false],
                    ['answer_text' => 'C) Amarela triangular', 'is_correct' => false],
                    ['answer_text' => 'D) Branca com borda preta', 'is_correct' => false],
                ],
            ],
            [
                'category' => 'SINALIZAÇÃO',
                'question' => '14. Sinal de “pare” deve ser respeitado:',
                'type' => SimulatedType::TEORICO->value,
                'answers' => [
                    ['answer_text' => 'A) Apenas de dia', 'is_correct' => false],
                    ['answer_text' => 'B) Sempre', 'is_correct' => true],
                    ['answer_text' => 'C) Apenas em ruas movimentadas', 'is_correct' => false],
                    ['answer_text' => 'D) Apenas em estradas', 'is_correct' => false],
                ],
            ],
            [
                'category' => 'SINALIZAÇÃO',
                'question' => '15. Placa com carro derrapando indica:',
                'type' => SimulatedType::TEORICO->value,
                'answers' => [
                    ['answer_text' => 'A) Pavimento escorregadio', 'is_correct' => true],
                    ['answer_text' => 'B) Proibido parar', 'is_correct' => false],
                    ['answer_text' => 'C) Reduzir velocidade', 'is_correct' => false],
                    ['answer_text' => 'D) Área de pedestres', 'is_correct' => false],
                ],
            ],
            [
                'category' => 'SINALIZAÇÃO',
                'question' => '16. Placa de estacionamento obrigatório:',
                'type' => SimulatedType::TEORICO->value,
                'answers' => [
                    ['answer_text' => 'A) Azul com letra “E”', 'is_correct' => true],
                    ['answer_text' => 'B) Vermelha com borda branca', 'is_correct' => false],
                    ['answer_text' => 'C) Amarela triangular', 'is_correct' => false],
                    ['answer_text' => 'D) Verde', 'is_correct' => false],
                ],
            ],
            [
                'category' => 'SINALIZAÇÃO',
                'question' => '17. Qual a forma de placas de regulamentação?',
                'type' => SimulatedType::TEORICO->value,
                'answers' => [
                    ['answer_text' => 'A) Circular', 'is_correct' => true],
                    ['answer_text' => 'B) Triangular', 'is_correct' => false],
                    ['answer_text' => 'C) Retangular', 'is_correct' => false],
                    ['answer_text' => 'D) Quadrada', 'is_correct' => false],
                ],
            ],
            [
                'category' => 'SINALIZAÇÃO',
                'question' => '18. Sinal de atenção de cruzamento ferroviário:',
                'type' => SimulatedType::TEORICO->value,
                'answers' => [
                    ['answer_text' => 'A) Retangular', 'is_correct' => false],
                    ['answer_text' => 'B) Triangular com borda vermelha', 'is_correct' => true],
                    ['answer_text' => 'C) Circular', 'is_correct' => false],
                    ['answer_text' => 'D) Quadrada', 'is_correct' => false],
                ],
            ],
            [
                'category' => 'SINALIZAÇÃO',
                'question' => '19. Placa de “proibido ultrapassar” significa:',
                'type' => SimulatedType::TEORICO->value,
                'answers' => [
                    ['answer_text' => 'A) Nenhum veículo pode ultrapassar', 'is_correct' => true],
                    ['answer_text' => 'B) Apenas caminhões', 'is_correct' => false],
                    ['answer_text' => 'C) Apenas carros', 'is_correct' => false],
                    ['answer_text' => 'D) Apenas ônibus', 'is_correct' => false],
                ],
            ],
            [
                'category' => 'SINALIZAÇÃO',
                'question' => '20. Placa azul com símbolo de hospital indica:',
                'type' => SimulatedType::TEORICO->value,
                'answers' => [
                    ['answer_text' => 'A) Informações de serviços', 'is_correct' => true],
                    ['answer_text' => 'B) Perigo', 'is_correct' => false],
                    ['answer_text' => 'C) Proibição', 'is_correct' => false],
                    ['answer_text' => 'D) Advertência', 'is_correct' => false],
                ],
            ],

            // --- LEGISLAÇÃO DE TRÂNSITO (20 Questões) ---
            [
                'category' => 'LEGISLAÇÃO DE TRÂNSITO',
                'question' => '21. A CNH de categoria B permite dirigir:',
                'type' => SimulatedType::TEORICO->value,
                'answers' => [
                    ['answer_text' => 'A) Motos', 'is_correct' => false],
                    ['answer_text' => 'B) Carros', 'is_correct' => true],
                    ['answer_text' => 'C) Ônibus', 'is_correct' => false],
                    ['answer_text' => 'D) Caminhões', 'is_correct' => false],
                ],
            ],
            [
                'category' => 'LEGISLAÇÃO DE TRÂNSITO',
                'question' => '22. O condutor que dirigir sob efeito de álcool está cometendo:',
                'type' => SimulatedType::TEORICO->value,
                'answers' => [
                    ['answer_text' => 'A) Infração leve', 'is_correct' => false],
                    ['answer_text' => 'B) Infração gravíssima', 'is_correct' => true],
                    ['answer_text' => 'C) Infração média', 'is_correct' => false],
                    ['answer_text' => 'D) Nenhuma', 'is_correct' => false],
                ],
            ],
            [
                'category' => 'LEGISLAÇÃO DE TRÂNSITO',
                'question' => '23. O que é infração gravíssima?',
                'type' => SimulatedType::TEORICO->value,
                'answers' => [
                    ['answer_text' => 'A) Multa alta e pontos na CNH', 'is_correct' => true],
                    ['answer_text' => 'B) Apenas advertência', 'is_correct' => false],
                    ['answer_text' => 'C) Multa baixa', 'is_correct' => false],
                    ['answer_text' => 'D) Nenhuma consequência', 'is_correct' => false],
                ],
            ],
            [
                'category' => 'LEGISLAÇÃO DE TRÂNSITO',
                'question' => '24. A velocidade máxima em vias urbanas é, geralmente:',
                'type' => SimulatedType::TEORICO->value,
                'answers' => [
                    ['answer_text' => 'A) 60 km/h', 'is_correct' => true],
                    ['answer_text' => 'B) 80 km/h', 'is_correct' => false],
                    ['answer_text' => 'C) 100 km/h', 'is_correct' => false],
                    ['answer_text' => 'D) 40 km/h', 'is_correct' => false],
                ],
            ],
            [
                'category' => 'LEGISLAÇÃO DE TRÂNSITO',
                'question' => '25. O uso do cinto de segurança é:',
                'type' => SimulatedType::TEORICO->value,
                'answers' => [
                    ['answer_text' => 'A) Obrigatório', 'is_correct' => true],
                    ['answer_text' => 'B) Opcional', 'is_correct' => false],
                    ['answer_text' => 'C) Apenas em rodovias', 'is_correct' => false],
                    ['answer_text' => 'D) Apenas no banco dianteiro', 'is_correct' => false],
                ],
            ],
            [
                'category' => 'LEGISLAÇÃO DE TRÂNSITO',
                'question' => '26. Ultrapassar pela direita é permitido:',
                'type' => SimulatedType::TEORICO->value,
                'answers' => [
                    ['answer_text' => 'A) Sempre', 'is_correct' => false],
                    ['answer_text' => 'B) Apenas em pistas com mais de uma faixa', 'is_correct' => true],
                    ['answer_text' => 'C) Nunca', 'is_correct' => false],
                    ['answer_text' => 'D) Apenas em estradas', 'is_correct' => false],
                ],
            ],
            [
                'category' => 'LEGISLAÇÃO DE TRÂNSITO',
                'question' => '27. É obrigatório o uso de capacete em:',
                'type' => SimulatedType::TEORICO->value,
                'answers' => [
                    ['answer_text' => 'A) Bicicleta', 'is_correct' => false],
                    ['answer_text' => 'B) Motocicleta', 'is_correct' => true],
                    ['answer_text' => 'C) Carro', 'is_correct' => false],
                    ['answer_text' => 'D) Ônibus', 'is_correct' => false],
                ],
            ],
            [
                'category' => 'LEGISLAÇÃO DE TRÂNSITO',
                'question' => '28. Um condutor com suspensão da CNH deve:',
                'type' => SimulatedType::TEORICO->value,
                'answers' => [
                    ['answer_text' => 'A) Continuar dirigindo', 'is_correct' => false],
                    ['answer_text' => 'B) Entregar a CNH', 'is_correct' => true],
                    ['answer_text' => 'C) Renovar CNH', 'is_correct' => false],
                    ['answer_text' => 'D) Apenas pagar multa', 'is_correct' => false],
                ],
            ],
            [
                'category' => 'LEGISLAÇÃO DE TRÂNSITO',
                'question' => '29. Quem está acima de 20 pontos na CNH:',
                'type' => SimulatedType::TEORICO->value,
                'answers' => [
                    ['answer_text' => 'A) Pode dirigir normalmente', 'is_correct' => false],
                    ['answer_text' => 'B) Sofre suspensão', 'is_correct' => true],
                    ['answer_text' => 'C) Só recebe advertência', 'is_correct' => false],
                    ['answer_text' => 'D) Perde o veículo', 'is_correct' => false],
                ],
            ],
            [
                'category' => 'LEGISLAÇÃO DE TRÂNSITO',
                'question' => '30. Em caso de acidente sem vítima, o condutor deve:',
                'type' => SimulatedType::TEORICO->value,
                'answers' => [
                    ['answer_text' => 'A) Sair do local imediatamente', 'is_correct' => false],
                    ['answer_text' => 'B) Preencher ocorrência de trânsito', 'is_correct' => true],
                    ['answer_text' => 'C) Ligar para imprensa', 'is_correct' => false],
                    ['answer_text' => 'D) Ignorar o acidente', 'is_correct' => false],
                ],
            ],
            [
                'category' => 'LEGISLAÇÃO DE TRÂNSITO',
                'question' => '31. O condutor deve dar preferência a pedestres:',
                'type' => SimulatedType::TEORICO->value,
                'answers' => [
                    ['answer_text' => 'A) Apenas em faixas', 'is_correct' => false],
                    ['answer_text' => 'B) Sempre', 'is_correct' => true],
                    ['answer_text' => 'C) Apenas no centro da cidade', 'is_correct' => false],
                    ['answer_text' => 'D) Apenas à noite', 'is_correct' => false],
                ],
            ],
            [
                'category' => 'LEGISLAÇÃO DE TRÂNSITO',
                'question' => '32. A infração de estacionar em local proibido é:',
                'type' => SimulatedType::TEORICO->value,
                'answers' => [
                    ['answer_text' => 'A) Leve', 'is_correct' => false],
                    ['answer_text' => 'B) Média', 'is_correct' => true],
                    ['answer_text' => 'C) Grave', 'is_correct' => false],
                    ['answer_text' => 'D) Gravíssima', 'is_correct' => false],
                ],
            ],
            [
                'category' => 'LEGISLAÇÃO DE TRÂNSITO',
                'question' => '33. O que é faixa exclusiva para ônibus?',
                'type' => SimulatedType::TEORICO->value,
                'answers' => [
                    ['answer_text' => 'A) Para qualquer veículo', 'is_correct' => false],
                    ['answer_text' => 'B) Apenas para transporte público', 'is_correct' => true],
                    ['answer_text' => 'C) Para carros e motos', 'is_correct' => false],
                    ['answer_text' => 'D) Para bicicletas', 'is_correct' => false],
                ],
            ],
            [
                'category' => 'LEGISLAÇÃO DE TRÂNSITO',
                'question' => '34. Sinalização luminosa vermelha indica:',
                'type' => SimulatedType::TEORICO->value,
                'answers' => [
                    ['answer_text' => 'A) Pare', 'is_correct' => true],
                    ['answer_text' => 'B) Siga', 'is_correct' => false],
                    ['answer_text' => 'C) Atenção', 'is_correct' => false],
                    ['answer_text' => 'D) Reduza velocidade', 'is_correct' => false],
                ],
            ],
            [
                'category' => 'LEGISLAÇÃO DE TRÂNSITO',
                'question' => '35. É permitido usar celular ao dirigir:',
                'type' => SimulatedType::TEORICO->value,
                'answers' => [
                    ['answer_text' => 'A) Sim, em qualquer situação', 'is_correct' => false],
                    ['answer_text' => 'B) Não, apenas com viva-voz', 'is_correct' => true],
                    ['answer_text' => 'C) Apenas de dia', 'is_correct' => false],
                    ['answer_text' => 'D) Apenas no trânsito lento', 'is_correct' => false],
                ],
            ],
            [
                'category' => 'LEGISLAÇÃO DE TRÂNSITO',
                'question' => '36. CNH vencida há mais de 30 dias:',
                'type' => SimulatedType::TEORICO->value,
                'answers' => [
                    ['answer_text' => 'A) Pode dirigir normalmente', 'is_correct' => false],
                    ['answer_text' => 'B) Não pode dirigir', 'is_correct' => true],
                    ['answer_text' => 'C) Apenas em estrada', 'is_correct' => false],
                    ['answer_text' => 'D) Apenas em cidade pequena', 'is_correct' => false],
                ],
            ],
            [
                'category' => 'LEGISLAÇÃO DE TRÂNSITO',
                'question' => '37. Em caso de chuva, a velocidade deve ser:',
                'type' => SimulatedType::TEORICO->value,
                'answers' => [
                    ['answer_text' => 'A) Mantida', 'is_correct' => false],
                    ['answer_text' => 'B) Reduzida', 'is_correct' => true],
                    ['answer_text' => 'C) Aumentada', 'is_correct' => false],
                    ['answer_text' => 'D) Ignorada', 'is_correct' => false],
                ],
            ],
            [
                'category' => 'LEGISLAÇÃO DE TRÂNSITO',
                'question' => '38. Qual é a idade mínima para CNH categoria B?',
                'type' => SimulatedType::TEORICO->value,
                'answers' => [
                    ['answer_text' => 'A) 16 anos', 'is_correct' => false],
                    ['answer_text' => 'B) 18 anos', 'is_correct' => true],
                    ['answer_text' => 'C) 21 anos', 'is_correct' => false],
                    ['answer_text' => 'D) 20 anos', 'is_correct' => false],
                ],
            ],
            [
                'category' => 'LEGISLAÇÃO DE TRÂNSITO',
                'question' => '39. Multa por avanço de sinal vermelho é:',
                'type' => SimulatedType::TEORICO->value,
                'answers' => [
                    ['answer_text' => 'A) Leve', 'is_correct' => false],
                    ['answer_text' => 'B) Grave', 'is_correct' => false],
                    ['answer_text' => 'C) Gravíssima', 'is_correct' => true],
                    ['answer_text' => 'D) Média', 'is_correct' => false],
                ],
            ],
            [
                'category' => 'LEGISLAÇÃO DE TRÂNSITO',
                'question' => '40. Para dirigir veículos pesados, precisa de CNH:',
                'type' => SimulatedType::TEORICO->value,
                'answers' => [
                    ['answer_text' => 'A) A', 'is_correct' => false],
                    ['answer_text' => 'B) B', 'is_correct' => false],
                    ['answer_text' => 'C) C', 'is_correct' => true],
                    ['answer_text' => 'D) D', 'is_correct' => false],
                ],
            ],

            // --- DIREÇÃO DEFENSIVA (10 Questões) ---
            [
                'category' => 'DIREÇÃO DEFENSIVA',
                'question' => '41. Qual é a principal atitude do condutor defensivo?',
                'type' => SimulatedType::TEORICO->value,
                'answers' => [
                    ['answer_text' => 'A) Dirigir rápido', 'is_correct' => false],
                    ['answer_text' => 'B) Antecipar riscos', 'is_correct' => true],
                    ['answer_text' => 'C) Acelerar antes do semáforo', 'is_correct' => false],
                    ['answer_text' => 'D) Passar entre veículos', 'is_correct' => false],
                ],
            ],
            [
                'category' => 'DIREÇÃO DEFENSIVA',
                'question' => '42. Manter distância segura do veículo à frente serve para:',
                'type' => SimulatedType::TEORICO->value,
                'answers' => [
                    ['answer_text' => 'A) Evitar colisões', 'is_correct' => true],
                    ['answer_text' => 'B) Aumentar velocidade', 'is_correct' => false],
                    ['answer_text' => 'C) Economizar combustível', 'is_correct' => false],
                    ['answer_text' => 'D) Melhorar a visão', 'is_correct' => false],
                ],
            ],
            [
                'category' => 'DIREÇÃO DEFENSIVA',
                'question' => '43. O que é ponto cego?',
                'type' => SimulatedType::TEORICO->value,
                'answers' => [
                    ['answer_text' => 'A) Área que o motorista vê claramente', 'is_correct' => false],
                    ['answer_text' => 'B) Área que não é visível pelos retrovisores', 'is_correct' => true],
                    ['answer_text' => 'C) Área da calçada', 'is_correct' => false],
                    ['answer_text' => 'D) Área do farol', 'is_correct' => false],
                ],
            ],
            [
                'category' => 'DIREÇÃO DEFENSIVA',
                'question' => '44. Ao dirigir na chuva, é importante:',
                'type' => SimulatedType::TEORICO->value,
                'answers' => [
                    ['answer_text' => 'A) Acelerar para passar rápido', 'is_correct' => false],
                    ['answer_text' => 'B) Reduzir velocidade', 'is_correct' => true],
                    ['answer_text' => 'C) Manter farol apagado', 'is_correct' => false],
                    ['answer_text' => 'D) Usar apenas a buzina', 'is_correct' => false],
                ],
            ],
            [
                'category' => 'DIREÇÃO DEFENSIVA',
                'question' => '45. Ultrapassagem segura deve ser feita:',
                'type' => SimulatedType::TEORICO->value,
                'answers' => [
                    ['answer_text' => 'A) Pela direita em qualquer via', 'is_correct' => false],
                    ['answer_text' => 'B) Pela esquerda, com visibilidade', 'is_correct' => true],
                    ['answer_text' => 'C) A qualquer momento', 'is_correct' => false],
                    ['answer_text' => 'D) Sem sinalizar', 'is_correct' => false],
                ],
            ],
            [
                'category' => 'DIREÇÃO DEFENSIVA',
                'question' => '46. O que indica fadiga ao dirigir?',
                'type' => SimulatedType::TEORICO->value,
                'answers' => [
                    ['answer_text' => 'A) Olhos pesados e bocejos', 'is_correct' => true],
                    ['answer_text' => 'B) Vontade de acelerar', 'is_correct' => false],
                    ['answer_text' => 'C) Vontade de buzinar', 'is_correct' => false],
                    ['answer_text' => 'D) Aumento de atenção', 'is_correct' => false],
                ],
            ],
            [
                'category' => 'DIREÇÃO DEFENSIVA',
                'question' => '47. Em rodovias, dirigir muito próximo de outro veículo é:',
                'type' => SimulatedType::TEORICO->value,
                'answers' => [
                    ['answer_text' => 'A) Seguro', 'is_correct' => false],
                    ['answer_text' => 'B) Perigoso', 'is_correct' => true],
                    ['answer_text' => 'C) Obrigatório', 'is_correct' => false],
                    ['answer_text' => 'D) Opcional', 'is_correct' => false],
                ],
            ],
            [
                'category' => 'DIREÇÃO DEFENSIVA',
                'question' => '48. Ao se aproximar de cruzamentos, o condutor defensivo deve:',
                'type' => SimulatedType::TEORICO->value,
                'answers' => [
                    ['answer_text' => 'A) Reduzir a velocidade e observar', 'is_correct' => true],
                    ['answer_text' => 'B) Acelerar para passar primeiro', 'is_correct' => false],
                    ['answer_text' => 'C) Ignorar pedestres', 'is_correct' => false],
                    ['answer_text' => 'D) Buzinar sempre', 'is_correct' => false],
                ],
            ],
            [
                'category' => 'DIREÇÃO DEFENSIVA',
                'question' => '49. Uso do cinto de segurança ajuda a:',
                'type' => SimulatedType::TEORICO->value,
                'answers' => [
                    ['answer_text' => 'A) Evitar colisão', 'is_correct' => false],
                    ['answer_text' => 'B) Minimizar ferimentos', 'is_correct' => true],
                    ['answer_text' => 'C) Dirigir mais rápido', 'is_correct' => false],
                    ['answer_text' => 'D) Economizar combustível', 'is_correct' => false],
                ],
            ],
            [
                'category' => 'DIREÇÃO DEFENSIVA',
                'question' => '50. Dirigir com atenção significa:',
                'type' => SimulatedType::TEORICO->value,
                'answers' => [
                    ['answer_text' => 'A) Focar apenas no veículo à frente', 'is_correct' => false],
                    ['answer_text' => 'B) Observar ambiente, pedestres e veículos', 'is_correct' => true],
                    ['answer_text' => 'C) Ouvir música alta', 'is_correct' => false],
                    ['answer_text' => 'D) Conversar no celular', 'is_correct' => false],
                ],
            ],

            // --- MECÂNICA BÁSICA (10 Questões) ---
            [
                'category' => 'MECÂNICA BÁSICA',
                'question' => '51. Qual a função do freio?',
                'type' => SimulatedType::TEORICO->value,
                'answers' => [
                    ['answer_text' => 'A) Acelerar', 'is_correct' => false],
                    ['answer_text' => 'B) Reduzir ou parar', 'is_correct' => true],
                    ['answer_text' => 'C) Estabilizar o volante', 'is_correct' => false],
                    ['answer_text' => 'D) Economizar combustível', 'is_correct' => false],
                ],
            ],
            [
                'category' => 'MECÂNICA BÁSICA',
                'question' => '52. Pneus carecas:',
                'type' => SimulatedType::TEORICO->value,
                'answers' => [
                    ['answer_text' => 'A) Aumentam a aderência', 'is_correct' => false],
                    ['answer_text' => 'B) Reduzem a aderência', 'is_correct' => true],
                    ['answer_text' => 'C) Não influenciam na segurança', 'is_correct' => false],
                    ['answer_text' => 'D) Aumentam a velocidade', 'is_correct' => false],
                ],
            ],
            [
                'category' => 'MECÂNICA BÁSICA',
                'question' => '53. O que é calibragem correta dos pneus?',
                'type' => SimulatedType::TEORICO->value,
                'answers' => [
                    ['answer_text' => 'A) Pressão recomendada pelo fabricante', 'is_correct' => true],
                    ['answer_text' => 'B) O máximo de pressão possível', 'is_correct' => false],
                    ['answer_text' => 'C) Pneus vazios', 'is_correct' => false],
                    ['answer_text' => 'D) Qualquer valor acima de 40 PSI', 'is_correct' => false],
                ],
            ],
            [
                'category' => 'MECÂNICA BÁSICA',
                'question' => '54. Óleo do motor serve para:',
                'type' => SimulatedType::TEORICO->value,
                'answers' => [
                    ['answer_text' => 'A) Lubrificar e reduzir atrito', 'is_correct' => true],
                    ['answer_text' => 'B) Aumentar velocidade', 'is_correct' => false],
                    ['answer_text' => 'C) Reduzir consumo de gasolina', 'is_correct' => false],
                    ['answer_text' => 'D) Limpar o vidro', 'is_correct' => false],
                ],
            ],
            [
                'category' => 'MECÂNICA BÁSICA',
                'question' => '55. Bateria descarregada impede:',
                'type' => SimulatedType::TEORICO->value,
                'answers' => [
                    ['answer_text' => 'A) Apenas ligar o ar-condicionado', 'is_correct' => false],
                    ['answer_text' => 'B) Partida do veículo', 'is_correct' => true],
                    ['answer_text' => 'C) Uso de faróis', 'is_correct' => false],
                    ['answer_text' => 'D) Fechamento das portas', 'is_correct' => false],
                ],
            ],
            [
                'category' => 'MECÂNICA BÁSICA',
                'question' => '56. Faróis apagados à noite:',
                'type' => SimulatedType::TEORICO->value,
                'answers' => [
                    ['answer_text' => 'A) Não têm importância', 'is_correct' => false],
                    ['answer_text' => 'B) Colocam em risco', 'is_correct' => true],
                    ['answer_text' => 'C) Economizam energia', 'is_correct' => false],
                    ['answer_text' => 'D) Apenas incomodam outros motoristas', 'is_correct' => false],
                ],
            ],
            [
                'category' => 'MECÂNICA BÁSICA',
                'question' => '57. O que é alinhamento de rodas?',
                'type' => SimulatedType::TEORICO->value,
                'answers' => [
                    ['answer_text' => 'A) Ajuste de pneus e direção', 'is_correct' => true],
                    ['answer_text' => 'B) Pintura do carro', 'is_correct' => false],
                    ['answer_text' => 'C) Troca de óleo', 'is_correct' => false],
                    ['answer_text' => 'D) Limpeza do motor', 'is_correct' => false],
                ],
            ],
            [
                'category' => 'MECÂNICA BÁSICA',
                'question' => '58. Luz de advertência do motor acesa indica:',
                'type' => SimulatedType::TEORICO->value,
                'answers' => [
                    ['answer_text' => 'A) Problema no motor', 'is_correct' => true],
                    ['answer_text' => 'B) Farol queimado', 'is_correct' => false],
                    ['answer_text' => 'C) Pneus furados', 'is_correct' => false],
                    ['answer_text' => 'D) Nada', 'is_correct' => false],
                ],
            ],
            [
                'category' => 'MECÂNICA BÁSICA',
                'question' => '59. Água do radiador serve para:',
                'type' => SimulatedType::TEORICO->value,
                'answers' => [
                    ['answer_text' => 'A) Limpar o motor', 'is_correct' => false],
                    ['answer_text' => 'B) Refrigerar o motor', 'is_correct' => true],
                    ['answer_text' => 'C) Limpar vidros', 'is_correct' => false],
                    ['answer_text' => 'D) Aumentar potência', 'is_correct' => false],
                ],
            ],
            [
                'category' => 'MECÂNICA BÁSICA',
                'question' => '60. Uso correto de limpador de para-brisa em chuva:',
                'type' => SimulatedType::TEORICO->value,
                'answers' => [
                    ['answer_text' => 'A) Aumentar velocidade', 'is_correct' => false],
                    ['answer_text' => 'B) Manter visibilidade', 'is_correct' => true],
                    ['answer_text' => 'C) Apenas de dia', 'is_correct' => false],
                    ['answer_text' => 'D) Apenas em estrada', 'is_correct' => false],
                ],
            ],

            // --- PRIMEIROS SOCORROS (10 Questões) ---
            [
                'category' => 'PRIMEIROS SOCORROS',
                'question' => '61. Ao presenciar acidente, primeiro passo é:',
                'type' => SimulatedType::TEORICO->value,
                'answers' => [
                    ['answer_text' => 'A) Ajudar sem segurança', 'is_correct' => false],
                    ['answer_text' => 'B) Sinalizar e garantir segurança', 'is_correct' => true],
                    ['answer_text' => 'C) Chamar imprensa', 'is_correct' => false],
                    ['answer_text' => 'D) Fotografar o local', 'is_correct' => false],
                ],
            ],
            [
                'category' => 'PRIMEIROS SOCORROS',
                'question' => '62. Pessoa consciente e sangrando:',
                'type' => SimulatedType::TEORICO->value,
                'answers' => [
                    ['answer_text' => 'A) Parar sangramento', 'is_correct' => true],
                    ['answer_text' => 'B) Dar água', 'is_correct' => false],
                    ['answer_text' => 'C) Movimentar desnecessariamente', 'is_correct' => false],
                    ['answer_text' => 'D) Ignorar', 'is_correct' => false],
                ],
            ],
            [
                'category' => 'PRIMEIROS SOCORROS',
                'question' => '63. Pessoa inconsciente e respirando:',
                'type' => SimulatedType::TEORICO->value,
                'answers' => [
                    ['answer_text' => 'A) Deitar-se de lado', 'is_correct' => true],
                    ['answer_text' => 'B) Deitar-se de barriga para cima', 'is_correct' => false],
                    ['answer_text' => 'C) Movimentar', 'is_correct' => false],
                    ['answer_text' => 'D) Não chamar ajuda', 'is_correct' => false],
                ],
            ],
            [
                'category' => 'PRIMEIROS SOCORROS',
                'question' => '64. Pessoa inconsciente e sem respirar:',
                'type' => SimulatedType::TEORICO->value,
                'answers' => [
                    ['answer_text' => 'A) Nada', 'is_correct' => false],
                    ['answer_text' => 'B) Iniciar RCP', 'is_correct' => true],
                    ['answer_text' => 'C) Dar água', 'is_correct' => false],
                    ['answer_text' => 'D) Esperar socorro', 'is_correct' => false],
                ],
            ],
            [
                'category' => 'PRIMEIROS SOCORROS',
                'question' => '65. Fratura aberta:',
                'type' => SimulatedType::TEORICO->value,
                'answers' => [
                    ['answer_text' => 'A) Pressionar fortemente', 'is_correct' => false],
                    ['answer_text' => 'B) Imobilizar', 'is_correct' => true],
                    ['answer_text' => 'C) Massagear', 'is_correct' => false],
                    ['answer_text' => 'D) Dobrar o membro', 'is_correct' => false],
                ],
            ],
            [
                'category' => 'PRIMEIROS SOCORROS',
                'question' => '66. Queimadura leve deve ser tratada com:',
                'type' => SimulatedType::TEORICO->value,
                'answers' => [
                    ['answer_text' => 'A) Gelo diretamente', 'is_correct' => false],
                    ['answer_text' => 'B) Água corrente', 'is_correct' => true],
                    ['answer_text' => 'C) Óleo', 'is_correct' => false],
                    ['answer_text' => 'D) Sal', 'is_correct' => false],
                ],
            ],
            [
                'category' => 'PRIMEIROS SOCORROS',
                'question' => '67. Pessoa engasgada e consciente:',
                'type' => SimulatedType::TEORICO->value,
                'answers' => [
                    ['answer_text' => 'A) Esperar', 'is_correct' => false],
                    ['answer_text' => 'B) Realizar manobra de Heimlich', 'is_correct' => true],
                    ['answer_text' => 'C) Dar água', 'is_correct' => false],
                    ['answer_text' => 'D) Chamar polícia', 'is_correct' => false],
                ],
            ],
            [
                'category' => 'PRIMEIROS SOCORROS',
                'question' => '68. Hemorragia intensa deve ser controlada com:',
                'type' => SimulatedType::TEORICO->value,
                'answers' => [
                    ['answer_text' => 'A) Compressão direta', 'is_correct' => true],
                    ['answer_text' => 'B) Água', 'is_correct' => false],
                    ['answer_text' => 'C) Massagem', 'is_correct' => false],
                    ['answer_text' => 'D) Nada', 'is_correct' => false],
                ],
            ],
            [
                'category' => 'PRIMEIROS SOCORROS',
                'question' => '69. Acidente com vítima de choque elétrico:',
                'type' => SimulatedType::TEORICO->value,
                'answers' => [
                    ['answer_text' => 'A) Tocar a vítima', 'is_correct' => false],
                    ['answer_text' => 'B) Desligar a fonte antes', 'is_correct' => true],
                    ['answer_text' => 'C) Puxar com as mãos', 'is_correct' => false],
                    ['answer_text' => 'D) Ignorar', 'is_correct' => false],
                ],
            ],
            [
                'category' => 'PRIMEIROS SOCORROS',
                'question' => '70. Ao acionar o SAMU, deve-se informar:',
                'type' => SimulatedType::TEORICO->value,
                'answers' => [
                    ['answer_text' => 'A) Nome do operador', 'is_correct' => false],
                    ['answer_text' => 'B) Local e situação', 'is_correct' => true],
                    ['answer_text' => 'C) Apenas endereço', 'is_correct' => false],
                    ['answer_text' => 'D) Apenas número de pessoas', 'is_correct' => false],
                ],
            ],

            // Questão 71: Ajuste do Banco/Pernas
            [
                'category' => 'PRATICO',
                'question' => '71. Ao ajustar o banco do motorista, a distância correta dos pedais é atingida quando, ao pisar fundo no pedal da embreagem, a perna esquerda está:',
                'type' => SimulatedType::PRATICO->value,
                'images' => ['https://i.imgur.com/gXfF5Xr.jpeg'],
                'answers' => [
                    ['answer_text' => 'A) Completamente esticada, sem flexão', 'is_correct' => false],
                    ['answer_text' => 'B) Levemente flexionada', 'is_correct' => true],
                    ['answer_text' => 'C) Bastante flexionada, quase dobrada', 'is_correct' => false],
                    ['answer_text' => 'D) Apenas o pé consegue tocar o pedal, sem que a perna se mova', 'is_correct' => false],
                ],
            ],

            // Questão 72: Ordem dos Pedais
            [
                'category' => 'PRATICO',
                'question' => '72. Qual é a ordem correta dos pedais em um veículo de câmbio manual, da esquerda para a direita?',
                'type' => SimulatedType::PRATICO->value,
                'images' => ['https://i.imgur.com/gXfF5Xr.jpeg'],
                'answers' => [
                    ['answer_text' => 'A) Freio, Embreagem e Acelerador', 'is_correct' => false],
                    ['answer_text' => 'B) Embreagem, Acelerador e Freio', 'is_correct' => false],
                    ['answer_text' => 'C) Embreagem, Freio e Acelerador', 'is_correct' => true],
                    ['answer_text' => 'D) Freio, Acelerador e Embreagem', 'is_correct' => false],
                ],
            ],

            // Questão 73: Uso do Pedal da Embreagem
            [
                'category' => 'PRATICO',
                'question' => '73. Qual pé é utilizado para acionar, de forma exclusiva, o pedal da embreagem em um veículo de câmbio manual?',
                'type' => SimulatedType::PRATICO->value,
                'images' => ['https://i.imgur.com/gXfF5Xr.jpeg'],
                'answers' => [
                    ['answer_text' => 'A) O pé direito', 'is_correct' => false],
                    ['answer_text' => 'B) Ambos os pés, dependendo da manobra', 'is_correct' => false],
                    ['answer_text' => 'C) O pé esquerdo', 'is_correct' => true],
                    ['answer_text' => 'D) Nenhum, ele é automático', 'is_correct' => false],
                ],
            ],

            // Questão 74: Ajuste do Retrovisor
            [
                'category' => 'PRATICO',
                'question' => '74. Qual é o ajuste ideal para o retrovisor lateral esquerdo que maximiza a visibilidade da pista?',
                'type' => SimulatedType::PRATICO->value,
                'images' => ['https://i.imgur.com/gXfF5Xr.jpeg'],
                'answers' => [
                    ['answer_text' => 'A) Deve mostrar apenas o céu e a linha do horizonte', 'is_correct' => false],
                    ['answer_text' => 'B) Deve mostrar a lateral do carro de forma que apenas uma pequena porção da traseira do veículo seja visível', 'is_correct' => true],
                    ['answer_text' => 'C) Deve mostrar 50% do carro e 50% da pista para ter a melhor referência de distância', 'is_correct' => false],
                    ['answer_text' => 'D) Deve mostrar apenas os veículos que estão ultrapassando', 'is_correct' => false],
                ],
            ],

            // Questão 75: Posição para Partida
            [
                'category' => 'PRATICO',
                'question' => '75. Ao iniciar o procedimento de partida (ligar o motor) em um carro manual, a alavanca de câmbio deve estar, preferencialmente, em qual posição (além de pisar na embreagem)?',
                'type' => SimulatedType::PRATICO->value,
                'images' => ['https://i.imgur.com/gXfF5Xr.jpeg'],
                'answers' => [
                    ['answer_text' => 'A) Na primeira marcha', 'is_correct' => false],
                    ['answer_text' => 'B) Na marcha Ré', 'is_correct' => false],
                    ['answer_text' => 'C) Ponto Morto (Neutro)', 'is_correct' => true],
                    ['answer_text' => 'D) Na terceira marcha', 'is_correct' => false],
                ],
            ],

            // Questão 76: Comando de Segurança Após Partida
            [
                'category' => 'PRATICO',
                'question' => '76. Após dar a partida no motor e engatar a primeira marcha para sair, qual é o próximo passo fundamental relacionado aos comandos de segurança?',
                'type' => SimulatedType::PRATICO->value,
                'images' => ['https://i.imgur.com/gXfF5Xr.jpeg'],
                'answers' => [
                    ['answer_text' => 'A) Ajustar o banco novamente', 'is_correct' => false],
                    ['answer_text' => 'B) Ligar o farol alto', 'is_correct' => false],
                    ['answer_text' => 'C) Soltar o freio de mão completamente', 'is_correct' => true],
                    ['answer_text' => 'D) Colocar o pé esquerdo sobre o acelerador', 'is_correct' => false],
                ],
            ],

            // Questão 77: Luz-Espia de Óleo
            [
                'category' => 'PRATICO',
                'question' => '77. Uma luz-espia na cor **vermelha** no painel de instrumentos, em formato de uma almotolia (lamparina com gota), acende e permanece ligada após a partida. O que ela indica?',
                'type' => SimulatedType::PRATICO->value,
                'images' => ['https://i.imgur.com/gXfF5Xr.jpeg'],
                'answers' => [
                    ['answer_text' => 'A) O freio de mão está parcialmente puxado', 'is_correct' => false],
                    ['answer_text' => 'B) Baixa pressão ou nível insuficiente de óleo lubrificante no motor', 'is_correct' => true],
                    ['answer_text' => 'C) A bateria está descarregada ou com problema no alternador', 'is_correct' => false],
                    ['answer_text' => 'D) O motor está superaquecido', 'is_correct' => false],
                ],
            ],

            // Questão 78: Marcha de Saída
            [
                'category' => 'PRATICO',
                'question' => '78. Qual marcha deve ser engatada para iniciar o movimento do veículo em uma via plana, saindo da imobilidade?',
                'type' => SimulatedType::PRATICO->value,
                'images' => ['https://i.imgur.com/gXfF5Xr.jpeg'],
                'answers' => [
                    ['answer_text' => 'A) Segunda marcha', 'is_correct' => false],
                    ['answer_text' => 'B) Terceira marcha', 'is_correct' => false],
                    ['answer_text' => 'C) Primeira marcha', 'is_correct' => true],
                    ['answer_text' => 'D) A marcha Ré', 'is_correct' => false],
                ],
            ],

            // Questão 79: Uso da Seta
            [
                'category' => 'PRATICO',
                'question' => '79. Para garantir a fluidez e a segurança do trânsito, o condutor deve acionar a alavanca da seta (pisca) em relação à manobra (como sair da vaga de estacionamento ou mudar de faixa):',
                'type' => SimulatedType::PRATICO->value,
                'images' => ['https://i.imgur.com/gXfF5Xr.jpeg'],
                'answers' => [
                    ['answer_text' => 'A) Durante a manobra', 'is_correct' => false],
                    ['answer_text' => 'B) Após a manobra', 'is_correct' => false],
                    ['answer_text' => 'C) Em qualquer momento, desde que acionada', 'is_correct' => false],
                    ['answer_text' => 'D) Antes de iniciar a manobra', 'is_correct' => true],
                ],
            ],

            // Questão 80: Ajuste do Encosto/Volante
            [
                'category' => 'PRATICO',
                'question' => '80. Qual o método correto para verificar se a inclinação do encosto do banco está adequada (na altura dos ombros)?',
                'type' => SimulatedType::PRATICO->value,
                'images' => ['https://i.imgur.com/gXfF5Xr.jpeg'],
                'answers' => [
                    ['answer_text' => 'A) Esticar os braços e verificar se os dedos alcançam o para-brisa', 'is_correct' => false],
                    ['answer_text' => 'B) Os punhos devem tocar o topo do volante com os braços esticados e as costas apoiadas no encosto', 'is_correct' => true],
                    ['answer_text' => 'C) O encosto deve estar totalmente reto, a 90 graus, para maior atenção', 'is_correct' => false],
                    ['answer_text' => 'D) O encosto deve estar inclinado o máximo possível para trás para conforto', 'is_correct' => false],
                ],
            ],

        ];


        foreach ($questionsData as $data) {
            if (!isset($data['question'])) {
                $this->command->error('Questão sem chave "question" encontrada. Verifique o QuestionSeeder.');
                continue; // Pula esse item
            }
            $cleanedQuestion = preg_replace('/^\d+\.\s*/', '', $data['question']);
            $categoryId = $categoryMap[$data['category']];

            $imagesData = $data['images'] ?? null;
            $imagesToInsert = ($imagesData !== null) ? json_encode($imagesData) : null;

            $questionId = DB::table('questions')->insertGetId([
                'question' => $cleanedQuestion,
                'category_id' => $categoryId,
                'type' => $data['type'],
                'images' => $imagesToInsert,
                'video' => null,
                'common_mistakes' => false,
                'id_question' => Str::uuid()->toString(),
                'created_at' => now(),
                'updated_at' => now()
            ]);


            $answersForJson = [];
            foreach ($data['answers'] as $answer) {

                $cleanedAnswer = preg_replace('/^[A-D]\)\s*/', '', $answer['answer_text']);

                $answersForJson[] = [
                    'text' => $cleanedAnswer,
                    'is_correct' => $answer['is_correct']
                ];
            }

            DB::table('answers')->insert([
                'question_id' => $questionId,
                'answer_text' => json_encode($answersForJson),
                'is_correct' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

        }

    }
}
