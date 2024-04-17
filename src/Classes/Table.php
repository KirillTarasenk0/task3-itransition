<?php

namespace Itransition\Classes;

use Console_Table;

class Table
{
    public function generateTable(GameRules $gameRules, array $moves): string
    {
        $table = new Console_Table();
        $table->setHeaders(array_merge(["v PC\\User >"], $moves));
        foreach ($moves as $firstMove) {
            $row = [$firstMove];
            foreach ($moves as $secondMove) {
                $result = $gameRules->determineWinner($firstMove, $secondMove);
                $row[] = $result;
            }
            $table->addRow($row);
        }
        return $table->getTable();
    }
    public function displayTable($table): void
    {
        $table->consoleWrite();
    }
}