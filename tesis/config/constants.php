<?php

return [
    'Disco' => 'local',         //Disco donde se guaradará los recaudos
    'Disco_fake' => 'local',    //Disco falso para el uso de test
    'url' => 'http://tesis.test',//Url de la página de inicio de la aplicación

    //Ubicación de las cartas para los test
    'subjects_selection' => 'C:/laragon/www/tesis/public/recaudos/Seleción de materias.pdf',
    'proof_notes' => 'C:/laragon/www/tesis/public/recaudos/Constancia de notas.pdf',
    'currently_schedule' => 'C:/laragon/www/tesis/public/recaudos/Horario.pdf',
    'reason_letter_Parallel' => 'C:/laragon/www/tesis/public/recaudos/Carta de motivo materias en paralelo.pdf',
    'reason_letter_Schedule_collision' => 'C:/laragon/www/tesis/public/recaudos/Carta de motivo colisión de horarios.pdf',
    'reason_letter_Excess_credit_units' => 'C:/laragon/www/tesis/public/recaudos/Carta de motivo exceso de unidades de crédito.pdf',
    'grade_project_proposal_letter' => 'C:/laragon/www/tesis/public/recaudos/PropuestaPG.pdf',
    'grade_project_proposal' => 'C:/laragon/www/tesis/public/recaudos/Propuesta de tesis.pdf',
    'description_proposal' => 'C:/laragon/www/tesis/public/recaudos/DescripciónPropuestaPG.pdf',
    'letter_engagement' => 'C:/laragon/www/tesis/public/recaudos/CartaCompromisoPG.pdf',

    //Ubicación de un archivo txt cualquiera para prueba de test
    'error_archive' => 'C:/laragon/www/tesis/public/recaudos/Error.txt',

    //Ubicación de cartas en formato modificable para ejemplos que el sistema genera a estudiantes
    'Carta_de_motivo_mp'  => '/CartasEjemplos/Carta_de_motivo_materias_en_paralelo.doc',
    'Carta_de_motivo_mp'  => '/CartasEjemplos/Carta_de_motivo_materias_en_paralelo.doc',
    'Carta_de_motivo_mp'  => '/CartasEjemplos/Carta_de_motivo_materias_en_paralelo.doc',
    'Carta_de_motivo_euc'  => '/CartasEjemplos/Carta_de_motivo_exceso_de_unidades_de_credito.doc',
    'Carta_de_motivo_ch'  => '/CartasEjemplos/Carta_de_motivo_colisión_de_horarios.doc',
    'Horario'  => '/CartasEjemplos/Horario.docx',
    'Carta_compromiso'  => '/CartasEjemplos/Carta_compromiso_proyecto_de_grado.doc',
    'Carta_propuesta'  => '/CartasEjemplos/Carta_propuesta_de_proyecto_de_grado.doc',
    'Descripcion_propuesta'  => '/CartasEjemplos/Descripcion_propuesta_de_proyecto_de_grado.doc',

    //Tiempo de caducación de las peticiones en horas, minutos y segundos
    'hour' => 4,
    'minute' => 0,
    'second' => 0,

    //Tiempo de caducación general de todas las cartas en hora militar (De 24 horas)
    'time_to_update' => '03:00',

    //Nombre del archivo donde se guardará la lista de correos de estudiantes
    'name_of_list_students' => 'Correos.csv',
];