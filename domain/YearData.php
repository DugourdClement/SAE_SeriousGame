<?php

final class YearData implements JsonSerializable
{
    private int $year;
    private int $nbTextSup;
    private array $textSup;
    private int $nbChoices;
    private array $choices;

    public function __construct(int $year, int $nbTextSup, array $textSup, int $nbChoices, array $choices)
    {
        $this->year = $year;

        $this->nbTextSup = $nbTextSup;
        $this->textSup = $textSup;

        $this->nbChoices = $nbChoices;
        $this->choices = $choices;

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
    public function getNbChoices(): int
    {
        return $this->nbChoices;
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
            'nbChoice' => $this->nbChoices,
            'choice' => $this->choices,
        ];
    }
}