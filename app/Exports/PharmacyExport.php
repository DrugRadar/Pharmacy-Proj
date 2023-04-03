<?php

namespace App\Exports;

use App\Models\Pharmacy;
use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PharmacyExport implements FromCollection, WithHeadings,WithStyles
{
    protected $pharmacy;

    public function __construct(Pharmacy $pharmacy)
    {

        $this->pharmacy = $pharmacy;
    }
    public function headings(): array
    {
        return [
            'Order ID',
            'Status',
            'Assigned pharmacy id',
            'total price',
            'client id',
            'is insured',
            'created at',
            'updated at',
            'doctor id',
            'creator type'
        ];
    }
    public function styles(Worksheet $sheet)
    {
        $sheet->getRowDimension(1)->setRowHeight(25);
        $sheet->getStyle('1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
                'size' => 10,
                'name' => 'Arial'
            ],
            'alignment' => [
                'horizontal' => 'center',
                'vertical' => 'center'
            ],
            'fill' => [
                'fillType' => 'solid',
                'startColor' => [
                    'rgb' => '0070C0'
                ]
            ]
        ]);
        $sheet->getColumnDimension('A')->setWidth(20);
        $sheet->getColumnDimension('B')->setWidth(20);
        $sheet->getColumnDimension('C')->setWidth(20);
        $sheet->getColumnDimension('D')->setWidth(20);
        $sheet->getColumnDimension('E')->setWidth(20);
        $sheet->getColumnDimension('F')->setWidth(20);
        $sheet->getColumnDimension('G')->setWidth(20);
        $sheet->getColumnDimension('H')->setWidth(20);
        $sheet->getColumnDimension('I')->setWidth(20);
        $sheet->getColumnDimension('J')->setWidth(20);
        $sheet->getColumnDimension('K')->setWidth(20);
    }
    public function collection()
    {
        $orders = Order::where('assigned_pharmacy_id', $this->pharmacy->id)
          ->select([
                'id',
                'status',
                'assigned_pharmacy_id',
                'total_price',
                'client_id',
                'is_insured',
                'created_at',
                'updated_at',
                'doctor_id',
                'creator_type',
            ])
        ->get();
        
        return $orders;
    }
}