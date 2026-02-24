<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Acreditación</title>
</head>

<style>
    header{
        position: fixed;
        top: 0cm;
        left: 0cm;
        right: 0cm;
        height: 100px;
        text-align: center;
    }

    header img{
        height: 100px;
        display: block;
        margin-left: auto;
        margin-right: auto;
    }


    body{
        margin-top: 120px;
        margin-bottom: 40px;
        counter-reset: page;
        height: 100%;
        background-image: url("storage/img/escudo_fondo.png");
        background-size: cover;
        background-position: 0 -50px !important;
        font-family: sans-serif;
        font-weight: normal;
        line-height: 1.5;
        text-transform: uppercase;
        font-size: 9px;
    }

    .center{
        display: block;
        margin-left: auto;
        margin-right: auto;
        width: 50%;
    }

    .container{
        display: flex;
        align-content: space-around;
    }

    .parrafo{
        text-align: justify;
    }

    .firma{
        text-align: center;
    }

    .control{
        text-align: center;
    }

    .atte{
        margin-bottom: 10px;
    }

    .borde{
        display: inline;
        border-top: 1px solid;
    }

    .tabla{
        width: 100%;
        font-size: 10px;
        margin-bottom: 30px;;
        margin-left: auto;
        margin-right: auto;
    }

    footer{
        position: fixed;
        bottom: 0cm;
        left: 0cm;
        right: 0cm;
        background: #5E1D45;
        color: white;
        font-size: 12px;
        text-align: right;
        padding-right: 10px;
        text-transform: lowercase;
    }

    .fot{
        display: flex;
        padding: 2px;
        text-align: center;
    }

    .fot p{
        display: inline-block;
        width: 33%;
        margin: 0;
    }

    .qr{
        display: block;
    }

    .no-break{
        page-break-inside: avoid;
    }

    table{
        margin-bottom: 5px;
        margin-left: auto;
        margin-right: auto;
    }

    .separador{
        text-align: justify;
        border-bottom: 1px solid black;
        padding: 0 20px 0 20px;
        border-radius: 25px;
        border-color: gray;
        letter-spacing: 5px;
        margin: 0 0 5px 0;
    }

    .titulo{
        text-align: center;
        font-size: 13px;
        font-weight: bold;
        margin: 0;
    }

    .imagenes{

        max-width: 100%;

    }

    .perito{
        margin: 0;
        font-weight: bold;
    }

</style>

<body>

    <header>

            <img class="encabezado" src="{{ public_path('storage/img/encabezado.png') }}" alt="encabezado">

    </header>

    <footer>

        <div class="fot">
            <p>www.irycem.michoacan.gob.mx</p>
        </div>

    </footer>

    <main>

        <div style="text-align: center; font-weight: bold; font-size: 11px;">
            <P class="titulo" style="margin: 0">DIRECCIÓN GENERAL</P>
        </div>

        <div style="margin-top: 10px; margin-bottom: 10px;">

            <p class="titulo">ACREDITACIÓN PERITO VALUADOR 2026</p>

        </div>

        <p class="parrafo" style="text-align: right;">
            Morelia, Michoacán a  {{ $datos_control->impreso_en }} de 2026 dos mil veintiséis.
        </p>

        <p class="perito">
            {{ $datos_control->perito_nombre }}
        </p>

        <p class="perito">
            PERITO VALUADOR NO. {{ $datos_control->perito_clave }}
        </p>

        <p class="perito">
            {{ $datos_control->perito_direccion }}
        </p>

        <p class="perito">
            p r e s e n t e.-
        </p>

        <p class="parrafo">
            Vista la información exhibida en su ficha de inscripción como Perito Valuador, recibida en esta Dirección de Catastro del Estado, de conformidad con los artículos 86, 87 y 88 del Reglamento de la Ley de la Función Registral y Catastral del Estado de Michoacán de Ocampo; y toda vez que, de conformidad con el artículo 11, fracción XVI del Reglamento Interior del Instituto Registral y Catastral del Estado de Michoacán de Ocampo, se ha integrado un expediente en el que consta que ha cumplido con cada una de las disposiciones normativas y que <span style="text-decoration: underline;">lo reconocen apto para estimar, cuantificar y valorar bienes inmuebles de cualquier clase o naturaleza, incluso aquellos que necesiten reconocimiento especial por su particularidad, que se sometan a su consideración.</span> Con fundamento en el artículo 77 y 86 de la Ley de la Función Registral y Catastral del Estado de Michoacán de Ocampo; por las anteriores consideraciones he tenido a bien acreditarlc como:
        </p>

        <p style="text-align: center;">
            <span style="text-decoration: underline; font-weight: bold;">Perito Valuador Catastral de Bienes Inmuebles durante el Ejercicio Fiscal 2026</span>
        </p>

        <p class="parrafo">
            En virtud de lo precisado hago de su conocimiento que de conformidad con el artículo <span style="text-decoration: underline;">91 del Reglamento de la Ley de la Función Registral y Catastral del Estado de Michoacán de Ocampo</span>, los peritos Valuadores, <span style="text-decoration: underline; font-weight: bold;">serán suspendidos de manera temporal</span> cuando violen disposiciones de la Ley, del Reglamento y del Instructivo Técnico de Valuación Catastral; se negaren a proporcionar documentos o información para la revisión de los avalúos catastrales elaborados por él; cuando proporcionen extemporáneamente sin causa justificada aviso de cambio de domicilio; al no refrendar su registro en los meses enero y febrero de cada año; y al negarse, sin causa justificada, a coadyuvar con el Instituto para el cumplimiento de la función Catastral; <span style="text-decoration: underline; font-weight: bold">así mismo podrán ser suspendidos de manera definitiva</span> cuando con posterioridad a su autorización y registro, se demuestre que a su solicitud acompañó documentos apócrifos; Cuando valúe un predio con valor superior o inferior al real; cuando habiéndose suspendido temporalmente, reincida incurriendo en cualesquiera de las causales descritas con anterioridad; <span style="text-decoration: underline; font-weight: bold;">cuando se desempeñe como servidor público</span> sin que presente escrito de declinatoria para conocer de tramites registrales y/o catastrales; y, cuando cambie su residencia fuera del Estado, <span style="text-decoration: underline; font-weight: bold">por lo que se le exhorta a conducirse siempre bajo a los principios de legalidad, honradez, imparcialidad, eficacia, institucionalidad, transversalidad, transparencia, sustentabilidad e igualdad sustantiva y en estricto apego a la normatividad vigente en materia catastral</span>, apercibido que en caso de no hacerlo, será sancionado de conformidad con la Ley de Responsabilidades Administrativas para el Estado de Michoacán, así como las disposiciones civiles o penales que en su caso ameriten.
        </p>

        <p>
            Sin otro asunto en particular, reciba un cordial saludo.
        </p>

        @if(isset($firma_electronica))

            <p class="parrafo" style="text-align: center;"><span style="text-decoration: underline; font-weight: bold;">A T E N T A M E N T E.</span></p>

            <div class="informacion">

                <div class="no-break">

                    <p style="text-transform: uppercase; text-align: center; font-weight: bold;">LIC. JAVIER ISAAC VARGAS FUENTES</p>
                    <p style="text-align: center; font-weight: bold;" >DIRECTOR GENERAL DEL INSTITUTO REGISTRAL Y CATASTRAL DEL ESTADO DE MICHOACÁN DE OCAMPO</p>

                    <table style="margin-top: 20px">

                        <tr>
                            <td style="padding-right: 40px;">

                                <img class="qr" src="{{ $qr }}" alt="QR">

                            </td>

                            <td style="padding-right: 40px;">

                                <p>Firma Electrónica:</p>
                                <div style="word-wrap: break-word; word-break: break-word;">{{ $firma_electronica->cadena_encriptada }}</div>

                            </td>

                        </tr>

                    </div>

                </div>

            </div>

        @endif

    </main>

</body>
</html>
