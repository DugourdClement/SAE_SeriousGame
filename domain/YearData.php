<?php

final class YearData implements JsonSerializable
{
    private int $year;
    private int $nbTextSup;
    private array $textSup;
    private int $nbChoice;
    private array $choices;

    public function __construct(int $year, int $nbTextSup, array $textSup, int $nbChoice, array $choice)
    {
        $this->year = $year;

        $this->nbTextSup = $nbTextSup;
        $this->textSup = $textSup;

        $this->nbChoice = $nbChoice;
        $this->choices = $choice;

    }

    /**
     * @return int
     */
    public function getYear(): int
    {
        return $this->year;
    }

    /**
     * @return int
     */
    public function getNbTextSup(): int
    {
        return $this->nbTextSup;
    }

    /**
     * @return array
     */
    public function getTextSup(): array
    {
        return $this->textSup;
    }

    /**
     * @return int
     */
    public function getNbChoice(): int
    {
        return $this->nbChoice;
    }

    /**
     * @return array
     */
    public function getChoices(): array
    {
        return $this->choices;
    }



    public function jsonSerialize(): array
    {
        return [
            'year' => $this->year,
            'nbTextSup' => $this->nbTextSup,
            'textSup' => $this->textSup,
            'nbChoice' => $this->nbChoice,
            'choice' => $this->choices,
        ];
    }
}