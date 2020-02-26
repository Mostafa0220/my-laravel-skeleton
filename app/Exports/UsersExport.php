<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class UsersExport implements FromCollection, WithHeadings, WithEvents, ShouldAutoSize
{

    // set the headings
    public function headings(): array
    {
        return [
            '#', 'Name', 'Email', 'Phone', 'Status', 'Created'
        ];
    }

    // freeze the first row with headings
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->freezePane('A2', 'A2');
                $styleArray = [
                    'font' => [
                        'bold' => true,
                    ],
                ];

                $event->sheet->getDelegate()->setTitle('All Users Data')->getStyle('A1:F1')->applyFromArray($styleArray);
                $event->sheet->getDelegate()->getStyle('A1'); // Set cell A1 as selected


            }
        ];
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {

        $data = User::select('id', 'name', 'email', 'phone_number', 'state', 'created_at')->get()->toArray();

        return collect($data);
    }

}
