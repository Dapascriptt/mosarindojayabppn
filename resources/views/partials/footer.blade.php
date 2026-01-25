<footer class="mt-16 border-t border-[rgba(219,165,84,0.3)] bg-[rgba(152,107,3,1)]">
  <div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
    <div class="grid gap-8 md:grid-cols-[1.2fr_0.8fr]">
      <div class="space-y-4">
        <div class="flex items-center gap-3">
          <div class="h-14 w-14 overflow-hidden rounded-2xl p-2 shadow-sm ring-1 ring-white/10" style="background-color:#0b0b0b;">
            <img src="/image/logo-mjb2.png" alt="Masarindo Jaya Balikpapan" class="h-full w-full object-contain">
          </div>
          <div>
            <div class="text-base font-extrabold text-white">{{ config('app.name') }}</div>
            <div class="text-xs font-semibold text-white/80">Kontraktor & Supply</div>
          </div>
        </div>
        <p class="max-w-md text-sm text-white/90">
          Mitra konstruksi & supply untuk proyek Interior dan electrical
          dengan standar mutu dan ketepatan waktu.
        </p>
      </div>

      <div class="grid gap-3 text-sm text-white/90">
        <div class="font-extrabold uppercase tracking-[0.18em] text-white">Kontak</div>
        <div>Instagram: <a href="https://instagram.com/masarindojaya" class="font-semibold text-white hover:text-white/70">instagram.com/masarindojaya</a></div>
        <div>Telepon/WhatsApp: <a href="tel:+6281254899699" class="font-semibold text-white hover:text-white/70">+62 812 5489 9699</a></div>
        <div>Email: <a href="mailto:pt.mosarindojayabpp@gmail.com" class="font-semibold text-white hover:text-white/70">pt.mosarindojayabpp@gmail.com</a></div>
        <div>Jalan MT Haryono No 43, Kelurahan Damai, Bahagia,
        Kec. Balikpapan Kota, Kota Balikpapan,
        Kalimantan Timur 76114</div>
      </div>
    </div>

    <div class="mt-8 border-t border-white/20 pt-6 text-xs text-white/70">
      {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
    </div>
  </div>
</footer>
