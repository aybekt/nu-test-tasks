<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApplicationFormRequest;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Contracts\View\View;
use Symfony\Component\HttpFoundation\Response;

class ApplicationPdfController extends Controller
{
    private const PDF_PLAIN_NAME = 'zayavka.pdf';

    public function create(): View
    {
        return view('application.form');
    }

    public function store(ApplicationFormRequest $request): Response
    {
        $validated = $request->validated();

        return Pdf::loadView('application.pdf', $this->pdfViewData($validated))
            ->download(self::PDF_PLAIN_NAME);
    }

    private function pdfViewData(array $validated): array
    {
        return [
            'fullName' => $validated['full_name'],
            'iin' => $validated['iin'],
            'date' => $validated['date'],
            'text' => $validated['text'],
        ];
    }
}
