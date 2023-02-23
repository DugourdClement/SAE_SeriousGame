<?php

final class Choice implements JsonSerializable
{
    private string $choice;
    private int $nbOpt;
    private array $opt;

    public function __construct(string $choice, int $nbOpt, array $opt)
    {
        $this->choice = $choice;
        $this->nbOpt = $nbOpt;
        $this->opt = $opt;
    }

    /**
     * @return string
     */
    public function getChoice(): string
    {
        return $this->choice;
    }

    /**
     * @return int
     */
    public function getNbOpt(): int
    {
        return $this->nbOpt;
    }

    /**
     * @return array
     */
    public function getOpt(): array
    {
        return $this->opt;
    }


    public function jsonSerialize(): array
    {
        return [
            'choice' => $this->choice,
            'nbOpt' => $this->nbOpt,
            'opt' => $this->opt,
        ];
    }
}