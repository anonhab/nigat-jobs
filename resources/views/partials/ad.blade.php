{{--
  Usage: @include('partials.ad', ['slot' => 'SLOT_ID', 'format' => 'auto'])
  Replace ca-pub-XXXXXXXXXXXXXXXX with your Publisher ID once approved.
--}}
<div class="ad-unit" style="text-align:center;margin:1.5rem 0;overflow:hidden;">
    <ins class="adsbygoogle"
         style="display:block"
         data-ad-client="ca-pub-XXXXXXXXXXXXXXXX"
         data-ad-slot="{{ $slot ?? 'XXXXXXXXXX' }}"
         data-ad-format="{{ $format ?? 'auto' }}"
         data-full-width-responsive="true"></ins>
    <script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
</div>
