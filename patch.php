<?php
$f = 'C:\laragon\www\ppid\resources\views\pages\publikasi_show.blade.php';
$c = file_get_contents($f);

// We replace the block from "Bagikan Publikasi Ini" up to the next border-t
$pattern = '/<!-- Bagikan Artikel -->.*?<div class="mt-8 pt-8 border-t border-slate-100 flex items-center justify-between">/s';
$replacement = <<<HTML
                <!-- Bagikan Artikel -->
                <div class="bg-indigo-50/50 rounded-2xl p-6 flex flex-col sm:flex-row items-center justify-between gap-6 border border-indigo-100/50 mt-12 mb-2">
                    <div>
                        <h4 class="text-indigo-950 font-bold mb-1 text-sm uppercase tracking-wider">Bagikan Publikasi Ini</h4>
                        <p class="text-xs font-semibold text-slate-500">Sebarkan informasi ini ke jejaring sosial Anda.</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <!-- WhatsApp -->
                        <a href="https://api.whatsapp.com/send?text={{ urlencode(\$publication->title . ' - ' . request()->url()) }}" target="_blank"
                            class="w-10 h-10 rounded-xl bg-white border border-[#25D366]/20 text-[#25D366] hover:bg-[#25D366] hover:text-white flex items-center justify-center transition-all shadow-sm hover:shadow-[#25D366]/30 group" title="Bagikan ke WhatsApp">
                            <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 24 24"><path d="M12.031 21.488a10.021 10.021 0 01-5.111-1.39l-5.69 1.492 1.517-5.545a10.016 10.016 0 119.284 5.443z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" fill="none"/><path d="M16 14.5c-.26-.13-1.54-.76-1.78-.85-.24-.09-.42-.13-.6.13-.18.26-.68.85-.83 1.02-.15.17-.31.19-.57.06-.26-.13-1.1-.41-2.1-1.3-3.1-2.73-3.41-3.26-3.41-3.26s-.04-.08 0-.16c.03-.06.13-.15.19-.23.06-.08.08-.13.13-.22.04-.09.02-.17-.02-.23-.04-.06-.6-1.44-.82-1.97-.21-.52-.43-.45-.6-.46-.15-.01-.33-.01-.51-.01-.18 0-.48.06-.72.33-.24.26-.92.9-.92 2.19s.94 2.54 1.07 2.72c.13.18 1.86 2.84 4.5 3.98.63.27 1.12.43 1.5.55.63.2 1.2.17 1.65.1.51-.08 1.54-.63 1.76-1.24.22-.61.22-1.13.15-1.24-.06-.09-.23-.15-.49-.28z"/></svg>
                        </a>
                        <!-- FB -->
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank"
                            class="w-10 h-10 rounded-xl bg-white border border-[#1877F2]/20 text-[#1877F2] hover:bg-[#1877F2] hover:text-white flex items-center justify-center transition-all shadow-sm hover:shadow-[#1877F2]/30 group" title="Bagikan ke Facebook">
                            <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 24 24"><path d="M22.675 0H1.325C.593 0 0 .593 0 1.325v21.351C0 23.407.593 24 1.325 24H12.82v-9.294H9.692v-3.622h3.128V8.413c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12V24h6.116c.73 0 1.323-.593 1.323-1.325V1.325C24 .593 23.407 0 22.675 0z"/></svg>
                        </a>
                        <!-- Twitter/X -->
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode(\$publication->title) }}" target="_blank"
                            class="w-10 h-10 rounded-xl bg-white border border-slate-800/20 text-slate-800 hover:bg-slate-800 hover:text-white flex items-center justify-center transition-all shadow-sm hover:shadow-slate-800/30 group" title="Bagikan ke Twitter / X">
                            <svg class="w-4 h-4 group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                        </a>
                        <!-- Native Share OS (Including Instagram Stories/Direct on Mobile) -->
                        <button onclick="navigator.share({ title: '{{ addslashes(\$publication->title) }}', url: '{{ request()->url() }}' }).catch(console.error);"
                            class="w-10 h-10 rounded-xl bg-gradient-to-tr from-amber-400 via-rose-500 to-purple-600 text-white flex items-center justify-center transition-all shadow-md hover:shadow-rose-500/40 hover:-translate-y-0.5 group" title="Share via Device / Instagram">
                            <!-- Instagram SVG Logo here! -->
                            <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                        </button>
                    </div>
                </div>

                <div class="mt-8 pt-8 border-t border-slate-100 flex items-center justify-between">
HTML;

$c = preg_replace($pattern, $replacement, $c);
file_put_contents($f, $c);
echo "Replaced successfully!";
?>