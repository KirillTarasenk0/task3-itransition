<?php

namespace Itransition\Classes;

use Console_Table;

class Table
{
    public function generateTable(Game $game, array $moves): Console_Table
    {
        $table = new Console_Table();
        $table->setHeaders(array_merge(["v PC\\User >"], $moves));
        foreach ($moves as $firstKey => $firstMove) {
            $row = [$firstMove];
            foreach ($moves as $secondKey => $secondMove) {
                $result = $game->determineWinner($secondKey + 1, $firstKey + 1);
                $row[] = $result;
            }
            $table->addRow($row);
        }
        return $table;
    }
    public function displayTable(Console_Table $table): void
    {
        echo $table->getTable();
    }
}