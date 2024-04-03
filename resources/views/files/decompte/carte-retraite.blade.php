<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Carte Retraite</title>
</head>
<body style="font-family: 'Poppins',sans-serif">
    <div style="width: 80%;margin-bottom:10px; border:1px solid black; margin:auto">


    <table style="width:100%">
        <tbody>
           <tr style="margin-top: 0 !important">

               <td>
                <img src="{{ public_path('LOgo-CNSS.png') }}" width="200" height="100">

                </td>
               <td>
                  <span style="position: relative; top:20; font-size:14px;"> REPUBLIQUE DE GUINEE</span>

                   <div style="width:75%; margin-left:0px;position: relative; top:20">
                     <table style="width: 80%; position: relative; left:5">
                        <tr>
                            <td style="background-color: red; width:55%; height:2px"></td>
                            <td style="background-color: yellow; width:55%"></td>
                            <td style="background-color: green; width:55%"></td>
                        </tr>
                     </table>
                  </div>
                    <div style="margin-left: 20px;position: relative; top: 20 "> <span style="font-size:11px;">Travail-Justice-Solidarite</span></div><br><br>

               </td>
           </tr>
        </tbody>
    </table>
           <div>
                {{-- <h3 style="text-align: center; position: relative; left:60">PENSION DE REtdAITE</h3> --}}
                <h1 style="text-align: center; position: relative; left:0">CARTE DE RETRAITE</h1>
                <h2 style="text-align: center; position: relative; left:0"> <span style="color: red"> N° {{ $no_dossier }} </span> </h2>

           </div>


              <div>
                <img src="{{ storage_path('app/public/pensionnaireImg/'.$photo) }}" style="width:100px; height:100px; margin-left:200px" alt="" srcset="">
              </div>



            <table style="margin-top: 20px; width:100%">
                <tbody>
                    <tr>
                        <th style="width: 0%; text-align:left; font-size: 13px">PRENOMS:</th>
                        <td style="font-size: 13px">{{ $prenom }}</td>
                    </tr>
                    <tr>
                        <th style="width: 0%; font-size: 13px; text-align:left">NOM:</th>
                        <td style="font-size: 13px">{{ $nom }}</td>
                    </tr>
                    <tr>
                        <th style="width: 0%; font-size: 13px; text-align:left">Né(e) le:</th>
                        <td style=" font-weight:bold;font-size: 13px"> {{ \Carbon\Carbon::parse($date_naiss)->format('d/m/Y') }} à {{ $lieu_naiss }}</td>
                    </tr>
                    <tr>
                        <th style="width: 0%; font-size: 13px; text-align:left">DE:</th>
                        <td style="font-size: 13px; "> {{ $pere }} </td>
                    </tr>
                    <tr>
                        <th style="width: 0%; text-align:left; font-size: 13px">ET DE:</th>
                        <td style="font-size: 13px">{{ $mere }}</td>
                    </tr>
                    <tr>
                        <th style="width: 0%; font-size: 13px; text-align:left">N° DE PAIEMENT:</th>
                        <td style="font-size: 13px; color: red;"></td>
                    </tr>
                    <tr>
                        <th style="width: 0%; font-size: 13px; text-align:left">N° CIN:</th>
                        <td style=" font-weight:bold;font-size: 13px">{{ $c_in }}</td>
                    </tr>
                    <tr>
                        <th style="width: 0%; font-size: 13px; text-align:left">DELIVRÉE LE:</th>
                        <td style="font-size: 13px;"> {{$date}}</td>
                    </tr>
                    <tr>
                        <th style="width: 0%; text-align:left; font-size: 13px">À:</th>
                        <td style="font-size: 13px;">{{ $agence }}</td>
                    </tr>
                    <tr>
                        <th style="width: 0%; text-align:left; font-size: 13px">DATE DE JOUISSANCE:</th>
                        <td style="font-size: 13px; color: red;"></td>
                    </tr>
                </tbody>
            </table>
        {{-- <img src="{{ public_path('cnsslogo2.png') }}" width="300" height="300"
        style=" opacity: 0.1; position:absolute; left: 95px; top:100px;"> --}}

    <div style="margin-left:10px; margin-top:20px">
        {!! DNS2D::getBarcodeHTML($no_assure, 'QRCODE',5,5) !!}
    </div>
 <h5>Le Chef de Service:</h5>
 <p style="text-align: right;">Signature du Bénéficiaire:</p>


    <div style="width: 20%; font-size: 11px;">
        <img src="{{ public_path('flagui.png') }}" width="100" height="40">
     </div>

    <div style="text-align: center;font-size: 11px;">
        <span style="text-align: center; font-weight:bold">République de Guinée</span> <br>
        <span style="text-align: center;">Caisse Nationale de sécurité Sociale, Kouléwondy - Kaloum BP 138</span> <br>
        <span>République de Guinée | www.cnss.gov.gn</span>
    </div>
</div>
</body>
</html>
