<?php
require_once __DIR__ . '/Pokemon.php';

class Weepinbell extends Pokemon {
    private string $special = 'Razor Leaf';

    public function __construct(int $level = 5, int $hp = 45) {
        parent::__construct('Weepinbell', 'Grass/Poison', $level, $hp);
    }

    public function specialMove(): string {
        return $this->special . " — Slice with leaves, chance to critical when intensity high.";
    }


    public function train(string $kind, int $intensity): array {
        $before = ['level' => $this->level, 'hp' => $this->hp];

        $lvlGain = 0;
        $hpGain = 0;

        switch (strtolower($kind)) {
            case 'attack':
                $lvlGain = (int) floor($intensity / 20);
                $hpGain = (int) round($intensity / 5);
                $lvlGain += (int) floor($intensity / 50);
                break;
            case 'defense':
                $lvlGain = (int) floor($intensity / 25);
                $hpGain = (int) round($intensity / 4);
                break;
            case 'speed':
                $lvlGain = (int) floor($intensity / 40);
                $hpGain = (int) round($intensity / 10);
                break;
            default:
                $lvlGain = (int) floor($intensity / 30);
                $hpGain = (int) round($intensity / 6);
        }

        $lvlGain += rand(0, 1);
        $hpGain += rand(0, (int) max(1, $intensity / 50));

        $this->increaseLevel($lvlGain);
        $this->increaseHP($hpGain);

        $after = ['level' => $this->level, 'hp' => $this->hp];

        return [
            'before' => $before,
            'after' => $after,
            'gain' => ['level' => $lvlGain, 'hp' => $hpGain],
            'specialMove' => $this->specialMove()
        ];
    }
}