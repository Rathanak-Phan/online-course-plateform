<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
    public function verify($hash)
    {
        $certificate = Certificate::where('certificate_hash', $hash)
            ->with(['user', 'course.instructor'])
            ->firstOrFail();

        return view('certificates.verify', compact('certificate'));
    }
}
