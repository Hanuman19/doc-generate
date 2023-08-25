<?php

namespace App\Http\Controllers\Api\v1;
use App\Domain\Docs\Actions\DocsActions;
use App\Domain\Docs\DTO\docsData;
use App\Http\Controllers\Controller;
use App\Http\Request\DownloadRequest;
use App\Http\Request\UploadRequest;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use mPDF;


class DocsController extends Controller
{
    function download (DownloadRequest $request)
    {
        $pdf = (new DocsActions())->createPDF(new docsData([
            'name'=>$request->name,
            'inn'=>$request->inn,
            'kpp'=>$request->kpp,
            'shopper'=>$request->shopper,
            'products'=>$request->products,
            'logo_path'=>$request->logo_path
        ]));
        return $pdf->download()->getOriginalContent();
    }
    function uploadLogo (UploadRequest $request) {
        return $request->logo->store('logo','public');
    }
}
