<?php

namespace Framework\Console;

class Output
{
    //helperklasse fürs Lienienschreiben
    //Ausgabe echo
    //Auch hier Text schöner machen und vorgenerierte Code

    public function writeLine($message)
    {
        //Ausgabe in einer Zeile
        echo $message;
    }

    public function writeNewLine()
    {
        //Ausgabe auf neuer Zeile
        echo "\n";
    }


}