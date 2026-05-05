<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate of Completion - {{ $certificate->course->title }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:wght@400;700&family=Montserrat:wght@400;700;900&display=swap" rel="stylesheet">
    <style>
        @media print {
            .no-print { display: none; }
            body { background: white; }
        }
        .cert-font { font-family: 'Libre+Baskerville', serif; }
        .sans-font { font-family: 'Montserrat', sans-serif; }
    </style>
</head>
<body class="{{ $theme === 'modern' ? 'bg-slate-900' : 'bg-slate-100' }} min-h-screen flex flex-col items-center justify-center p-8">
    <div class="no-print mb-8 flex gap-4">
        <div class="bg-white rounded-2xl p-2 shadow-xl flex gap-2">
            <a href="?theme=classic" class="px-6 py-2 rounded-xl font-bold text-xs uppercase tracking-widest transition-all {{ $theme === 'classic' ? 'bg-indigo-600 text-white shadow-lg' : 'text-slate-400 hover:text-slate-600' }}">Classic</a>
            <a href="?theme=modern" class="px-6 py-2 rounded-xl font-bold text-xs uppercase tracking-widest transition-all {{ $theme === 'modern' ? 'bg-indigo-600 text-white shadow-lg' : 'text-slate-400 hover:text-slate-600' }}">Modern</a>
        </div>
        <button onclick="window.print()" class="bg-indigo-600 text-white px-8 py-3 rounded-2xl font-bold shadow-lg shadow-indigo-200 hover:bg-indigo-700 transition-all text-xs uppercase tracking-widest">Print Certificate</button>
        <a href="{{ route('student.certificates') }}" class="bg-white text-slate-600 px-8 py-3 rounded-2xl font-bold border border-slate-200 hover:bg-slate-50 transition-all text-xs uppercase tracking-widest">Back to List</a>
    </div>

    <!-- Certificate Container -->
    <div class="{{ $theme === 'modern' ? 'bg-slate-950 text-white border-slate-800' : 'bg-white text-slate-900 border-slate-900' }} w-full max-w-5xl aspect-[1.414/1] relative p-12 shadow-2xl overflow-hidden border-[16px]">
        @if($theme === 'modern')
            <!-- Modern Decorative Elements -->
            <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-indigo-600/10 rounded-full blur-[120px] -mr-64 -mt-64"></div>
            <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-indigo-600/10 rounded-full blur-[120px] -ml-64 -mb-64"></div>
            <div class="absolute inset-0 border border-white/5 m-4 pointer-events-none"></div>
            <div class="absolute inset-0 border-t-8 border-indigo-600 w-1/4 h-8 m-8"></div>
        @else
            <!-- Classic Decorative Corners -->
            <div class="absolute top-0 left-0 w-48 h-48 border-t-8 border-l-8 border-indigo-600 m-8"></div>
            <div class="absolute top-0 right-0 w-48 h-48 border-t-8 border-r-8 border-indigo-600 m-8"></div>
            <div class="absolute bottom-0 left-0 w-48 h-48 border-b-8 border-l-8 border-indigo-600 m-8"></div>
            <div class="absolute bottom-0 right-0 w-48 h-48 border-b-8 border-r-8 border-indigo-600 m-8"></div>
        @endif

        <!-- Watermark -->
        <div class="absolute inset-0 flex items-center justify-center opacity-[0.03] pointer-events-none">
            <svg class="w-[40%] h-[40%] {{ $theme === 'modern' ? 'text-white' : 'text-slate-900' }}" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L1 12l11 10 11-10L12 2zm0 16.3L5.7 12 12 7.7l6.3 4.3L12 18.3z"/></svg>
        </div>

        <div class="relative h-full flex flex-col items-center justify-center text-center p-12">
            <!-- Header -->
            <div class="mb-12">
                <div class="flex items-center justify-center gap-3 mb-6">
                    <div class="w-12 h-12 bg-indigo-600 rounded-xl flex items-center justify-center text-white font-black text-xl italic shadow-lg shadow-indigo-600/20">E</div>
                    <span class="sans-font text-2xl font-black tracking-tighter {{ $theme === 'modern' ? 'text-white' : 'text-slate-900' }} uppercase">EduPlatform</span>
                </div>
                <h1 class="sans-font text-5xl font-black {{ $theme === 'modern' ? 'text-white' : 'text-slate-900' }} tracking-[0.2em] uppercase mb-4">Certificate</h1>
                <p class="cert-font text-xl {{ $theme === 'modern' ? 'text-indigo-400' : 'text-slate-500' }} italic">of Completion</p>
            </div>

            <!-- Recipient Info -->
            <div class="mb-16">
                <p class="cert-font text-lg text-slate-400 mb-6">This is to certify that</p>
                <h2 class="sans-font text-6xl font-black {{ $theme === 'modern' ? 'text-indigo-400' : 'text-indigo-600' }} mb-6 tracking-tight underline {{ $theme === 'modern' ? 'decoration-indigo-900' : 'decoration-indigo-200' }} decoration-8 underline-offset-8">{{ $certificate->user->name }}</h2>
                <p class="cert-font text-lg text-slate-400">has successfully completed the professional course</p>
            </div>

            <!-- Course Info -->
            <div class="mb-20">
                <h3 class="sans-font text-3xl font-black {{ $theme === 'modern' ? 'text-white' : 'text-slate-900' }} uppercase tracking-widest mb-4">{{ $certificate->course->title }}</h3>
                <p class="cert-font text-base text-slate-400 italic">Issued on {{ $certificate->issued_at->format('M d, Y') }}</p>
            </div>

            <!-- Footer / Signatures -->
            <div class="w-full flex justify-around items-end">
                <div class="text-center w-64">
                    <div class="border-b-2 {{ $theme === 'modern' ? 'border-indigo-600' : 'border-slate-900' }} mb-4 px-8 pb-2">
                        <p class="cert-font text-2xl italic">Dr. Sarah Jenkins</p>
                    </div>
                    <p class="sans-font text-[10px] font-black text-slate-400 uppercase tracking-widest">Director of Education</p>
                </div>

                <!-- Seal / QR Code -->
                <div class="relative w-40 h-40 flex items-center justify-center">
                    <div class="absolute inset-0 border-4 border-indigo-600/20 rounded-full animate-spin-slow"></div>
                    <div class="absolute inset-2 border-2 border-indigo-600/40 rounded-full"></div>
                    <div class="w-28 h-28 bg-white rounded-2xl flex items-center justify-center p-2 shadow-xl border border-slate-100">
                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ urlencode(route('certificates.verify', $certificate->certificate_hash)) }}" alt="Verification QR Code" class="w-full h-full">
                    </div>
                </div>

                <div class="text-center w-64">
                    <div class="border-b-2 {{ $theme === 'modern' ? 'border-indigo-600' : 'border-slate-900' }} mb-4 px-8 pb-2">
                        <p class="cert-font text-2xl italic">{{ $certificate->course->instructor->name }}</p>
                    </div>
                    <p class="sans-font text-[10px] font-black text-slate-400 uppercase tracking-widest">Course Instructor</p>
                </div>
            </div>

            <!-- ID / Verification -->
            <div class="absolute bottom-12 right-12 text-right">
                <p class="sans-font text-[8px] font-bold text-slate-500 uppercase tracking-widest">Certificate ID: {{ $certificate->certificate_hash }}</p>
                <p class="sans-font text-[8px] font-bold text-slate-500 uppercase tracking-widest mt-1">Verify at: {{ route('certificates.verify', $certificate->certificate_hash) }}</p>
            </div>
        </div>
    </div>
</body>
</html>
