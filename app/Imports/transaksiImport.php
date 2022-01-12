<?php

namespace App\Imports;

use App\Models\Transaksi;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithConditionalSheets;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;



// HeadingRowFormatter::default('none');

class transaksiImport implements WithMultipleSheets
{
    
use WithConditionalSheets;

    public function conditionalSheets(): array
    {
        return[
            'ABADI VILLA-EKO' => new FirstSheetImport(),
            'AM MART-EKO' => new FirstSheetImport(),
            'AMALA COLLECTIVE THE PT- EKO' => new FirstSheetImport(),
            // 'ALMA RESTAURANT-EKO' => new FirstSheetImport(),
            'ARTE CANGGU-ANDAR' => new FirstSheetImport(),
            'BACK ROOM CANGGU-EKO' => new FirstSheetImport(),
            'BGC RIVERSIDE BAR-ANDAR' => new FirstSheetImport(),
            'BALI BEACH SHACK-EKO' => new FirstSheetImport(),
            'BALI BEACH GLAMPING-ANDAR' => new FirstSheetImport(),
            'BALI NICE BAR & RESTO-ANDAR' => new FirstSheetImport(),
            // 'BALIMU VILLA SEMINYAK-EKO' => new FirstSheetImport(),
            // 'BAMBOO FASHION BALI PT-EKO' => new FirstSheetImport(),
            
         ];

        //  dd();
    }

        
      
}

