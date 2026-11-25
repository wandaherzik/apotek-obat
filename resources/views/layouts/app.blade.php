<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes">
    <meta name="description" content="Sistem Informasi Penjualan & Inventaris Obat - Apotek Khadijah">

    <title>@yield('title', 'Apotek Khadijah') - Sistem Farmasi</title>

    {{-- Google Font: Plus Jakarta Sans --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    {{-- Bootstrap Icons --}}
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    {{-- OverlayScrollbars --}}
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css">

    {{-- DataTables Bootstrap 5 --}}
    <link rel="stylesheet"
        href="https://cdn.datatables.net/2.3.2/css/dataTables.bootstrap5.css">

    {{-- SweetAlert2 --}}
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    {{-- Select2 --}}
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">

    {{-- AdminLTE Core --}}
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.css') }}">

    {{-- Custom Modern & Interactive UI Theme --}}
    <link rel="stylesheet" href="{{ asset('css/custom-theme.css') }}">

    @stack('css')
</head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">

<div class="app-wrapper">

    {{-- Navbar --}}
    @include('layouts.navbar')

    {{-- Sidebar --}}
    @include('layouts.sidebar')

    {{-- Main Content --}}
    <main class="app-main">
        <div class="container-fluid px-3 px-md-4 pt-3">
            @yield('content')
        </div>
    </main>

    {{-- Footer --}}
    @include('layouts.footer')

</div>

@include('components.alert')
@include('layouts.script')

{{-- Custom Interactive Behaviors (Clock, Search Filter, Logout modal, Theme Toggle) --}}
<script src="{{ asset('js/custom-interactive.js') }}"></script>

@stack('js')

</body>
</html>
