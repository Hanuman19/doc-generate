<?php

namespace App\Domain\Docs\Actions;

use App\Domain\Docs\DTO\docsData;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class DocsActions
{
    /**
     * @param docsData $data
     * @return \Barryvdh\DomPDF\PDF
     */
    public function createPDF(docsData $data): \Barryvdh\DomPDF\PDF
    {
        $totalQuantity = collect($data->products)->sum('quantity');
        $totalSumm = 0;
        foreach($data->products as &$product) {
            $product['summ'] = $product['quantity'] * $product['price'];
            $totalSumm += $product['summ'];
        }
        $invoice_number =  rand();
        $dt = Carbon::now()->format('d.m.Y');
        $invoiceData=[
            'name'=>$data->name,
            'inn'=>$data->inn,
            'kpp'=>$data->kpp,
            'shopper'=>$data->shopper,
            'products'=>$data->products,
            'logo_path'=>$data->logo_path ? storage_path('app/public/' . $data->logo_path) : null,
            'invoice_number'=>$invoice_number,
            'date'=>$dt,
            'total_quantity'=>$totalQuantity,
            'total_summ'=>$totalSumm,

        ];

        $pdf = Pdf::loadView('invoice', $invoiceData);
        $pdf->set_paper('a4', 'landscape');
        return $pdf;
    }
}
