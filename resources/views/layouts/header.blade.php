<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="theme-color" content="#6777ef" />
    <meta charset="utf-8" />
    <title>Pay Slip VDNI </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="E-PaySlip PT Virtue Dragon Nickel Industry" name="description" />
    <meta content="E-PaySlip" name="HR-SITE" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/icon.png') }}">

    <!-- Plugin css -->
    <link href="{{ asset('assets/libs/@fullcalendar/core/main.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/@fullcalendar/daygrid/main.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/@fullcalendar/bootstrap/main.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/@fullcalendar/timegrid/main.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/@fullcalendar/list/main.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Plugins css -->
    <link href="{{ asset('assets/libs/flatpickr/flatpickr.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet" type="text/css" />

    <!-- third party css -->
    <link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- third party css end -->

    <!-- App css -->
    <link href="{{ asset('assets/css/bootstrap-purple.min.css') }}" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
    <link href="{{ asset('assets/css/app-purple.min.css') }}" rel="stylesheet" type="text/css" id="app-default-stylesheet" />

    <link href="{{ asset('assets/css/bootstrap-purple-dark.min.css') }}" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" />
    <link href="{{ asset('assets/css/app-purple-dark.min.css') }}" rel="stylesheet" type="text/css" id="app-dark-stylesheet" />

    <!-- icons -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Wizard -->
    <link href="{{ asset('assets/js/steps/css/jquery.steps.css') }}" rel="stylesheet" type="text/css" />

    <script src="{{ asset('assets/sweetalert2/sweetalert2.min.js') }}"></script>
    <link href="{{ asset('assets/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet">

    <link rel="apple-touch-icon" href="{{ asset('logo.png') }}">
    <link rel="manifest" href="{{ asset('/manifest.json') }}">
    <style>
        .navbar-custom {
            background-color: #F8F9FA;
            box-shadow: 0 2px 6px -2px rgba(0, 0, 0, .16), 0 2px 6px 0 rgba(0, 0, 0, .12);
            padding: 0 10px 0 0;
            position: fixed;
            left: 0;
            right: 0;
            height: 70px;
            z-index: 1001;
        }

        .navbar-custom .button-menu-mobile {
            border: none;
            color: #000;
            display: inline-block;
            height: 70px;
            line-height: 70px;
            width: 60px;
            background-color: transparent;
            font-size: 24px;
            cursor: pointer;
        }

        .navbar-custom .topnav-menu .nav-link {
            padding: 0 15px;
            color: #000;
            min-width: 32px;
            display: block;
            line-height: 70px;
            text-align: center;
            max-height: 70px;
        }
    </style>
    @stack('css')
</head>