<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

HeadingRowFormatter::default('none');

class UsersImport implements ToModel, WithHeadingRow
{
    private $numRows = 0;
    public function model(array $row)
    {
        ++$this->numRows;
        return new User([
            'nombre'  => $row['Nombre'],
            'apellido' => $row['Apellido'],
            'codigo'    => $row['Codigo'],
            'numero_identificacion'    => $row['Numero_identificacion'],
            'password'    => $row['Password'],
            'programa_id'    => $row['Programa_id'],
            'rol_id'    => $row['Rol_id']
        ]);
    }

    public function rules(): array
    {
        return [
            'nombre' => 'required|max:45',
            'apellido' => 'required|max:45',
            'codigo' => 'required|max:45',
            'numero_identificacion' => 'required|max:45',
            'programa_id' => 'required|max:45',
            'rol_id' => 'required|max:45',
        ];
    }
 
    public function getRowCount(): int
    {
        return $this->numRows;
    }
}


