<?php

final class YearData implements JsonSerializable
{
    private int $year;
    private int $nbTextSup;
    private array $textSup;
    private int $nbChoice;
    private array $choice;

    public function __construct(int $year, int $nbTextSup, array $textSup, int $nbChoice, array $choice)
    {
        $this->year = $year;

        $this->nbTextSup = $nbTextSup;
        $this->textSup = $textSup;

        $this->nbChoice = $nbChoice;
        $this->choice = $choice;

    }

    public function jsonSerialize(): array
    {
        return [
            'year' => $this->year,
            'nbTextSup' => $this->nbTextSup,
            'textSup' => $this->textSup,
            'nbChoice' => $this->nbChoice,
            'choice' => $this->choice,
        ];
    }
}