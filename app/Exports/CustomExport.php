<?php
namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;

class CustomExport implements FromArray, ShouldAutoSize, WithColumnFormatting, WithEvents
{
    public function __construct($member)
    {
        $this->member = $member;
    }

    public function array(): array
    {
        return [
            ['Title', $this->member->title],
            ['First Name', $this->member->name],
            ['Middle Names', $this->member->middle_names],
            ['Last Name', $this->member->surname],
            ['Email', $this->member->email],
            ['DOB', $this->member->dob],
        ];
    }

    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_TEXT,
            'B' => NumberFormat::FORMAT_TEXT,
        ];
    }

    public function registerEvents(): array
    {
        return [
            BeforeExport::class => function(BeforeExport $event) {
                $event->writer->getProperties()->setCreator(config('app.name'));
            },
            AfterSheet::class => function(AfterSheet $event) {
                $styleArray = [
                    'font' => [
                        'bold' => true,
                    ],
                ];

                $event->sheet->getDelegate()->setTitle('Info')->getStyle('A1:A100')->applyFromArray($styleArray);
                $event->sheet->getDelegate()->getStyle('A1'); // Set cell A1 as selected

            },
        ];
    }
}
