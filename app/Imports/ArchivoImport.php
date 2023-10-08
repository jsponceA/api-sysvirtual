<?php

namespace App\Imports;

use App\Models\Venta;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

class ArchivoImport implements WithHeadingRow, ToCollection
{


    public function collection(Collection $rows)
    {

        foreach ($rows as $row) {
            $row["fecha"] = !empty($row["fecha"]) ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row["fecha"])->format('Y-m-d') : null;
            Venta::query()->create([
                "documento" => $row["documento"],
                "vendedor" => $row["vendedor"],
                "fecha" => $row["fecha"],
                "nro_doc" => $row["nro_doc_cliente"],
                "cliente" => $row["cliente"],
                "cantidad" => $row["cantidad"],
                "u_medida" => $row["u_medida"],
                "codigo_producto" => $row["codigo_producto"],
                "producto" => $row["producto"],
                "moneda" => $row["moneda"],
                "precio_publico" => $row["precio_publico"],
                "precio" => $row["precio"],
                "totales" => $row["totales"],
                "descuento" => $row["descuento_global"],
                "por_entregar" => $row["por_entregar"],
                "um_por_entregar" => $row["um_por_entregar"],
                "estado" => $row["estado"],
                "condicion_pago" => $row["condicion_de_pago"],
                "linea_padre" => $row["linea_padre"],
                "linea_hijo" => $row["linea_hijo"],
            ]);
        }
    }

    public function headingRow(): int
    {
        return 7;
    }
}
