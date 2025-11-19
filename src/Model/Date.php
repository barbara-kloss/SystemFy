<?php

namespace Systemfy\App\Model;

class Date
{
    private string $date;

    public function __construct(string $date)
    {
        $this->date = $date;
    }

    public function __toString(): string
    {
        return $this->date;
    }

    public function getDate(): string
    {
        return $this->date;
    }
}

?>



