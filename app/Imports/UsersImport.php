<?php

namespace App\Imports;

use App\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel, WithHeadingRow
{
    private $rows = 0;

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {//$row is hodling every row of excell later to do validation if exist
        ++$this->rows;
        return new User([
            'name' => $row['name'],
            'email' => $row['email'],
            'password' => \Hash::make($row['password']),
        ]);
    }

    public function getRowCount(): int
    {
        return $this->rows;
    }
}
