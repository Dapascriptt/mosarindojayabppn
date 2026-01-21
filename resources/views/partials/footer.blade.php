<footer class="mt-16 border-t border-slate-200 bg-white">
  <div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
    <div class="grid gap-8 md:grid-cols-[1.2fr_0.8fr]">
      <div class="space-y-4">
        <div class="flex items-center gap-3">
          <img src="/image/logo-mjb.png" alt="Masarindo Jaya Balikpapan" class="h-11 w-11 object-contain">
          <div>
            <div class="text-base font-extrabold text-slate-900">{{ config('app.name') }}</div>
            <div class="text-xs font-semibold text-slate-500">Kontraktor & Supply</div>
          </div>
        </div>
        <p class="max-w-md text-sm text-slate-600">
          Mitra konstruksi & supply untuk proyek showroom, interior, electrical, dan land clearing
          dengan standar mutu dan ketepatan waktu.
        </p>
      </div>

      <div class="grid gap-3 text-sm text-slate-600">
        <div class="font-extrabold uppercase tracking-[0.18em] text-slate-900">Kontak</div>
        <div>Instagram: <a href="https://instagram.com/masarindojaya" class="font-semibold text-slate-900 hover:text-[rgba(219,165,84,1)]">instagram.com/masarindojaya</a></div>
        <div>Telepon/WhatsApp: <a href="tel:+6281254899699" class="font-semibold text-slate-900 hover:text-[rgba(219,165,84,1)]">+62 812 5489 9699</a></div>
        <div>Email: <a href="mailto:info@mosarindojaya.com" class="font-semibold text-slate-900 hover:text-[rgba(219,165,84,1)]">info@mosarindojaya.com</a></div>
        <div>Alamat: Jl. Komp. Bukit Damai Lestari Blok IV No. 3-4 RT. 44 Kel. Gn. Bahagia, Kec. Balikpapan Selatan, Balikpapan - KALTIM</div>
      </div>
    </div>

    <div class="mt-8 border-t border-slate-200 pt-6 text-xs text-slate-500">
      {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
    </div>
  </div>
</footer>

