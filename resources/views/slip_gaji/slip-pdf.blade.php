<?php
$pecah = explode("-", $cek->periode);
$bulan = $pecah[1];
$kurang = $bulan - 1;
if($kurang == "0"){
    $bln_kemarin = 12;
} else {
    $bln_kemarin = $kurang;
}
if($bln_kemarin == "01"){
    $nm_bln1 = "JANUARI";
} else if($bln_kemarin == "02") {
    $nm_bln1 = "FEBRUARI";
} else if($bln_kemarin == "03") {
    $nm_bln1 = "MARET";
}  else if($bln_kemarin == "04") {
    $nm_bln1 = "APRIL";
}  else if($bln_kemarin == "05") {
    $nm_bln1 = "MEI";
}  else if($bln_kemarin == "06") {
    $nm_bln1 = "JUNI";
}  else if($bln_kemarin == "07") {
    $nm_bln1 = "JULI";
}  else if($bln_kemarin == "08") {
    $nm_bln1 = "AGUSTUS";
}  else if($bln_kemarin == "09") {
    $nm_bln1 = "SEPTEMBER";
}  else if($bln_kemarin == "10") {
    $nm_bln1 = "OKTOBER";
}  else if($bln_kemarin == "11") {
    $nm_bln1 = "NOVEMBER";
}  else if($bln_kemarin == "12") {
    $nm_bln1 = "DESEMBER";
}
$thn = $pecah[0];
if($bulan == "01"){
    $nm_bln = "JANUARI";
} else if($bulan == "02") {
    $nm_bln = "FEBRUARI";
} else if($bulan == "03") {
    $nm_bln = "MARET";
}  else if($bulan == "04") {
    $nm_bln = "APRIL";
}  else if($bulan == "05") {
    $nm_bln = "MEI";
}  else if($bulan == "06") {
    $nm_bln = "JUNI";
}  else if($bulan == "07") {
    $nm_bln = "JULI";
}  else if($bulan == "08") {
    $nm_bln = "AGUSTUS";
}  else if($bulan == "09") {
    $nm_bln = "SEPTEMBER";
}  else if($bulan == "10") {
    $nm_bln = "OKTOBER";
}  else if($bulan == "11") {
    $nm_bln = "NOVEMBER";
}  else if($bulan == "12") {
    $nm_bln = "DESEMBER";
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>SLIP GAJI</title>
</head>
<body>
	<style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
	</style>
<div>
	<table style="width:65%;" align="left">
        <tr>
            <td>NAMA</td>
            <td>:</td>
            <td>{{ $cek->data_karyawan->nama }}</td>
        </tr>
        <tr>
            <td>NIK</td>
            <td>:</td>
            <td>{{ $cek->data_karyawan->nik }}</td>
        </tr>
        <tr>
            <td>DEPARTEMEN</td>
            <td>:</td>
            <td>{{ $cek->departemen }}</td>
        </tr>
        <tr>
            <td>DIVISI</td>
            <td>:</td>
            <td>{{ $cek->divisi }}</td>
        </tr>
        <tr>
            <td>POSISI</td>
            <td>:</td>
            <td>{{ $cek->posisi }}</td>
        </tr>
    </table>

    <table style="width:30%;" align="right" >
        <tr>
            <td><b>PRIBADI DAN RAHASIA</b></td>
        </tr>
        <tr>
            @if($cek->data_karyawan->nm_perusahaan == "VDNI")
                <td><img src="{{ public_path('assets/images/logo-dark.png') }}" alt="" height="22"></td>
            @elseif($cek->data_karyawan->nm_perusahaan == "VDNI-P")
                <td><img src="{{ public_path('assets/images/vdnip-logo.png') }}" alt="" height="30"></td>
            @else
                <td><img src="{{ public_path('assets/images/logo-dark.png') }}" alt="" height="22"></td>
            @endif
        </tr>
        <tr>
            <td>SLIP GAJI {{ $nm_bln }} {{ $thn }}</td>
        </tr>
        <tr>
            <td>( PERIODE 21 {{ $nm_bln1 }} - 20 {{ $nm_bln }} )</td>
        </tr>
    </table>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <table style="width:49%;" align="left">
        <tr>
            <td>JUMLAH HARI KERJA</td>
            <td>:</td>
            <td>{{ $cek->jml_hari_kerja }} HARI</td>
        </tr>
        <tr>
            <td>STATUS GAJI</td>
            <td>:</td>
            <td> {{ $cek->status_gaji }}</td>
        </tr>
   </table>
   <table style="width:49%;" align="right">
        <tr>
            <td style="width: 180px">JUMLAH HOUR MACHINE</td>
            <td style="width: 15px">:</td>
            <td>{{ $cek->jml_hour_machine }} JAM</td>
        </tr>

</table>
   <br>
   <br>
   <table style="width:49%;" align="left">
        <tr>
            <td colspan="3"><b>RINCIAN GAJI :</b></td>
        </tr>
        <tr>
            <td>GAJI POKOK</td>
            <td>:</td>
            <td>Rp. {{ number_format($cek->gaji_pokok) }} </td>
        </tr>
        <tr>
            <td>TUNJANGAN UANG MAKAN</td>
            <td>:</td>
            <td>Rp. {{ number_format($cek->tunj_um) }}</td>
        </tr>
        <tr>
            <td>TUNJANGAN PENGAWAS</td>
            <td>:</td>
            <td>Rp. {{ number_format($cek->tunj_pengawas) }}</td>
        </tr>
        <tr>
            <td>TUNJANGAN KOEFISIEN JABATAN </td>
            <td>:</td>
            <td>Rp. {{ number_format($cek->tunj_koefisien) }}</td>
        </tr>
        <tr>
            <td>TUNJANGAN MASA KERJA</td>
            <td>:</td>
            <td>Rp. {{ number_format($cek->tunj_mk) }}</td>
        </tr>
        @if(!empty($cek->tunj_transport))
        <tr>
            <td>TUNJANGAN TRANSPORT & PULSA</td>
            <td>:</td>
            <td>Rp. {{ number_format($cek->tunj_transport) }}</td>
        </tr>
        @endif
        @if(!empty($cek->tunj_lap))
        <tr>
            <td>TUNJANGAN KINERJA DAN LAPANGAN</td>
            <td>:</td>
            <td>Rp. {{ number_format($cek->tunj_lap) }}</td>
        </tr>
        @endif
        <tr>
            <td>OVERTIME</td>
            <td>:</td>
            <td>Rp. {{ number_format($cek->ot) }}</td>
        </tr>
        <tr>
            <td>HOUR MACHINE</td>
            <td>:</td>
            <td>Rp. {{ number_format($cek->hm) }}</td>
        </tr>
        @if(!empty($cek->insentif))
        <tr>
            <td>INSENTIF</td>
            <td>:</td>
            <td>Rp. {{ number_format($cek->insentif) }}</td>
        </tr>
        @endif
        <tr>
            <td>RAPEL</td>
            <td>:</td>
            <td>Rp. {{ number_format($cek->rapel) }}</td>
        </tr>
        @if(!empty($cek->bonus))
        <tr>
            <td>BONUS</td>
            <td>:</td>
            <td>Rp. {{ number_format($cek->bonus) }}</td>
        </tr>
        @endif
        @if(!empty($cek->thr))
        <tr>
            <td>TUNJANGAN HARI RAYA</td>
            <td>:</td>
            <td>Rp. {{ number_format($cek->thr) }}</td>
        </tr>
        @endif
    </table>

    <table style="width:49%;" align="right">
        <tr>
            <td colspan="3"><b>POTONGAN :</b></td>
        </tr>
     <tr>
         <td>BPJS TK JHT</td>
         <td>:</td>
         <td>Rp. {{ number_format($cek->jht) }} </td>
     </tr>
     <tr>
         <td>BPJS TK JP</td>
         <td>:</td>
         <td>Rp. {{ number_format($cek->jp) }}</td>
     </tr>
     <tr>
         <td>BPJS KESEHATAN</td>
         <td>:</td>
         <td>Rp. {{ number_format($cek->pot_bpjskes) }}</td>
     </tr>
     <tr>
         <td>DEDUCTION UNPAID LEAVE </td>
         <td>:</td>
         <td>Rp. {{ number_format($cek->unpaid_leave) }}</td>
     </tr>
     <tr>
         <td>DEDUCTION</td>
         <td>:</td>
         <td>Rp. {{ number_format($cek->deduction) }}</td>
     </tr>
     <tr>
        <td>DEDUCTION PPH 21</td>
        <td>:</td>
        <td>Rp. {{ number_format($cek->deduction_pph21) }}</td>
    </tr>
     <tr>
         @if($cek->durasi_sp == "1970-01-01")
             <?php $durasi_sp = ""; ?>
         @else
             <?php $durasi_sp =$cek->durasi_sp; ?>
         @endif
         <td>DURASI SURAT PERINGATAN</td>
         <td>:</td>
         <td>{{ $durasi_sp }}</td>
     </tr>

     <tr>
         <td>TOTAL DITERIMA</td>
         <td>:</td>
         <td><b>Rp. {{ number_format($cek->tot_diterima) }} </b></td>
     </tr>
    <tr>
        <td></br></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td></br></td>
        <td></td>
        <td></td>
    </tr>
     <tr>
         <td></td>
         <td></td>
         <td>MOROSI, 31 {{ $nm_bln }} {{ $thn }}</td>
     </tr>
     <tr>
         <td>DI TRANSFER KE</td>
         <td></td>
         <td>DI BUAT OLEH,</td>
     </tr>
     <tr>
         <td>{{ $cek->bank_number }}</td>
         <td></td>
         <td></td>
     </tr>
     <tr>
         <td>{{ $cek->bank_name }}</td>
         <td></td>
         <td>PAYROLL</td>
     </tr>
     <tr>
        <td>{{ $cek->data_karyawan->nama }}</td>
        <td></td>
        <td></td>
    </tr>
</table>
</body>
</html>
