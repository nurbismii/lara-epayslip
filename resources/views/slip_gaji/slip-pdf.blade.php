<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Slip Gaji</title>
    <style>@page { size: A4 portrait; margin: 30px 34px; } body { margin: 0; }</style>
    @include('slip_gaji._styles', ['isPdf' => true])
</head>
<body>
    @include('slip_gaji._document')
</body>
</html>
