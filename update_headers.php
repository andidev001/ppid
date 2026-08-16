<?php
$pages = [
    'profil_ppid',
    'profil_sekolah',
    'dasar_hukum',
    'maklumat',
    'struktur',
    'tugas_fungsi',
    'visi_misi',
    'sop'
];

foreach ($pages as $page) {
    $path = "resources/views/pages/$page.blade.php";
    $content = file_get_contents($path);

    // Extract title
    if (preg_match('/<h1.*?>(.*?)<\/h1>/s', $content, $matches)) {
        $title = trim($matches[1]);

        $header = <<<HTML
    <div class="bg-slate-900 pb-32 pt-16 relative overflow-hidden">
        <div class="absolute inset-0 opacity-[0.05] text-white">
            <svg class="h-full w-full" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="pattern-{$page}" x="0" y="0" width="60" height="60" patternUnits="userSpaceOnUse">
                        <path d="M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z" fill="currentColor"></path>
                    </pattern>
                </defs>
                <rect x="0" y="0" width="100%" height="100%" fill="url(#pattern-{$page})"></rect>
            </svg>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <h1 class="text-3xl md:text-5xl font-extrabold text-white brand-font tracking-tight mb-4">{$title}</h1>
            <p class="text-indigo-100 max-w-2xl mx-auto text-lg">Pusat Informasi Data dan Dokumen Resmi Portal PPID kami.</p>
        </div>
    </div>

    <div class='max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 -mt-20 relative z-20 pb-20'>
HTML;

        // Remove old H1
        $content = str_replace($matches[0], '', $content);
        $content = str_replace("<div class='max-w-4xl mx-auto px-4 sm:px-6 lg:px-8'>", $header, $content);

        file_put_contents($path, $content);
        echo "Updated $path\n";
    }
}
?>