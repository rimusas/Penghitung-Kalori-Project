<?php

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use app\Models\Food;

class FoodsImport implements ToModel, WithHeadingRow
{
  public function model(array $row)
  {
    return new Food([
      'nama_makanan' => $row['nama'],
      'kalori' => $row['kalori'],
      'satuan' => $row['berat'],
    ]);
  }
}
