<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::Table('news')->insert([
            [
                'id_new'=>1,
                'id_user'=>1,
                'title'=>'Jujutsu Kaisen 0',
                'detail'=>'Jujutsu Kaisen 0: cuándo se estrena y lista de cines en España donde ver la película',
                'description'=>'  Se acabó la espera. Este viernes 27 de mayo por fin llega los cines de Argentina Jujutsu Kaisen 0, la película de anime que ya ha arrasado en medio mundo y que resulta el intermedio perfecto para calmarnos un poco las ganas mientras llega la segunda temporada de la serie.
                El estreno de la película se ha hecho muchísimo de rogar y estos meses hemos ido viendo cómo ha roto récords de recaudación y se ha colado entre las diez películas de anime más taquilleras de la historia. Así que viendo cómo Jujutsu Kaisen 0 ha ido arrasando con cada nuevo estreno, las expectativas están muy, muy altas.',
                'image'=>'1366_2000.jpg',
                'date'=>date('Y-m-d H:i:s'),
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s'),
            ],
            [
                'id_new'=>2,
                'id_user'=>1,
                'title'=>'BERSERK 2022',
                'detail'=>'Panini Manga publicará el vol. 41 de Berserk a finales de 2022',
                'description'=>'Aprovechando el anuncio de la continuación de Berserk este mismo mes de junio, Panini Manga anuncia la publicación en España del tomo nº 41 de este icónico manga para finales de este año 2022. Además, detalla que este esperado volumen se publicará con extras y algunas sorpresas de las que se darán más detalles según se vaya acercando la fecha de su publicación.',
                'image'=>'berserknews.jpg',
                'date'=>date('Y-m-d H:i:s'),
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s'),
            ],
            [
                'id_new'=>3,
                'id_user'=>1,
                'title'=>'Novedades del 6 al 12 de junio de 2022',
                'detail'=>'Próximos lanzamientos de junio 2022',
                'description'=>'Esta semana tenemos una buena lista de lanzamientos y algunas novedades. Destaca Norma Editorial con la publicación del primer tomo de Shangri-La Frontier en dos ediciones, una edición regular al precio de 9,00€ y una edición especial denominada Expansion Pass que incluye una novela extra. También contamos con el lanzamiento de El lugar donde se encuentran los piratas por Sekai de Shun Umezawa, que como ya os hemos anunciado le tendremos en directo en nuestro canal de Twitch mañana sábado 11 de junio a la 13:00. Por último y no menos importante, sale a la venta una nueva edición de 17 años. Mangaline España recupera esta obra de Fujii Seiji y Kamata Youji , en una edición integral que recoge los cuatro volúmenes de la serie en sus  846 páginas y estará limitada a 500 unidades. El precio de este volumen será de 22,50 euros.',
                'image'=>'novedadesprox2022.jpg',
                'date'=>date('Y-m-d H:i:s'),
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s'),
            ],
            [
                'id_new'=>4,
                'id_user'=>1,
                'title'=>"'Ataque a los titanes': por qué son atractivas las ilustraciones terroríficas de Isayama Hajime",
                'detail'=>'El impulso arrollador de Ataque a los titanes, cuya serialización llegó a su fin en 2021, no se detiene. La serie de animación llegará ahora a su clímax. Además, la versión de anime ya emitida ha sido muy aclamada en el extranjero. Este artículo descifra el atractivo de la obra.',
                'description'=>'Una historia que sigue fascinando a personas de todo el mundo
                En 2021 finalizó la serialización del gran éxito de Isayama Hajime, Shingeki no Kyojin (Ed. Kōdansha), conocido como Ataque a los titanes en los países hispanohablantes, pero lejos de decaer, es justo decir que su popularidad no ha hecho más que intensificarse.
                La serie de anime, que está emitiéndose en cuatro temporadas (*1) desde 2013, llega por fin a su punto álgido, con The Final Season, que mostrará (probablemente) el impactante final de la larga historia, cuya emisión está prevista para 2023.
                La versión de anime también está siendo muy aclamada en el extranjero, no solo en Estados Unidos y Corea del Sur, donde siempre ha sido popular, sino también en países como España, donde muchos adultos no suelen ver anime.',
                'image'=>'1830072.jpg',
                'date'=>date('Y-m-d H:i:s'),
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s'),
            ],
            [
                'id_new'=>5,
                'id_user'=>1,
                'title'=>'Mi vecino Totoro será adaptada',
                'detail'=>'La película ‘Mi vecino Totoro’ será adaptada como obra de teatro en Londres',
                'description'=>'Londres, 27 de abril (Jiji Press)—La compañía de teatro británica Royal Shakespeare Company (RSC) anunció el miércoles que adaptará como obra de teatro la película Mi vecino Totoro, del director de animación Miyazaki Hayao.
                La famosa película de animación dirigida por Miyazaki y producida por Studio Ghibli será adaptada al teatro y representada en Londres a partir de octubre.
                Es inusual que una película de animación sea llevada al teatro en la capital del Reino Unido, que es considerada un centro global de las artes escénicas.
                Joe Hisaishi, que compuso la banda sonora de la película de animación, será el productor ejecutivo y el dramaturgo británico Tom Morton-Smith se encargará de adaptar la obra a las tablas. ‘Mi vecino Totoro’ será representada en el Barbican Centre de Londres entre el 8 de octubre de este año y el 21 de enero de 2023.
                “Este es un proyecto revolucionario”, dijo Hisaishi en un comunicado.',
                'image'=>'1772557.jpg',
                'date'=>date('Y-m-d H:i:s'),
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s'),
            ],
            [
                'id_new'=>6,
                'id_user'=>1,
                'title'=>'Fallece Fujiko A. Fujio',
                'detail'=>'Fallece el legendario autor de manga Fujiko A. Fujio a los 88 años',
                'description'=>'Tokio, 7 de abril (Jiji Press)—El jueves se conoció que el reputado artista de manga japonés Fujiko A. Fujio, autor de obras populares como Ninja Hattori-kun o Kaibutsu-kun, falleció en su casa de Kawasaki, en la prefectura de Kanagawa, al sur de Tokio. Tenía 88 años.
                Fujiko A. Fujio, cuyo nombre real era Abiko Motoo, era natural de la prefectura de Toyama, en el centro de Japón.
                Fue uno de los miembros del dúo de autores de manga Fujiko Fujio junto con el fallecido Fujiko F. Fujio.',
                'image'=>'1737527.jpg',
                'date'=>date('Y-m-d H:i:s'),
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s'),
            ],
            [
                'id_new'=>7,
                'id_user'=>1,
                'title'=>'Se estrenará ‘Una herencia en juego’',
                'detail'=>'La secuela de ‘Una herencia en juego’ de Jennifer Lynn Barnes se publicará en septiembre',
                'description'=>'Las editoriales no han parado de anunciar novedades para los próximos meses, y ya tenemos información de una de la que seguro esperabais noticias. Y es que llega el próximo 8 de septiembre la novela El legado Hawthorne, la secuela de Una herencia en juego de Jennifer Lynn Barnes, que se publicará bajo el sello Molino de la editorial Penguin Random House. Jennifer Lynn Barnes es una autora del género New Adult, en su mayoría, que cuenta con más de una docena de libros publicados. Aunque en España no llegó a las librerías hasta el año 2022, cuenta con varias novelas que han cautivado a sus lectores. Entre ellas podemos encontrar la novela Little white lies junto a su secuela Deadly little scandals, ambientada en el mundo de las debutantes, su trilogía Raised by wolves compuesta por Raised by wolves, Trial by fire y Take by storm, o su saga más popular titulada Naturals compuesta por The Naturals, Killer instinct, All in y Bad blood.

                Pero si hablamos de un libro popular de la autora es sin duda Una herencia en juego, la primera parte de la saga. Por el momento cuenta con las novelas Una herencia en juego, El legado Hawthorne y The final gambit, éste último previsto para publicarse el próximo 30 de agosto. El sello Molino de la editorial Penguin Random House ha sido la encargada de traer la primera parte a España y ahora nos anuncia la fecha para la secuela El legado Hawthorne, que llegará a las librerías el próximo 8 de septiembre.',
                'image'=>'Una-herencia-en-juego-673x1024.jpg',
                'date'=>date('Y-m-d H:i:s'),
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s'),
            ],
            [
                'id_new'=>8,
                'id_user'=>1,
                'title'=>'To Your Eternity',
                'detail'=>'Llega a la pantalla "To Your Eternity" este 2021',
                'description'=>'Seguimos la lista de los nuevos anime en 2021 con esta obra basada en el manga de Yoshitoki Ōima. Su historia se centra en las aventuras de Fushi, un ser inmortal capaz de tomar distintas formas. A lo largo de múltiples viajes en el tiempo, Fushi aprende poco a poco lo que significa ser humano, desarrollando una conciencia y personalidad propia. Sin embargo, también es testigo de muchas tragedias y al ser inmortal, muchos terminan muriendo y dejándolo solo. No obstante, esto no lo detendrá de intentar salvar a sus seres queridos a como dé lugar.

                Al igual que el manga en el cual está basado, este anime fue muy bien recibido gracias a su trama, desarrollo de personajes y dirección artística. Si bien actualmente solo hay una temporada con 20 episodios, ya se ha confirmado la llegada de una segunda entrega para octubre del 2022.',
                'image'=>'to_your_eternity.jpg',
                'date'=>date('Y-m-d H:i:s'),
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s'),
            ],
            [
                'id_new'=>9,
                'id_user'=>1,
                'title'=>'Re-edición Slam Dunk',
                'detail'=>'Llega a la pantalla una nueva re edición del famoso anime de baloncesto Slam Dunk.',
                'description'=>'Basado en el manga de Takehiko Inoue, este anime de deporte sigue las aventuras del equipo de basketball en la Preparatoria Shōhoku de Japón. Ahí es donde conoceremos a Hanamichi Sakuragi, un delincuente juvenil que decide unirse al equipo con tal de impresionar a la chica de sus sueños. Y aunque en un inicio le cuesta cooperar con los demás integrantes, poco a poco se dará cuenta no solo de que tiene talento para el deporte, sino que también disfruta jugar al baloncesto. Poco a poco se irán incorporando otros jugadores, que aunque complican las cosas para Sakuragi, ayudan a llevar al equipo a las grandes ligas.

                La serie de Slam Dunk se compone de 101 episodios aunque también cuenta con 4 cintas animadas. Por si fuera poco, a inicios de este 2021 se confirmó que Toei Animation llevaría a cabo la producción de una nueva película animada de la serie. Siendo que ya han pasado más de 25 años desde el debut de su última cinta, esta nueva entrega en la saga de Slam Dunk se posiciona como una de las películas de anime más esperadas en 2022.',
                'image'=>'slam-dunk-1.jpg',
                'date'=>date('Y-m-d H:i:s'),
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s'),
            ],
            [
                'id_new'=>10,
                'id_user'=>1,
                'title'=>'ChainSaw Man 2022 Animación',
                'detail'=>'Llega a la pantalla un nuevo anime muy impresionante "ChainSaw Man".',
                'description'=>'Basado en el manga de Tatsuki Fujimoto, este anime se sitúa en un mundo donde los demonios pueden tomar forma y aparecer en el mundo a través del miedo de los seres humanos. Mientras más gente les teme, más poderosos se vuelven. Sin embargo, también existen cazadores de demonios que se especializan en combatirlos. De esta manera conoceremos a Denji, un joven en extrema pobreza que se gana la vida como cazador de demonios. Tras un conflicto en el que es asesinado, Denji logra regresar a la vida además de ganar poderes sobrenaturales, convirtiéndose en un híbrido de humano y demonio.

                De esta manera Denji comienza a subir de rango como cazador de demonios, enfrentándose cada vez a amenazas más grandes. No obstante, hay un oscuro secreto que podría destruir el orden establecido y cada encuentro con demonios termina en muerte y destrucción. Por todo esto, Chainsaw Man ha sido uno de los manga mejor recibidos recientemente, elogiado por su trama, personajes y oscuro sentido del humor. Es por ello que sin duda se posiciona como uno de los anime más esperados en 2022.',
                'image'=>'2021123185428_1.jpg',
                'date'=>date('Y-m-d H:i:s'),
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s'),
            ],
            [
                'id_new'=>11,
                'id_user'=>1,
                'title'=>'Cyberpunk: Edgerunners',
                'detail'=>'Nueva animación basada en un video juego, CyberPunk tiene a todos sus fans con altas espectativas.',
                'description'=>'Cyberpunk 2077 fue uno de los juegos más esperados en 2020 así como uno de los más polémicos. Producido por CD Projekt Red, quienes fueron responsables del exitoso juego de The Witcher 3, este título de acción y rol en primera persona se sitúa en la urbe de Night City: habitada por toda clase de personajes, pandillas y criminales a lo largo de sus 6 regiones. No obstante el juego sufrió diversos retrasos a lo largo de su producción y cuando finalmente estuvo disponible, también presentó problemas técnicos en las consolas de última generación. Sin embargo, también tuvo sus puntos a favor, siendo elogiado por su narrativa, ambientación y atractivo visual.

                Además de expandir la historia del juego por medio de actualizaciones gratuitas, CD Projekt Red también anunció que Cyberpunk 2077 tendrá su propia adaptación animada con 10 episodios en exclusiva para Netflix. Cyberpunk: Edgerunners será producida por Studio Trigger, reconocido estudio de animación tras otros anime como Kill la Kill, Gurren Lagan y Darling in the Franxx. Su estreno se tiene planeado durante el transcurso del 2022, ya que se desconoce su fecha exacta de lanzamiento.',
                'image'=>'cyberpunk-1.jpg',
                'date'=>date('Y-m-d H:i:s'),
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s'),
            ],
        ]);
    }
}
