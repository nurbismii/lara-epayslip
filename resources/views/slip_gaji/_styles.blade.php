<style>
    @font-face {
        font-family: "Payslip CJK";
        font-style: normal;
        font-weight: normal;
        src: url("{{ !empty($isPdf) ? str_replace('\\', '/', resource_path('fonts/simhei.ttf')) : asset('fonts/simhei.ttf') }}") format("truetype");
    }

    @font-face {
        font-family: "Payslip CJK";
        font-style: normal;
        font-weight: bold;
        src: url("{{ !empty($isPdf) ? str_replace('\\', '/', resource_path('fonts/simhei.ttf')) : asset('fonts/simhei.ttf') }}") format("truetype");
    }

    .payslip {
        color: #253348;
        font-family: "DejaVu Sans", "Payslip CJK", sans-serif;
        font-size: 10px;
        line-height: 1.45;
    }

    .payslip table {
        width: 100%;
        border-collapse: collapse;
        table-layout: fixed;
    }

    .payslip td,
    .payslip th {
        vertical-align: top;
        overflow-wrap: break-word;
    }

    .payslip .ps-right {
        text-align: right;
    }

    .ps-header {
        border-bottom: 3px solid #176b70;
    }

    .ps-header td {
        padding: 0 0 14px;
    }

    .ps-logo {
        max-width: 170px;
        height: 38px;
    }

    .ps-company {
        font-weight: bold;
        margin-top: 6px;
        font-size: 11px;
    }

    .ps-confidential {
        color: #64748b;
        font-size: 8px;
        letter-spacing: 1px;
    }

    .payslip h1 {
        font-size: 27px;
        line-height: 1.2;
        margin: 7px 0 3px;
        color: #123e44;
    }

    .ps-month {
        font-size: 12px;
    }

    .ps-period {
        padding: 10px 12px;
        background: #edf5f5;
        margin-bottom: 16px;
    }

    .ps-info td {
        padding: 0 14px 12px 0;
    }

    .ps-info span,
    .ps-footer span {
        display: block;
        color: #64748b;
        font-size: 8px;
        margin-bottom: 3px;
    }

    .ps-info strong,
    .ps-footer strong {
        display: block;
    }

    .ps-column {
        width: 50%;
        padding-right: 10px;
    }

    .ps-column+.ps-column {
        padding-right: 0;
        padding-left: 10px;
    }

    .payslip h2 {
        font-size: 12px;
        color: #176b70;
        margin: 7px 0;
    }

    .ps-items th {
        padding: 7px 5px;
        background: #eff2f6;
        font-size: 8px;
        text-align: left;
    }

    .ps-items th:first-child {
        width: 62%;
    }

    .ps-items td {
        padding: 6px 5px;
        border-bottom: 1px solid #e5eaf0;
        font-size: 9px;
    }

    .ps-amount {
        text-align: right;
        white-space: nowrap;
    }

    .ps-muted,
    .ps-note {
        color: #64748b;
    }

    .ps-note {
        margin: 14px 0 10px;
        font-size: 8px;
    }

    .ps-total {
        background: #123e44;
        color: white;
    }

    .ps-total td {
        padding: 13px 12px;
        font-size: 14px;
        font-weight: bold;
    }

    .ps-footer {
        margin-top: 20px;
    }

    .ps-footer td {
        padding: 0 10px 0 0;
    }

    .ps-footer span {
        margin-top: 5px;
    }

    .ps-bottom {
        border-top: 1px solid #e5eaf0;
        padding-top: 10px;
        margin-top: 18px;
        color: #64748b;
        font-size: 8px;
    }

    .ps-total,
    .ps-footer,
    .ps-items tr {
        page-break-inside: avoid;
    }
</style>