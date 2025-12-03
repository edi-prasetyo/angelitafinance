<?php

namespace App\Exports;

use App\Models\Order;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class OrdersExport implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize, WithEvents
{
    public $dataCount = 0;

    public function collection()
    {
        $data = Order::with(['customer', 'partner', 'rental'])
            ->where('payment_status', 0)
            ->where('bill', '>', 0)
            ->where('cancel', '>', 0)
            ->orderBy('id', 'desc')
            ->get();

        $this->dataCount = $data->count();
        return $data;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Customer',
            'Rental ID',
            'Partner ID',
            'Order Date',
            'Start Date',
            'Order Code',
            'Bill',
            'Payment Status',
        ];
    }

    public function map($o): array
    {
        return [
            $o->id,
            $o->customer->full_name ?? '-',
            $o->rental->name,
            $o->partner->name,

            // Format tanggal ke "2 Maret 2025"
            $o->order_date ? Carbon::parse($o->order_date)->translatedFormat('j F Y') : '-',
            $o->start_date ? Carbon::parse($o->start_date)->translatedFormat('j F Y') : '-',

            $o->order_code,
            (float) $o->bill,
            $o->payment_status == 1 ? 'success' : 'pending',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {

                $sheet = $event->sheet;
                $totalRow = $this->dataCount + 2; // Header = row 1, data mulai row 2

                // Label TOTAL
                $sheet->setCellValue("G{$totalRow}", "TOTAL");

                // SUM kolom H
                $sheet->setCellValue("H{$totalRow}", "=SUM(H2:H" . ($this->dataCount + 1) . ")");

                // Bold untuk total
                $sheet->getStyle("G{$totalRow}:H{$totalRow}")->getFont()->setBold(true);

                // Format angka ribuan
                $sheet->getStyle("H2:H{$totalRow}")
                    ->getNumberFormat()
                    ->setFormatCode('#,##0');

                // -------------------------
                // 🔥 BORDER FULL SETIAP CELL
                // -------------------------

                $borderStyle = [
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color'       => ['argb' => '000000'],
                        ],
                    ],
                ];

                // Range dari header (row 1) sampai total row
                $lastRow = $totalRow;
                $sheet->getStyle("A1:I{$lastRow}")->applyFromArray($borderStyle);
            }
        ];
    }
}
