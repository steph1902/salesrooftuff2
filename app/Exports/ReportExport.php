<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Carbon\Carbon;
// use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithDefaultStyles;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Style;
use PhpOffice\PhpSpreadsheet\Style\Color;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;

use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Maatwebsite\Excel\Concerns\WithDrawings;
// use Maatwebsite\Excel\Concerns\WithRowHeight;

// use Maatwebsite\Excel\Concerns\WithDrawings;

class ReportExport implements FromCollection, WithStyles, WithColumnFormatting, WithDefaultStyles, ShouldAutoSize, WithHeadings, WithDrawings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $reportData;

    public function __construct($reportData)
    {
        $this->reportData = $reportData;
    }

    public function collection()
    {
        //
        return $this->reportData;

    }

    public function rowHeight(): array
    {
        // Tentukan tinggi baris untuk setiap baris, sesuaikan dengan kebutuhan Anda
        return [
            2 => 200, // misalnya, baris kedua memiliki tinggi 100        
        ];
    }
    
    public function styles(Worksheet $sheet)
    {        
        return [

            '1' => ['font' => ['bold' => true]],
            'G' => ['height' => 200, 'alignment' => ['vertical' => 'center']],

            // 'G' => ['height' => 100, 'width' => 90], // Sesuaikan dengan ukuran yang sesuai


            
        ];
    }
    public function columnFormats(): array
    {
        return [
            'B' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        ];
    }
    public function defaultStyles(Style $defaultStyle)
    {
        return $defaultStyle->getFill()->setFillType(Fill::FILL_SOLID);
    }

    public function headings(): array
    {
        return [
            'Unique Id.',
            'Nama Sales',
            'Nama Toko',
            'Alamat Toko',
            'Kota',
            'Kunjungan Terakhir',
            'Foto Toko Depan',
            'Catatan',
            'Kelengkapan Material'
            
        ];
    }

    private function formatTanggal($data)
    {        
        $formattedDates = [];
        $kunjunganTerakhir = $data->kunjungan_terakhir; // Gantilah dengan atribut yang sesuai di model Anda

        // Pastikan ada data dalam array kunjungan terakhir
        if (is_array($kunjunganTerakhir) && count($kunjunganTerakhir) > 0) {
            $count = min(count($kunjunganTerakhir), 3); // Ambil maksimal 3 data kunjungan terakhir
            $kunjunganTerakhir = array_slice($kunjunganTerakhir, 0, $count);

            foreach ($kunjunganTerakhir as $tanggal) {
                $formattedDates[] = Carbon::parse($tanggal)->format('l, d F Y');
            }
        }

        return implode(', ', $formattedDates);
    }


    public function drawings()
    {
        $drawingCollection = [];        
        $row = 2;
        $column = 'G';

        foreach ($this->reportData as $data) {
            $drawing = new Drawing();
            $drawing->setName('MyImage');
            $drawing->setDescription('Description');
            if($data->{'Foto Toko Depan'})
            {
                $imagePath = storage_path('app/public/' . $data->{'Foto Toko Depan'});
                $drawing->setPath($imagePath);                
                $drawing->setHeight(20);
                $drawing->setWidth(20);
                $drawing->setCoordinates($column . $row);
                $drawingCollection[] = $drawing;
            }
            $row++;
        }

        return $drawingCollection;
    }





}



