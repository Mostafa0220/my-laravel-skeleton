<?php

namespace App\Exports;

use App\Helpers\DateHelper;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class TimeTrackingExport implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize, WithColumnFormatting, WithEvents
{
    public function __construct($results, $member, $date)
    {
        $this->date = $date;
        $this->member = $member;
        $this->results = $results;
    }

    public function headings(): array
    {
        return [
            'Date', 'Task', 'Time'
        ];
    }

    public function collection()
    {
        return $this->results;
    }

    public function map($entry): array
    {
        return [
            $entry->date_at->format('Y-m-d'),
            $entry->description,
            DateHelper::friendlyDuration($entry->mins, 2),
        ];
    }

    public function columnFormats(): array
    {
        return [
            //'A' => NumberFormat::FORMAT_DATE_DDMMYYYY
        ];
    }

    public function registerEvents(): array
    {
        return [
            BeforeExport::class => function (BeforeExport $event) {
                $event->writer->getProperties()->setCreator($this->member->name . ' ' . $this->member->surname);
            },
            AfterSheet::class => function (AfterSheet $event) {
                $styleArray = [
                    'font' => [
                        'bold' => true,
                    ],
                ];

                $event->sheet->getDelegate()->setTitle($this->date)->getStyle('A1:C1')->applyFromArray($styleArray);
                $event->sheet->getDelegate()->getStyle('A1'); // Set cell A1 as selected
            },
        ];
    }
}
