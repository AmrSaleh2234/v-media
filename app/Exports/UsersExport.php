<?php

namespace App\Exports;

use App\Http\Resources\UserResource;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;

class UsersExport implements FromCollection  , ShouldAutoSize ,WithMapping ,WithHeadings,WithEvents
{

    private $data;

    public function __construct($data = null)
    {
        $this->data = $data;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return User::select('id','name','email','phone','lang','created_at')->get();
    }

    public function map($user): array
    {
        // TODO: Implement map() method.
        return [
            $user->name,
            $user->email,
            $user->phone,
            $user->lang,
            $user->created_at->format('d/m/Y'),
        ];
    }

    public function headings(): array
    {

        return [
            __('names.name'),
            __('names.email'),
            __('names.phone'),
            __('names.lang'),
            __('names.created-at'),
        ];
    }

    public function registerEvents(): array
    {
        // TODO: Implement registerEvents() method.
        return [
            AfterSheet::class => function (AfterSheet $event) {
                //         $event->sheet->getDelegate()->setRightToLeft(true);
                $event->sheet->getStyle('A1:J1')->applyFromArray(
                    [
                        'font' => ['bold' => true]
                    ]);
            }
        ];
    }
}
