<html>
    <head>
        <title>{{$folio->folio . '.pdf'}}</title>
        <style>
            .text-center{
                text-align: center;
            }
            .bold {
                font-weight: bold;
            }

            .text1 {
                color: black;
                font-size: 12pt;
                font-family: Arial, Helvetica, sans-serif;
            }

            .text2 {
                color: black;
                font-size: 15pt;
                font-family: Arial, Helvetica, sans-serif;
            }

            .text3 {
                color: black;
                font-size: 10pt;
                font-family: Arial, Helvetica, sans-serif;
            }

            .fontItalic {
                font-size: 9pt;
                font-family: Arial, Helvetica, sans-serif;
                font-style: italic;
            }

            .fontItalic2 {
                font-size: 10pt;
                font-family: Arial, Helvetica, sans-serif;
                font-style: italic;
            }

            .fontItalic26 {
                font-size: 10pt;
                font-family: Arial, Helvetica, sans-serif;
            }

            .fontItalic20{
                font-size: 10pt;
                font-family: Arial, Helvetica, sans-serif;
            }

            .fontItalic21{
                font-size: 12pt;
                font-family: Arial, Helvetica, sans-serif;
            }

            .fontItalic22{
                font-size: 14.5px;
                font-family: Arial, Helvetica, sans-serif;
            }

            .fontItalic23{
                font-size: 14px;
                font-family: Arial, Helvetica, sans-serif;
            }
            
            .fontItalic3 {
                font-size: 8pt;
                font-family: Arial, Helvetica, sans-serif;
                font-style: italic;
            }

            .fontItalic4 {
                font-size: 11pt;
                font-family: Arial, Helvetica, sans-serif;
                font-style: italic;
            }

            .borde {
                border: 1px solid black;
                margin: 0%;
            }

            .verticalLine {
                border: 0.4px solid black;
            }

        </style>
    </head>
    <body style="margin-bottom:-100px;">

        <header>
            <div style="margin-top: 2px;">
                <div style="margin-left:-16px;display:inline;">
                    <img src={{ asset("images/logo.png") }} class="img-fluid rounded logo">
                </div>
                <div style="text-align: left; float: right; margin-right: 0px; margin-top: -20px">
                   <p class="bold text1">Folio: {{$folio->folio}}</p>
                   <p class="fontItalic" style="margin-top: -20px;">Sample ID </p>

                   <p class="bold text1" style="margin-top: -5px">Fecha de Toma:</p>
                   <p class="fontItalic26" style="margin-top: -33px; margin-left: 165px;   font-weight: bold;"> {{$folio->fechaToma . ' ' . $folio->horaToma}}</p>
                   <p class="fontItalic" style="margin-top: -14px;">Sample Collection Date</p>
                   <p class="fontItalic3" style="margin-top: -28px; margin-left: 165px;">GMT-6: Mexico-Central Time</p>

                   <p class="bold text1" style="margin-top: -5px">Fecha de Reporte:</p>
                   <p class="fontItalic26" style="margin-top: -33px; margin-left: 165px;   font-weight: bold;"> {{$folio->fechaReporte . ' ' . $folio->horaReporte}}</p>
                   <p class="fontItalic"style="margin-top: -15px;">Results Repot Date </p>
                   <p class="fontItalic3" style="margin-top: -28px; margin-left: 165px;">GMT-6: Mexico-Central Time</p>
                </div>
            </div>
        </header>

        <footer>
        </footer>

        <main>
            <p class="text-center bold text2" style="margin-top: 8px; margin-left: -50px;">INFORME DE RESULTADOS</p>
            <p class="text-center fontItalic4" style="margin-top: -23px; margin-left: -50px;">SARS-CoV-2 VIRUS DETECTION REPORT</p>
            <div class="borde" style="margin-left: 30px; margin-right:50px; padding-left:10px; padding-top: 10px;">
                <div style="margin-right: -150px; margin-top:25px; display:inline;">

                    <p class="text3"><span class="bold text1">Nombre/</span>Name:</p>
                    <p class="fontItalic20" style="margin-top: -31px; margin-left: 180px;font-weight: bold;">{{$folio->nombre}}</p>

                    <p class="text3"><span class="bold text1">Sexo/</span>Gender:</p>
                    @if($folio->sexo == "Masculino")
                        <p class="fontItalic20" style="margin-top: -31px; margin-left: 180px;font-weight: bold;"> Male / {{$folio->sexo}}</p>
                    @else
                        <p class="fontItalic20" style="margin-top: -31px; margin-left: 180px;font-weight: bold;"> Female / {{$folio->sexo}}</p>
                    @endif

                    <p class="text3"><span class="bold text1">F. Nacimiento/</span>Birth Date: </p>
                    <p class="fontItalic20" style="margin-top: -31px; margin-left: 180px;font-weight: bold;">{{$folio->fecha}}</p>

                    <p class="text3"><span class="bold text1">Medico//</span>Doctor: </p>
                    <p class="fontItalic20" style="margin-top: -31px; margin-left: 180px;font-weight: bold;">A quien corresponda</p>

                    <p class="bold text1 ">Passport / Official Id:</p>
                    <p class="fontItalic20" style="margin-top: -33px; margin-left: 180px;font-weight: bold;">{{$folio->pasaporte}}</p>

                </div>
                <div class="visible-print" style="float: right; margin-top: -130px; margin-right:20px;">
                    <img src="data:image/svg+xml;base64,{{ base64_encode($valor) }}">
                </div>
            </div>

            <div style="margin-left: 30px; margin-top:-10px;">
                <p class="bold fontItalic21">LOGIX SMART TM COVID-19 TEST KIT Real time RT-PCR</p>
                <img src={{ asset("images/linea.png") }} class="img-fluid rounded logo" style="margin-left: -5px;">

                <div style="margin-top: -18px; ">
                    <p class="fontItalic21" style="margin-left:5px;">PRUEBA PCR PARA COVID19</p>
                    <p class="fontItalic21" style="margin-left: 400px; font-weight: bold; margin-top:-100px">(-)</p>
                </div>
                <div style="margin-top: -30px; ">
                    <p class="fontItalic21" style="margin-left:5px;">COVID19 PCR DETECTION TEST</p>
                    <p class="fontItalic21" style="margin-left: 400px; font-weight: bold; margin-top:-100px">Negative</p>
                </div>
                <div style="margin-top: -15px">
                    <p class="fontItalic22" style="margin-left:5px; text-align: justify; margin-right:40px;line-height: 20px;">
                        <span class="fontItalic23">LOGIX SMART TM COVID-19 TEST KIT </span>is a Real time RT-PCR test. Viral region searched: Gene
                        RdRp <span style="color: white">a</span>of <span style="color: white">a</span>SARS-Cov-2 <span style="color: white">a</span>virus. <span style="color: white">a</span>Controls <span style="color: white">a</span>used: <span style="color: white">a</span>Negative <span style="color: white">a</span>control <span style="color: white">a</span>for <span style="color: white">a</span>PCR, <span style="color: white">.</span> positive control of
                        SARS-Cov-2 virus, positive internal control (CI) of human gene RNase P.</p>
                </div>
                <div style="margin-top: 18px">
                    <p class="fontItalic22" style="margin-left:5px; text-align: justify; margin-right:40px;line-height: 20px;">
                        <span class="fontItalic23">LOGIX SMART TM COVID-19 TEST KIT </span>is a Real time RT-PCR test. Viral region searched: Gene
                        RdRp <span style="color: white">a</span>of <span style="color: white">a</span>SARS-Cov-2 <span style="color: white">a</span>virus. <span style="color: white">a</span>Controls <span style="color: white">a</span>used: <span style="color: white">a</span>Negative <span style="color: white">a</span>control <span style="color: white">a</span>for <span style="color: white">a</span>PCR, <span style="color: white">.</span> positive control of
                        SARS-Cov-2 virus, positive internal control (CI) of human gene RNase P.</p>
                </div>
                <hr class="verticalLine" style="margin-top: 50px;margin-right:40px;">
    

            </div>

            <div>
                <img src={{ asset("images/captura23.png") }} class="img-fluid rounded logo" style="margin-left: 22px; margin-top:3px; width: 682px;height:289px">
            </div>
        </main>
    </body>
</html>
