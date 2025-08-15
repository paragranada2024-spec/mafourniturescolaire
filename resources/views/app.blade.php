<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  {{-- ====== SEO de base (FR + AR) ====== --}}
  <title>MaFournitureScolaire.ma – Fournitures scolaires à domicile à bas prix</title>

  {{-- Meta description (FR puis AR) --}}
  <meta name="description" content="Tout pour la rentrée : cartables, trousses, cahiers, packs prêts, livraison rapide partout au Maroc. | كل ما تحتاجه للدخول المدرسي: محافظ، أدوات، دفاتر، حزم جاهزة، وتوصيل سريع في جميع مدن المغرب.">

  {{-- Canonical --}}
  <link rel="canonical" href="https://mafourniturescolaire.ma/">

  {{-- ====== Open Graph (prévisualisation Facebook, WhatsApp…) ====== --}}
  <meta property="og:type" content="website">
  <meta property="og:site_name" content="MaFournitureScolaire.ma">
  <meta property="og:title" content="MaFournitureScolaire.ma – Fournitures scolaires à domicile à bas prix>
  <meta property="og:description" content="Cartables, fournitures et packs de rentrée à prix justes, livraison rapide au Maroc. | محافظ وأدوات مدرسية بجودة عالية وأسعار مناسبة مع توصيل سريع.">
  <meta property="og:url" content="https://mafourniturescolaire.ma/">
  {{-- مفضّل صورة JPG/PNG 1200x630 بدون مسافات في الاسم --}}
  <meta property="og:image" content="https://mafourniturescolaire.ma/storage/uploads/social/og-cover-1200x630.jpg">
  <meta property="og:image:width" content="1200">
  <meta property="og:image:height" content="630">

  {{-- ====== Twitter Card ====== --}}
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="MaFournitureScolaire.ma – Fournitures scolaires à domicile à bas prix">
  <meta name="twitter:description" content="Fournitures et packs de rentrée, livraison rapide partout au Maroc. | أدوات مدرسية وحزم جاهزة مع توصيل سريع.">
  <meta name="twitter:image" content="https://mafourniturescolaire.ma/storage/uploads/social/og-cover-1200x630.jpg">

  {{-- ====== Langues (indices pour moteurs البحث) ====== --}}
  <meta http-equiv="content-language" content="fr, ar">
  <link rel="alternate" href="https://mafourniturescolaire.ma/" hreflang="fr-ma">
  <link rel="alternate" href="https://mafourniturescolaire.ma/" hreflang="ar-ma">
  <link rel="alternate" href="https://mafourniturescolaire.ma/" hreflang="x-default">

  {{-- CSRF --}}
  <meta name="csrf-token" content="{{ csrf_token() }}">

  {{-- Fonts (optionnel) --}}
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

  {{-- Vite: utilise tes assets compilés (évite CDN Tailwind/Flowbite) --}}
  @routes
  @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
  @inertiaHead

  {{-- Favicons --}}
  <!-- <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('storage/uploads/logo/favicon-32.png') }}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('storage/uploads/logo/favicon-16.png') }}">
  <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('storage/uploads/logo/apple-touch-icon.png') }}"> -->
</head>
<body class="font-sans antialiased">
  @inertia
</body>
</html>
