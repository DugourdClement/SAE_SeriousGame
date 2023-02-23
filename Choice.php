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

    public function jsonSerialize(): array
    {
        return [
            'choice' => $this->choice,
            'nbOpt' => $this->nbOpt,
            'opt' => $this->opt,
        ];
    }
}