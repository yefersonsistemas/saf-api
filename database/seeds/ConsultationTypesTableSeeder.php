<?php

use Illuminate\Database\Seeder;
use App\ConsultationType;

class ConsultationTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ConsultationType::truncate();
        //factory(ConsultationType::class, 20)->create();

        // Dr Jose Pastor
        factory(ConsultationType::class)->create([
            'name'        => 'Toma de muestra de biopsia',
            'description' => 'Es un procedimiento que se realiza para extraer una pequeña muestra de tejido o de células del cuerpo para su análisis en un laboratorio.'
        ]);

        factory(ConsultationType::class)->create([
            'name'        => 'Endoscopia',
            'description' => 'Es un procedimiento que permite que el médico vea el interior de su cuerpo. Utiliza un instrumento llamado endoscopio o tubo visor.'
        ]);

        factory(ConsultationType::class)->create([
            'name'        => 'Aspiración de secreciones',
            'description' => 'Es un procedimiento efectivo cuando el paciente no puede expectorar las secreciones, ya sea a nivel nasotraqueal y orotraqueal, o bien la aspiración traqueal en pacientes con vía aérea artificial.'
        ]);

        factory(ConsultationType::class)->create([
            'name'        => 'Adenoidectomía',
            'description' => 'es la extirpación quirúrgica de la adenoide por razones que incluyen dificultad para respirar por la nariz, infecciones crónicas o dolores de oído recurrentes.'
        ]);

        factory(ConsultationType::class)->create([
            'name'        => 'Amigdalectomía',
            'description' => 'es un procedimiento quirúrgico en el que ambas amígdalas palatinas se extraen completamente de la parte posterior de la garganta.'
        ]);

        factory(ConsultationType::class)->create([
            'name'        => 'Miringotomía',
            'description' => 'Es un procedimiento quirúrgico en el cual se crea una pequeña incisión en el tímpano para aliviar la presión causada por la acumulación excesiva de líquido o para drenar pus del oído medio. '
        ]);

        factory(ConsultationType::class)->create([
            'name'        => 'Colocación de tubos ventilatorios',
            'description' => 'Los tubos ventilatorios son unos tubitos muy delgados, los cuales se colocan en un pequeño orificio en el tímpano. Son hechos de diferentes materiales: plástico, metal o teflón.'
        ]);

        factory(ConsultationType::class)->create([
            'name'        => 'Cirugía láser de cornetes inferiores',
            'description' => 'Es un procedimiento que se realiza con frecuencia en otorrinolaringología, ya que la reducción del revestimiento nasal puede disminuir algunos de los síntomas de la rinitis alérgica, en particular el bloqueo nasal. '
        ]);

        factory(ConsultationType::class)->create([
            'name'        => 'Cirugía endoscópica de senos paranasales',
            'description' => 'Se hace para abrir los pasajes de los senos paranasales y permitir un drenaje adecuado hacia la nariz. Se denomina procedimiento endoscópico porque el médico utiliza un endoscopio para observar el interior de la nariz. '
        ]);

        factory(ConsultationType::class)->create([
            'name'        => 'Cirugía endoscópica de base de cráneo',
            'description' => 'Permite acceder al cráneo a través de la cavidad nasal, sin necesidad de abrir el cráneo, mediante endoscopios.La base del cráneo es la parte ósea que soporta al cerebro y lo separa del resto de la cabeza. Por la zona inferior encontramos los nervios y vasos que van al cerebro y, por debajo, están las estructuras nasales, cavidades sinusales, huesos faciales y los músculos asociados con la masticación.'
        ]);
        // fin

        // Dra Gabriela Linarez
        factory(ConsultationType::class)->create([
            'name'        => 'Colocación y retiro de dispositivo DIU',
            'description' => 'El DIU es un pequeño dispositivo que se coloca en el útero para evitar embarazos. Es duradero, reversible y uno de los métodos anticonceptivos más eficaces que existen.'
        ]);
        factory(ConsultationType::class)->create([
            'name'        => 'Colocación y retiro de implantes intradermicos',
            'description' => 'es una varilla pequeña y delgada del tamaño de un fósforo. El implante libera hormonas en el organismo que previenen el embarazo.'
        ]);
        factory(ConsultationType::class)->create([
            'name'        => 'Tratamientos para VPH',
            'description' => 'El tratamiento se centra en eliminar las verrugas.'
        ]);
        factory(ConsultationType::class)->create([
            'name'        => 'Marsupialización de glandula de Bartholino',
            'description' => 'es la técnica quirúrgica de cortar una rendija en un absceso o quiste y suturar los bordes de la rendija para formar una superficie continua desde la superficie exterior a la superficie interior del quiste o absceso.'
        ]);
        factory(ConsultationType::class)->create([
            'name'        => 'Rejuvenecimiento vaginal',
            'description' => 'El término rejuvenecimiento vaginal se refiere a un grupo de procedimientos. En el caso del área de la genitalia externa, los tratamientos buscan mejorar la apariencia de la labia interna o externa, o ambas, con la intención de lograr una apariencia más juvenil.'
        ]);  
        factory(ConsultationType::class)->create([
            'name'        => 'Blanqueamiento vaginal y anal',
            'description' => 'es el tratamiento estético que se emplea cuando una persona quiere deshacerse de la hiperpigmentación de sus partes íntimas. Incluso de las zonas cercanas a ésta, como la entrepierna y el ano.'
        ]);
        factory(ConsultationType::class)->create([
            'name'        => 'Relleno de labios mayores',
            'description' => 'Este tratamiento consiste en rellenar con ácido hialurónico la zona genital hasta conseguir el volumen deseado. '
        ]);
        factory(ConsultationType::class)->create([
            'name'        => 'Tóxina botulínica (botox) cara y cuello',
            'description' => 'Es una neurotoxina elaborada por el Clostridium botulinum, que tiene la capacidad de producir parálisis muscular. Su uso en dermatología estética es selectivo sobre ciertos músculos faciales que, debido a su contracción, producen arrugas dinámicas o de expresión.'
        ]);
        factory(ConsultationType::class)->create([
            'name'        => 'Peeling facial y corporal',
            'description' => 'es una técnica utilizada para mejorar y suavizar la textura de la piel. La piel de la cara se trata principalmente, y las cicatrices pueden mejorar. Las exfoliaciones químicas están destinadas a eliminar las capas más externas de la piel.'
        ]);
        factory(ConsultationType::class)->create([
            'name'        => 'Plasma gel y PRP convencional (facial, corporal y ginecológico)',
            'description' => 'Consisten en tomar una muestra de sangre del paciente, ésta pasa por un proceso de centrifugado para separar los glóbulos rojos del plasma y así se separará entre el pobre, medio y el rico. '
        ]);
        factory(ConsultationType::class)->create([
            'name'        => 'Tratamiento de hiperpigmentación  y estrias',
            'description' => 'tratamiento está recomendado para todo tipo de pieles y estrías.'
        ]);
        factory(ConsultationType::class)->create([
            'name'        => 'Labioplastia',
            'description' => 'es un procedimiento para alterar los labios menores y los labios mayores. Los labios son los pliegues de la piel que rodean la vulva.'
        ]);
        factory(ConsultationType::class)->create([
            'name'        => 'Ampliación del punto G (estimulación sexual)',
            'description' => 'Agradecemos tu interés en nuestros contenidos, sin embargo; este material cuenta con derechos de propiedad intelectual, queda expresamente prohibido la publicación, retransmisión, distribución, venta, edición y cualquier otro uso de los contenidos (incluyendo, pero no limi- tado a, contenido, texto, fotografías, audios, videos y logotipos) sin previa autorización por escrito de EL UNIVERSAL, Compañía Periodística Nacional S. A. de C. V. Si deseas hacer uso de ellos te invitamos a visitar nuestra tienda en línea: http://tienda.agenciaeluniversal.mx , o bien, puedes comunicarte con nosotros para cualquier duda, comentario o sugerencia al teléfono: 57091313 Ext. 2406 y 2425 de lunes a viernes en horarios de oficina. Si deseas suscribete en nuestra versión impresa o digital, puedes comunicarte al teléfono 5709 1313 Ext. 1564 de lunes a viernes en horarios de oficina.'
        ]);
        factory(ConsultationType::class)->create([
            'name'        => 'CRG de recuperación de curva vaginal (post parto)',
            'description' => 'Este procedimiento ayuda a apretar el canal vaginal.'
        ]);
        factory(ConsultationType::class)->create([
            'name'        => 'Corrección de cicatrices del parto',
            'description' => 'Este tratamiento de cirugía plástica y estética tiene por finalidad reparar y disimular aquellas cicatrices del cuerpo.'
        ]);
        factory(ConsultationType::class)->create([
            'name'        => 'Citología',
            'description' => 'Es una prueba que se lleva a cabo para el estudio de las células pertenecientes al cuello uterino de la mujer. Para ello, se le introduce un cepillo y una espátula con el objetivo de realizar un raspado suave en el cervix.'
        ]);
        // fin

        // Dra Natalia Neira
        factory(ConsultationType::class)->create([
            'name'        => 'Microdermoabrasión',
            'description' => 'es una técnica de rejuvenecimiento de la piel que combina la exfoliación de pequeños cristales con la succión para eliminar las células muertas y otras impurezas de la piel. '
        ]);
        factory(ConsultationType::class)->create([
            'name'        => 'Otoplástia',
            'description' => ' procedimientos quirúrgicos y no quirúrgicos para corregir las deformidades y defectos del pabellón auricular y para reconstruir un oído externo defectuoso, deformado o ausente, como consecuencia de afecciones congénitas y traumas.'
        ]);
        factory(ConsultationType::class)->create([
            'name'        => 'Lipoinyección facial',
            'description' => 'es una cirugía plástica sencilla que deja buenos resultados en el rostro. La intervención consiste en extraer grasa de otra parte del cuerpo, como el abdomen o los muslos, para ubicarla en zonas estratégicas del rostro y rellenar los surcos, arrugas y líneas de expresión.'
        ]);
        factory(ConsultationType::class)->create([
            'name'        => 'Nutrición facial',
            'description' => 'un tratamiento que devuelve luz, elasticidad y tono a la piel de tu rostro.'
        ]);
        factory(ConsultationType::class)->create([
            'name'        => 'Plasma rico en plaquetas',
            'description' => 'es un concentrado de proteína plasmática rica en plaquetas derivada de la sangre total, centrifugada para eliminar los glóbulos rojos.'
        ]);
        factory(ConsultationType::class)->create([
            'name'        => 'Plasma gel',
            'description' => 'es un tipo de relleno temporal y biodegradable en el que se utiliza plasma obtenido del organismo del paciente a tratar.'
        ]);
   
        factory(ConsultationType::class)->create([
            'name'        => 'Rinomodelado',
            'description' => 'consiste en la aplicación de inyecciones localizadas en la zona de la nariz de relleno de acido Hialurónico, que también lo aplican para atenuar las arrugas o modelar los labios.'
        ]);
        factory(ConsultationType::class)->create([
            'name'        => 'Rinoplastia',
            'description' => 'es un procedimiento de cirugía plástica para corregir y reconstruir la nariz. Se utilizan dos tipos de cirugía plástica: la cirugía reconstructiva que restaura la forma y las funciones de la nariz y la cirugía estética que mejora la apariencia de la nariz.'
        ]);
        factory(ConsultationType::class)->create([
            'name'        => 'Blefaroplastía',
            'description' => 'es la operación de cirugía plástica para corregir defectos, deformidades y desfiguraciones de los párpados; y para modificar estéticamente la región ocular de la cara.'
        ]);
        factory(ConsultationType::class)->create([
            'name'        => 'Elevación de la ceja',
            'description' => 'Técnicas de cirugía que permiten una elevación de las cejas, dándole cierta expresión al rostro, tomando en cuenta la posición de las cejas.'
        ]);
        factory(ConsultationType::class)->create([
            'name'        => 'Bichectomía',
            'description' => 'es una técnica mínimamente invasiva, en la cual se extraen las bolsas de bichat, con el objetivo de perfilar el óvalo facial.'
        ]);
        factory(ConsultationType::class)->create([
            'name'        => 'Liposucción submental',
            'description' => ' consiste en extraer la grasa localizada para así marcar mejor el ángulo que forman el cuello y la mandíbula.'
        ]);
        factory(ConsultationType::class)->create([
            'name'        => 'Mentoplastia',
            'description' => 'es un procedimiento quirúrgico que busca mediante diversos medios lograr un aumento en la proyección del mentón.'
        ]);
        factory(ConsultationType::class)->create([
            'name'        => 'Extracción de Biopolímeros',
            'description' => 'es la eliminación de las sustancias de origen sintético que han sido inyectadas en zonas como glúteos, pechos, bíceps, labios o en cualquier parte del cuerpo.'
        ]);
        // fin
    }
}
