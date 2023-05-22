<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
class UserExport implements FromArray, WithHeadings, WithStrictNullComparison
{
    protected $data;

  public function __construct(array $data)
  {
    $this->data = $data;
  }

  public function headings(): array
  {
    return [  
      '#',     
     'Username',
      'Status'
    ];
  }

  public function array(): array
  {
    return $this->data;
  }
}
