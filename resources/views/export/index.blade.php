<html>
<head>
    <style>
        @page {
            margin: 0cm 0.5cm 0cm 0.5cm;
            font-family: Arial;
        }
 
        body {
            margin: 1.5cm 0.5cm 0.5cm 0.5cm;
            font-family:arial;
            font-size:12px;
        }
 
        header {
            position: fixed;
            height: 1cm;
            color: #000;
            text-align: center;
            padding:10px;
            font-size:12px;
            font-family:arial;
           
        }
        thead{
            background-color: #eee;
            font-weight:bold;
            font-family:Arial;
            font-size:12px;
        }

        td{
            height:35px;
        }
        .td{
            border-bottom:1px solid #ddd;
            border-left:1px solid #ddd;
            padding:5px;
            font-family:Arial;
            font-size:11px;
        }
        th{
            height:35px;    
        }
        .stockcero{
            background-color:#FFDCD4;
            color:#000;
        }
        footer {
            position: fixed;
            bottom: 10px;
            height: 0.8cm;
            color:#000;
            text-align: center;
            font-size:11px;
            padding:12px;
            font-family:Arial;
            padding:10px;
        }
    </style>
</head>
<body>
<header>
   <table width="100%" border="0" style="border-collapse: collapse;border-bottom:1px solid #ddd;">
        <tr>
            <td width="70%" height="30" align="left" valign="top"></td>
            <td width="30%" height="30" align="right" valign="middle">Reporte de Citas</td>
        </tr>
   </table>
</header>
 
<main>
  
<table width="100%" border="0" style="border-collapse: collapse;border:1px solid #ddd;">
<thead>
<tr>
    <td align="center">N°</td>
    <td>Nombres y Apellidos</td>
    <td align="center">edad</td>
    <td align="center">Grado</td>
    <td align="center">Nº Telefono</td>
    <td align="center">Responsable</td>
    <td align="center">Fecha</td>
    <td align="center">Asunto</td>
</tr>
</thead>
<?php
$total=0;
?>
@foreach($records  as $row)
<tr>
<td class="td"  align="center">{{$loop->iteration }}</td>
    <td class="td" align="center">{{$row->students->name}} {{$row->students->surnames}}</td>
    <td class="td">{{$row->students->age}}</td>
    <td class="td" align="center">{{$row->students->grade}}</td>
    <td class="td" align="center">{{$row->students->phone}}</td>
    <td class="td" align="center">{{$row->user->name}}</td>
    <td class="td" align="center">{{ \Carbon\Carbon::parse($row->date)->format('d-m-Y') }}</td>
    <td  class="td" align="center">{{$row->affair}}</td>
</tr>
@endforeach

<table>
</main>
</body>
</html>