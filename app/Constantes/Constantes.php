<?php

namespace App\Constantes;

class Constantes{

    const AREAS = [
        'Roles',
        'Permisos',
        'Usuarios',
        'Avalúos',
        'Umas',
        'Consultas'
    ];

    const TIPO_VIALIDADES = [
        'AMPLIACIÓN',
        'ANDADOR',
        'ARROYO O CANAL',
        'AVENIDA',
        'BOULEVARD',
        'BRECHA',
        'CALLE',
        'CALLEJÓN',
        'CALZADA',
        'CAMINO',
        'CAMINO REAL',
        'CARRETERA',
        'CERRADA',
        'CIRCUITO',
        'CIRCUNVALACIÓN',
        'CONTINUACIÓN',
        'CORREDOR',
        'CUARTEL',
        'DIAGONAL',
        'EJE VIAL',
        'PASAJE',
        'PEATONAL',
        'PERIFÉRICO',
        'PLAZA',
        'PORTAL',
        'PRIVADA',
        'PROLONGACIÓN',
        'RETORNO',
        'SERVIDUMBRE DE PASO',
        'VIADUCTO'
    ];

    const TIPO_ASENTAMIENTO = [
        'AEROPUERTO',
        'AMPLIACIÓN',
        'BARRIO',
        'CANTON',
        'CIUDAD',
        'CIUDAD INSDUSTRIAL',
        'COLONIA',
        'CONDOMINIO',
        'CONJUNTO HABITACIONAL',
        'CORREDOR INDUSTRIAL',
        'COTO',
        'CUARTEL',
        'EJIDO',
        'EX-EJIDO',
        'EXHACIENDA',
        'FRACCIÓN',
        'FRACCIONAMIENTO',
        'GRANJA',
        'HACIENDA',
        'INGENIO',
        'MANZANA',
        'PARAJE',
        'PARQUE INDUSTRIAL',
        'POBLADO',
        'PRIVADA',
        'PROLONGACIÓN',
        'PUEBLO',
        'PUERTO',
        'RANCHERIA',
        'RANCHO',
        'REGIÓN',
        'RESIDENCIAL',
        'RINCONADA',
        'SECCIÓN',
        'SECTOR',
        'SUPERMANZANA',
        'TENENCIA',
        'UNIDAD',
        'UNIDAD HABITACIONAL',
        'VILLA',
        'ZONA FEDERAL',
        'ZONA INDUSTRIAL',
        'ZONA MILITAR',
        'ZONA NAVAL',
    ];

    const VIENTOS = [
        'ANEXO',
        'ESTE',
        'NORESTE',
        'NOROESTE',
        'NORORIENTE',
        'NORPONIENTE',
        'NORTE',
        'OESTE',
        'ORIENTE',
        'PONIENTE',
        'SUR',
        'SURESTE',
        'SUROESTE',
        'SURORIENTE',
        'SURPONIENTE',
    ];

    const CLASIFICACION_ZONA = [
        'NO APLICA',
        'HAB. DEN. SUBURBANA MENOR 50 HAB POR HA',
        'HAB. DEN. BAJA 51 - 150 HAB POR HA',
        'HAB. DEN. MEDIA 151 - 300 HAB POR HA',
        'HAB. DEN. ALTA 301 - 500 HAB POR HA',
        'HAB. DEN. MEDIA SE Y CO,300 HAB POR HA',
        'HAB. DEN. MEDIA CO IN Y SE,300 HABPORHA',
        'SUBCENTRO URBANO HASTA 120 VIV POR HA',
        'CENTRO URBANO HASTA 120 VIV POR HA',
        'CENTRO METROP. HASTA 72 VIV POR HA',
        'ZONA DE MONUMENTOS',
        'ZONA DE TRANSICIÓN',
        'INDUSTRIAL',
        'ÁREAS VERDES YO EQUIPAMIENTO',
        'PARQUE URBANO ECOLÓGICO',
        'EQUIPAMIENTO',
        'INFRAESTRUCTURA',
        'VIALIDAD Y DERECHO DE PASO',
        'PROTECCIÓN ESPECIAL',
        'PROTECCIÓN ECOLÓGICA ESPECIAL',
        'ÁREA NATURAL PROTEGIDA (DECRETADA)',
        'ZONA DE RESTAURACIÓN Y PROT. AMBIENTAL',
        'PROTECCIÓN AGROPECUARIA',
        'PROTECCIÓN USOS AGRICOLAS',
        'PROTECCIÓN USOS PECUARIOS',
        'COMERCIAL Y HABITACIONAL',
    ];

    const CONSTRUCCION_DOMINANTE = [
        'NO APLICA',
        'UN NIVEL (ECONOMICA)',
        'UN NIVEL (IND. LIGERA)',
        'UN NIVEL  (IND. MEDIA)',
        'UN NIVEL  (PESADA)',
        'DOS NIVELES (MEDIA)',
        'DOS NIVELES (MEDIA -SUPERIOR)',
        'DOS  NIVELES  (SUPERIOR)',
        'UNO Y DOS NIVELES  (ECONOMICA - MEDIA)',
        'UNO Y DOS NIVELES  (IND. LIGERA Y MEDIA)',
        'UNO Y DOS NIVELES  (IND. MEDIA - PESADA)',
        'DOS Y TRES NIVELES (MEDIA - SUPERIOR)',
    ];

    const CIMENTACION = [
        'NO APLICA',
        'MAMPOSTERIA',
        'ZAPATA AISLADA',
        'ZAPATAS CORRIDAS',
        'LOSA DE CIMENTACION',
    ];

    const ESTRUCTURAS = [
        'NO APLICA',
        'COLUMNAS CANTERA O MADERA',
        'TRABES, CASTILLOS, CADENA DE CERRAMIENTO',
        'C. CONCRE., TRABES, CAST. Y C. DE CERRAM',
        'C. METALI., TRABES, CAST. Y C. DE CERRAM',
        'MUROS DE CARGA DE CONCRETO ARMADO',
    ];

    const MUROS = [
        'NO APLICA',
        'MULTIPANEL',
        'MADERA Y ADOBE',
        'PIEDRA O ADOBE',
        'TABIQUE Y/O TABICON',
        'TABIQUE Y CONCRETO',
        'CONCRETO ARMADO',
        'MAMPOSTERÍA'
    ];

    const ENTREPISOS = [
        'NO APLICA',
        'BOVEDA  CATALANA',
        'MADERA',
        'LOSA RETICULAR',
        'LOSA DE CONCRETO  REFORZADO',
        'ESTRUCTURA METALICA O MIXTA',
        'ARMADURAS DE MONTEN O ANGULOS SENCILLOS',
        'ARMADURAS METALICAS DE PERALTE REGULAR',
        'ARMADURAS  METALICAS DE GRAN PERALTE',
        'TRIDILOSA',
    ];

    CONST TECHOS = [
        'NO APLICA',
        'BOVEDA  CATALANA',
        'MADERA   ',
        'LOSA RETICULAR',
        'LOSA DE CONCRETO  REFORZADO',
        'ESTRUCTURA METALICA O MIXTA',
        'ARMADURAS DE MONTEN O ANGULOS SENCILLOS',
        'ARMADURAS METALICAS DE PERALTE REGULAR',
        'ARMADURAS  METALICAS DE GRAN PERALTE',
        'TRIDILOSA',
        'TEJA',
        'LAMINA DE CARTON',
        'LAMINA ACRILICA',
        'LAMINA GALVANIZADA',
        'LAMINA DE ASBESTO-CEMENTO',
        'LAMINA DE CARTON-ASBESTO-CEMENTO',

    ];

    const PLAFONES = [
        'NO APLICA',
        'MANTA DE CIELO',
        'MEZCLA DE MORTERO',
        'YESO Y/O PASTA',
        'TABLAROCA',
    ];

    const VIDRIERIA = [
        'NO APLICA',
        'SENCILLOS 3MM, LISO Y/O CHINO',
        'SEMI DOBLE 6MM LISO Y/O CHINO O COLOR',
        'FILTRASOL DE VARIOS ESPESORES',
        'EMPLOMADO',
        'TEMPLADO ',
        'VITRALES',
    ];

    const LAMBRINES = [
        'NO APLICA',
        'MADERAS',
        'AZULEJO',
        'CERAMICA',
    ];

    const PISOS = [
        'NO APLICA',
        'FIRME DE CONCRETO',
        'MADERA',
        'MOSAICO',
        'CERAMICA',
        'LOSETA DE BARRO',
        'PARQUET',
        'DUELA',
    ];

    const HERRERIA = [
        'NO APLICA',
        'FIERRO FORJADO',
        'ESTRUCTURAL',
        'TUBULAR',
        'ALUMINIO DE VARIOS CALIBRES',
    ];

    const PINTURA = [
        'NO APLICA',
        'A LA CAL',
        'VINILICA',
        'ESMALTE',
    ];

    const CARPINTERIA = [
        'NO APLICA',
        'MADERA ECONOMICA',
        'MADERA DE MEDIANA CALIDAD',
        'MADERAS FINAS',
    ];

    const APLANADOS = [
        'NO APLICA',
        'ESTUCO',
        'BARRO',
        'MEZCLA DE MORTERO',
        'YESO ',
        'PASTAS',
    ];

    const RECUBRIMIENTO_ESPECIAL = [
        'NO APLICA',
        'PAPEL TAPIZ',
        'ALFOMBRA',
        'MADERA',
        'PIEDRA',
        'AZULEJO',
    ];

    const HIDRAULICA = [
        'NO APLICA',
        'GALVANIZADA',
        'GALVANIZADA, COBRE',
        'COBRE',
        'PVC',
        'CPVC'
    ];

    const SANITARIA = [
        'NO APLICA',
        'ALBAÑAL DE CEMENTO',
        'ALBAÑAL FORJADO',
        'PVC VARIOS DIAMETROS',
    ];

    const ELECTRICA = [
        'NO APLICA',
        'VISIBLES',
        'OCULTA',
    ];

    const GAS = [
        'NO APLICA',
        'GALVANIZADA',
        'COBRE',
    ];

    const ESPECIALES = [
        'NO APLICA',
        'GAS ESTACIONARIO',
        'INTERFON',
        'CIRCUITO CERRADO DE TV',
        'SISTEMA DE CALEFACCÓN',
        'CALENTADOR SOLAR',
        'AIRE ACONDICIONADO'
    ];

    const USO_PREDIO = [
        'AEROPUERTO',
        'AGENCIA DE AUTOS',
        'AGENCIA DE VIAJES',
        'AGOSTADERO',
        'AGRICOLA',
        'AGROPECUARIO',
        'ALBERCA',
        'ALBERGUE',
        'APARTAMENTO',
        'ASILO',
        'ASISTENCIA PUBLICA',
        'AUTO LAVADO',
        'BALDIO',
        'BALNEARIO',
        'BANCOS',
        'BAÑOS',
        'BASCULA',
        'BIBLIOTECA',
        'BILLARES',
        'BODEGA',
        'CABAÑA',
        'CAMPO DE GOLF',
        'CANTINA CABARET',
        'CARCEL',
        'CARNICERIA',
        'CASA HABITACION',
        'CASA HOGAR',
        'CASETA DE POLICIA',
        'CASETA DE VIGILANCIA',
        'CENTRAL ELECTRICA',
        'CLINICA',
        'CLUB',
        'COCHERA',
        'COMERCIO',
        'COMITE EJIDAL',
        'CONSULTORIO MEDICO',
        'CONVENTO',
        'CUARTEL DE BOMBEROS',
        'DEPARTAMENTO',
        'DEPOSITO DE AGUA',
        'DIREC DE TRANSITO',
        'DISPENSARIO',
        'EMPACADORA',
        'EN CONSTRUCCION',
        'ERIAZO',
        'ESCUELA PARTICULAR',
        'ESCUELA PUBLICA',
        'ESTABLO',
        'ESTACION FFCC',
        'ESTADIO',
        'FABRICAS',
        'FARMACIA',
        'FRUTERIA',
        'GALERA',
        'GASERA',
        'GASOLINERA',
        'GRANJA',
        'GUARDERIA',
        'HOSPITAL',
        'HOTEL',
        'HUERTA',
        'HUMEDAD',
        'IGLESIAS',
        'INFRAESTRUCTURA',
        'INSTALACIONES DEPORTIVAS',
        'JARDIN',
        'KIOSCO',
        'LABORATORIO',
        'LADRILLERA',
        'LAVANDERIA PUBLICA',
        'LICORERIA VINATERIA',
        'LIENZO CHARRO',
        'MADERERIA',
        'MERCADO',
        'MOLINO',
        'MONTE ALTO',
        'MONTE BAJO',
        'MONUMENTO HISTORICO',
        'NAVE INDUSTRIAL',
        'NO CLASIFICA',
        'OFICINA DE VENTAS',
        'OFICINAS',
        'OFICINAS DE GOBIERNO',
        'OFICINAS GENERALES',
        'PANTEON',
        'PELUQUERIA',
        'PENSION AUTOMOVILES',
        'PENTH HOUSE',
        'PLANTA INDUSTRIAL',
        'PLANTA TRATADORA DE AGUA',
        'PLAZA CIVICA',
        'PLAZA DE TOROS',
        'POZO PROFUNDO',
        'PRESIDENCIA MPAL',
        'PROPIEDAD FEDERAL',
        'RADIODIFUSORA',
        'RASTRO',
        'RESTAURANTE',
        'RIEGO MECANICO',
        'RIEGO POR GRAVEDAD',
        'RUINAS',
        'SALA DE BELLEZA',
        'SALA DE ESPECTACULOS',
        'SALON DE FIESTAS',
        'SASTRERIA',
        'SERVIDUMBRE DE PASO',
        'SILVOPASTORIL',
        'SIN USO DE PREDIO',
        'SINDICATO',
        'SUPERMERCADO',
        'TALLER',
        'TANQUE METALICO',
        'TEMPORAL DE PRIMERA',
        'TEMPORAL DE SEGUNDA',
        'TEMPORAL DE TERCERA',
        'TENERIA',
        'TERMINAL DE CAMIONES',
        'TINTORERIA',
        'UNIDAD DEPORTIVA',
        'UNIDAD HOGAR',
        'USO COMERCIAL',
        'VECINDAD',
        'VETERINARIA',
        'VIVERO',
        'ZAHURDA',
        'ZAPATERIA',
        'ZOOLOGICO',
    ];

    const UBICACION_PREDIO = [
        'INTERMEDIO',
        'ESQUINA',
        'TRANSVERSAL CON FRENTES NO CONTIGUOS',
        'CABECERA',
        'MANZANERO',
        'INTERIOR',
    ];

    const AÑOS = [
        '2023',
        '2024',
        '2025',
        '2026'
    ];

    const ASOCIACIONES = [
        'AABPE',
        'APROVAM',
        'CIMVMAC',
        'COMIAVI',
        'INVAFAC',
        'SAIVAL',
        'SAVAC',
        'SEDUM',
        'SIAVAC',
        'SICIV',
    ];

}
