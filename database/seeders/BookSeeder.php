<?php

namespace Database\Seeders;

use App\Http\Controllers\CategoryController;
use App\Models\Book;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        // create 40 books
        $categories = app(CategoryController::class)->getCategories();

        for($i = 0; $i < 60; $i++) {

            $fakeCategories = [];

            for ($r = 0; $r < random_int(0, 15); $r++) {
                $fakeSubject = fake()->randomElement($categories);
                $fakeCategories[] = fake()->randomElement($fakeSubject);
            }

            $this->command->info("Creating book " . join(",", $fakeCategories));



            Book::create([
                "isbn" => fake()->isbn13(),
                "title" => ucwords(fake()->words(3, true)),
                "author" => fake()->name,
                "cover_url" => "/test_images/" . fake()->numberBetween(1, 7) . ".jpg",
                "description" => fake()->paragraph,
                "price" => fake()->randomFloat(2, 10, 100),
                "subjects" => $fakeCategories,
                "publication_date" => '2009-01-01'
            ]);
        }


//        Book::factory()->create([
//            "isbn" => "978-0-439-02352-8",
//            "title" => "The Hunger Games",
//            "author" => "Suzanne Collins",
//            "cover_url" => "https://covers.openlibrary.org/b/id/14618966-L.jpg",
//            "description" => "The Hunger Games is a 2008 dystopian novel by the American writer Suzanne Collins.",
//            "price" => "14.95",
//            "subjects" =>["severe poverty","starvation","oppression","effects of war","self-sacrifice","Science fiction","Apocalyptic fiction","Dystopian fiction","Fiction","Juvenile works","Novels","Young adult works","Juvenile fiction","contensts","Young adult fiction","Game shows","Television programs","New York Times bestseller","Contests","nyt:series_books=2010-08-21","Long Now Manual for Civilization","Reality television programs","Television game shows","Survival","Interpersonal relations","Roman",]);
////
//        function guessDateFormat($dateString) {
//            $commonFormats = [
//                'Y-m-d', // ISO 8601 (e.g., 2023-12-25)
//                'm/d/Y', // US format (e.g., 12/25/2023)
//                'd/m/Y', // European format (e.g., 25/12/2023)
//                'd-m-Y', // European format with dashes
//                'Y-m',
//                'Ymd', // Compact format (e.g., 20231225)
//                'M j, Y', // Month name, day, year (e.g., December 25, 2023)
//                'F j, Y', // Full month name, day, year (e.g., December 25, 2023)
//            ];
//
//            foreach ($commonFormats as $format) {
//                try {
//                    $date = Carbon::createFromFormat($format, $dateString);
//                    if (!is_null($date)) {
//                        return $date->format('Y-m-d');
//                    }
//                } catch (Exception $e) {
//                }
//            }
//
//// If no format matches, return null or handle the case accordingly
//            return Carbon::now()->format("Y-m-d");
//        }
//
//        Book::create([
//            "isbn" => "978-0-439-02352-8",
//            "title" => "The Hunger Games",
//            "author" => "Suzanne Collins",
//            "cover_url" => "https://covers.openlibrary.org/b/id/14618966-L.jpg",
//            "description" => "The Hunger Games is a 2008 dystopian novel by the American writer Suzanne Collins. It is written in the perspective of 16-year-old Katniss Everdeen, who lives in the future, post-apocalyptic nation of Panem in North America. The Capitol, a highly advanced metropolis, exercises political control over the rest of the nation. The Hunger Games is an annual event in which one boy and one girl aged 12–18 from each of the twelve districts surrounding the Capitol are selected by lottery to compete in a televised battle royale to the death.
//
//The book received critical acclaim from major reviewers and authors. It was praised for its plot and character development. In writing The Hunger Games, Collins drew upon Greek mythology, Roman gladiatorial games, and contemporary reality television for thematic content. The novel won many awards, including the California Young Reader Medal, and was named one of Publishers Weekly\'s \"Best Books of the Year\" in 2008.
//
//The Hunger Games was first published in hardcover on September 14, 2008, by Scholastic, featuring a cover designed by Tim O\'Brien.",
//            "price" => "14.95",
//            "subjects" =>["severe poverty","starvation","oppression","effects of war","self-sacrifice","Science fiction","Apocalyptic fiction","Dystopian fiction","Fiction","Juvenile works","Novels","Young adult works","Juvenile fiction","contensts","Young adult fiction","Game shows","Television programs","New York Times bestseller","Contests","nyt:series_books=2010-08-21","Long Now Manual for Civilization","Reality television programs","Television game shows","Survival","Interpersonal relations","Roman","Amerikanisches Englisch","Sisters","Young women","Dystopias","Survival skills","Blind","Books and reading","Reading Level-Grade 9","Reading Level-Grade 8","Reading Level-Grade 11","Reading Level-Grade 10","Reading Level-Grade 12","Survival Stories","Action & Adventure","Children's fiction","Survival, fiction","Interpersonal relations, fiction","Contests, fiction","Television, fiction","Large type books","Future","violent","life risking","bravery.","Roman pour jeunes adultes","Habiletés de survie","Roman d'aventures","Concours et compétitions","Relations humaines","Romans, nouvelles","Émissions televiseés","Spanish language materials","Supervivencia","Novela juvenil","Relaciones humanas","Programas de televisión","Concursos","Fantastische Erzahlung","Fantastische Literatur","Action and adventure fiction","Contests Fiction","Fictional Work","Interpersonal relations Fiction","Jeux télévisés Romans, nouvelles, etc. pour la jeunesse","Reality television programs Fiction","Reality television programs Juvenile fiction","Romans","Survival Fiction","Survival skills Fiction","Television game shows Juvenile fiction","Television programs Fiction","Émissions télévisées","Novela","Televisión","Programas","Competencias","American fiction","Translations into Chinese","Chinese language materials","Romans, nouvelles, etc. pour la jeunesse","Literature and fiction, juvenile","Short stories","Fantasy fiction","American literature, study and teaching"],
//            "publication_date" => guessDateFormat('2009-09')]);
//        Book::create([
//            "isbn" => "978-0-09-186515-3",
//            "title" => "The Science of Discworld",
//            "author" => "Terry Pratchett,Ian Stewart,Jack Cohen,Ian Stewart,Jack Cohen",
//            "cover_url" => "https://covers.openlibrary.org/b/id/14646576-L.jpg",
//            "description" => "Contains a story by Terry Pratchett, around which Stewart and Cohen write about the Discworld.",
//            "price" => "14.95",
//            "subjects" =>["Fantasy fiction","Cosmology","Discworld (Imaginary place)","Fiction","Scientists","Wizards","Elves","FICTION / Alternative History","FICTION / Fantasy / Contemporary","FICTION / Science Fiction / Adventure","Evolution (Biology)","Fiction, science fiction, action & adventure","Discworld (imaginary place), fiction","Scientists, fiction","Fantasy fiction, history and criticism","General","Science / General","Fiction - General"],
//            "publication_date" => guessDateFormat('1999')]);
//        Book::create([
//            "isbn" => "978-0-316-16017-9",
//            "title" => "Twlight",
//            "author" => "Stephenie Meyer",
//            "cover_url" => "https://covers.openlibrary.org/b/id/10194691-L.jpg",
//            "description" => "Bella Swan and Edward Cullen, a pair of star-crossed lovers whose forbidden relationship ripens against the backdrop of small-town suspicion and a mysterious coven of vampires.",
//            "price" => "14.95",
//            "subjects" =>["New York Times bestseller","nyt:series_books=2008-03-15","School & Education","Vampires","Juvenile Fiction","Fiction","Children's Books - Young Adult Fiction","Science Fiction, Fantasy, & Magic","Children: Young Adult (Gr. 10-12)","Schools","Love & Romance","Horror & Ghost Stories","Juvenile Fiction / Horror & Ghost Stories","High schools","Children's 12-Up - Fiction - Horror","High school students","First loves","Vampires, fiction","Schools, fiction","Washington (state), fiction","Children's fiction","Love, fiction","cheese","Graphic novels","Adaptations","Large type books","Vampiros","Ficción juvenil","Escuelas secundarias","Escuelas","nyt:hardcover-graphic-books=2010-04-04","Edward Cullen (Fictitious character)","Comic books, strips","Bella Swan (Fictitious character)","Twilight (Meyer, Stephenie)","Motion pictures, juvenile literature","Motion pictures","Chinese language","Chang pian xiao shuo","Simplified characters","Russian language materials","Interpersonal attraction","Upside-down books","Teenagers","Comics & graphic novels, romance","Comics & graphic novels, fantasy","Translations into Chinese","Werewolves","American fiction","Yan qing xiao shuo","Interpersonal relations, fiction","Youth, fiction","High school","Junge Frau","Vampir","Verlieben","School stories","Reading materials","Children's books","Spanish language","Novela juvenil","Spanish language materials","Translations from English","Portuguese fiction","Novela estadounidense","Novela","Interpersonal relations","Polish language materials","Romans, nouvelles, etc. pour la jeunesse","Écoles","Love","Young adult fiction","Persistence","Friendship","Romans, nouvelles","Élèves du secondaire","Écoles secondaires","Premier amour","Amour","Roman pour jeunes adultes","Persévérance","Amitié","Paranormal, Occult & Supernatural. . .","Romance","Paranormal","Social Themes","Dating & Sex","Außenseiterin","Gefahr","Tochter","Weibliche Jugend","Wohnungswechsel","Supernatural fiction","Mishnah","American Young adult fiction","Roman pour jeunes adultes américain","Comics & graphic novels, fantasy, general"],
//            "publication_date" => guessDateFormat('October 5, 2005')]);
//        Book::create([
//            "isbn" => "0-86140-203-0",
//            "title" => "The light fantastic",
//            "author" => "Terry Pratchett,Ernest Riera",
//            "cover_url" => "https://covers.openlibrary.org/b/id/652366-L.jpg",
//            "description" => "{\'type\': \'/type/text\', \'value\': \'From the back cover:\r\n\r\nIn *The Light Fantastic* only one individual can save the world from a disastrous collision.  Unfortunately, the hero happens to be the singularly inept wizard Rincewind, who was last seen falling off the edge of the world....\'}",
//            "price" => "14.95",
//            "subjects" =>["Fiction","Discworld (Imaginary place)","Samuel Vimes (Fictitious character)","Fantasy","Discworld (imaginary place), fiction","Fiction, fantasy, general","Fiction, humorous","Rincewind the wizard (fictitious character), fiction","Fiction, humorous, general","Literature and fiction, fantasy","Fiction, satire","English literature"],
//            "publication_date" => guessDateFormat('1986')]);
//        Book::create([
//            "isbn" => "0-7868-5629-7",
//            "title" => "The Lightning Thief",
//            "author" => "Rick Riordan",
//            "cover_url" => "https://covers.openlibrary.org/b/id/14601474-L.jpg",
//            "description" => "{\'type\': \'/type/text\', \'value\': \'Twelve-year-old Percy Jackson is on the most dangerous quest of his life.  With the help of a satyr and a daughter of Athena, Percy must journey across the United States to catch a thief who has stolen the original weapon of mass destruction—Zeus’ master bolt.  Along the way, he must face a host of mythological enemies determined to stop him.  Most of all, he must come to terms with a father he has never known, and an Oracle that has warned him of betrayal by a friend.\'}",
//            "price" => "14.95",
//            "subjects" =>["Fiction","Greek Mythology","Zeus (Greek deity)","Juvenile fiction","Fathers and sons","Hades (Greek deity)","Poseidon (Greek deity)","Camps","Friendship","Fantasy fiction","Fantasy","Young Adult Fiction","New York Times bestseller","nyt:series_books=2007-07-21","Mythology, Greek","Juvenile fiction..","Identity (Philosophical concept)","Identity","Adaptations","Greek Gods","Comic books, strips","Cartoons and comics","Children's fiction","Camps, fiction","Friendship, fiction","Fathers and sons, fiction","Gods, fiction","Large type books","mirror","pdf.yt","Graphic novels","Action & Adventure","Fantasy & Magic","Legends, Myths, Fables","Voyages and travels","Father-son relationship","Gods and goddesses","Literature and fiction, juvenile","Children's Books -- Literature -- Action & Adventure","Children's Books -- Literature -- Fairy Tales, Folk Tales & Myths -- Greek & Roman","Children's Books -- Literature -- Popular Culture","Children's Books -- Literature -- Science Fiction, Fantasy, Mystery & Horror -- Science Fiction, Fantasy, & Magic","Literature & Fiction -- World Literature -- Mythology","Child and youth fiction","Science fiction, fantasy, horror","New York Times reviewed","Mythologie grecque","Romans, nouvelles, etc. pour la jeunesse","Colonies de vacances","Amitié","Pères et fils","Dioses griegos","Spanish language materials","Amistad","Ficción juvenil","Padres e hijos","Campamentos","Mitología griega","Spanish language","Children's books","Libros ilustrados para niños","Dieux grecs","Novela juvenil","Materiales en espñaol","Quakers"],
//            "publication_date" => guessDateFormat('2005-06')]);
//        Book::create([
//            "isbn" => "0-7868-5686-6",
//            "title" => "The Sea of Monsters",
//            "author" => "Rick Riordan",
//            "cover_url" => "https://covers.openlibrary.org/b/id/13011225-L.jpg",
//            "description" => "It is the second book in the Percy Jackson series where Percy is sent on a quest (well, I wouldn\'t say SENT) to retrieve the golden fleece that will hep cure Thalia\'s tree to protect camp-half blood. Old enemies appear and new ones emerge. How will Percy and his band of loyal friends survive?",
//            "price" => "14.95",
//            "subjects" =>["Fiction","Fantasy","Identity","Greek Mythology","Juvenile fiction","Identity (Philosophical concept)","Zeus (Greek deity)","Father-son relationship","Hades (Greek deity)","Camps","Friendship","Poseidon (Greek deity)","Children's stories","Camps, fiction","Friendship, fiction","Fathers and sons, fiction","Children's fiction","Adventure and adventurers","Greek Gods","Middle school students","Fathers and sons","Monsters","Gods and goddesses","JUVENILE FICTION / Legends, Myths, Fables","JUVENILE FICTION / Social Themes","Fantasy fiction","Voyages and travels","nyt:series_books=2007-07-21","New York Times bestseller","Large type books","Gods, fiction","Suspense","Comic books, strips, etc.","Adaptations","Graphic novels","Comic books, strips, etc.n.","Comic books, strips","Translations into Vietnamese","American fiction","Pictorial works","Cartoons and comics","Action & Adventure","Legends, Myths, Fables","Greek & Roman","Monsters, fiction","Animals, mythical, fiction","Adventure and adventurers, fiction","Greece, fiction","Viajes","Amistad","Ficción juvenil","Monstruos","Quakers","Mythologie grecque","Romans, nouvelles, etc. pour la jeunesse","Colonies de vacances","Amitié","Pères et fils","Poséidon (Divinité grecque)","Hadès (Divinité grecque)","Zeus (Divinité grecque)","Mitología griega","Novela juvenil","Dioses griegos","Padres e hijos"],
//            "publication_date" => guessDateFormat('April 1, 2006')]);
//        Book::create([
//            "isbn" => "9780545586177",
//            "title" => "Catching Fire",
//            "author" => "Suzanne Collins",
//            "cover_url" => "https://covers.openlibrary.org/b/id/12646519-L.jpg",
//            "description" => "{\'type\': \'/type/text\', \'value\': \"Against all odds, Katniss Everdeen has won the Hunger Games. She and fellow District 12 tribute Peeta Mellark are miraculously still alive. Katniss should be relieved, happy even. After all, she has returned to her family and her longtime friend, Gale. Yet nothing is the way Katniss wishes it to be. Gale holds her at an icy distance. Peeta has turned his back on her completely. And there are whispers of a rebellion against the Capitol—a rebellion that Katniss and Peeta may have helped create. \r\n\r\nMuch to her shock, Katniss has fueled an unrest that she\'s afraid she cannot stop. And what scares her even more is that she\'s not entirely convinced she should try. As time draws near for Katniss and Peeta to visit the districts on the Capitol\'s cruel Victory Tour, the stakes are higher than ever. If they can\'t prove, without a shadow of a doubt, that they are lost in their love for each other, the consequences will be horrifying.\r\n\r\nIn Catching Fire, the second novel of the Hunger Games trilogy, Suzanne Collins continues the story of Katniss Everdeen, testing her more than ever before . . . and surprising readers at every turn.\"}",
//            "price" => "14.95",
//            "subjects" =>["Action/Adventure","Fantasy","teen fiction","juvenile works","interdependence","independence","Games","Apocalyptic literature","Competition","teenage girls","sisters","poverty","Contests","Insurgency","Open Library Staff Picks","Survival","Fiction","Interpersonal relations","Television programs","Dystopias","Adventures and Adventurers","Television","Courage","Bravery","Heroism","Defiance and Talking Back","Adventure and adventurers","Girls","Blind","Books and reading","Young adult fiction","Television game shows","Dystopian","Science fiction","Survival Stories","Self-Esteem & Self-Reliance","Action & Adventure","JUVENILE FICTION","Social Themes","Survival skills","Reading Level-Grade 9","Reading Level-Grade 8","Reading Level-Grade 11","Reading Level-Grade 10","Reading Level-Grade 12","Children's fiction","Interpersonal relations, fiction","Contests, fiction","Television, fiction","Survival, fiction","Reality television programs","Large type books","Katniss Everdeen (Fictitious character)","Spanish language materials","Supervivencia","Novela juvenil","Relaciones humanas","Insurgencia","Programas de televisión","Concursos","Distopías","Spanish language","nyt:chapter-books=2009-09-20","New York Times bestseller","Novela","Televisión","Programas","Reading materials","Phantastische Erzahlung","Phantastische Literatur","Wilderness survival","Révoltes","Romans, nouvelles, etc. pour la jeunesse","Habiletés de survie","Jeux télévisés","Concours et compétitions","Dystopies","Filles","Fiction, science fiction, general"],
//            "publication_date" => guessDateFormat('2013-06')]);
//        Book::create([
//            "isbn" => "9780545663267",
//            "title" => "Mockingjay",
//            "author" => "Suzanne Collins",
//            "cover_url" => "https://covers.openlibrary.org/b/id/8066194-L.jpg",
//            "description" => "Against all odds, Katniss Everdeen has survived the Hunger Games twice. But now that she\'s made it out of the bloody arena alive, she\'s still not safe. The Capitol is angry. The Capitol wants revenge. Who do they think should pay for the unrest? Katniss. And what\'s worse, President Snow has made it clear that no one else is safe either. Not Katniss\'s family, not her friends, not the people of District 12. Powerful and haunting, this is the thrilling final installment of Suzanne Collins\'s groundbreaking Hunger Games trilogy. - Publisher.",
//            "price" => "14.95",
//            "subjects" =>["Insurgency","Survival","Fiction","Science fiction","Interpersonal relations","Television programs","Large type books","Contests","Survival skills","Young adult fiction","Juvenile fiction","Revenge","Children's stories","Survival Stories","Dystopian","Self-Esteem & Self-Reliance","Action & Adventure","Social Themes","Television game shows","Dystopias","Girls","Courage","Children's fiction","Television, fiction","Contests, fiction","Survival, fiction","Interpersonal relations, fiction","Reading Level-Grade 7","Reading Level-Grade 9","Reading Level-Grade 8","Reading Level-Grade 11","Reading Level-Grade 10","Reading Level-Grade 12","Katniss Everdeen (Fictitious character)","Reality television programs","nyt:series-books=2010-09-12","New York Times bestseller","New York Times reviewed","Telerealites","Romans","Dystopies","Science-fiction","Dictature","Television-verite","Concours et competitions","Habiletes de survie","Spanish language materials","Révoltes","Romans, nouvelles, etc. pour la jeunesse","Habiletés de survie","Supervivencia","Novela juvenil","Televisión","Programas","Relaciones humanas","Novela joven","Spanish language","Reading materials","Téléréalité","Insurgency -- Juvenile fiction","Survival -- Juvenile fiction","Television programs -- Juvenile fiction","Interpersonal relations -- Juvenile fiction","Contests -- Juvenile fiction","Insurgency -- Fiction","Survival skills -- Fiction","Television programs -- Fiction","Interpersonal relations -- Fiction","Contests -- Fiction"],
//            "publication_date" => guessDateFormat('2014')]);
//        Book::create([
//            "isbn" => "9781338878929",
//            "title" => "Harry Potter and the Sorcerer's Stone",
//            "author" => "J. K. Rowling",
//            "cover_url" => "",
//            "description" => "{\'type\': \'/type/text\', \'value\': \'Harry Potter #1\r\n\r\nWhen mysterious letters start arriving on his doorstep, Harry Potter has never heard of Hogwarts School of Witchcraft and Wizardry.\r\n\r\nThey are swiftly confiscated by his aunt and uncle.\r\n\r\nThen, on Harry’s eleventh birthday, a strange man bursts in with some important news: Harry Potter is a wizard and has been awarded a place to study at Hogwarts.\r\n\r\nAnd so the first of the Harry Potter adventures is set to begin.\r\n([source][1])\r\n\r\n\r\n  [1]: https://www.jkrowling.com/book/harry-potter-philosophers-stone/\'}",
//            "price" => "14.95",
//            "subjects" =>["Ghosts","Monsters","Vampires","Witches","Challenges and Overcoming Obstacles","Magic and Supernatural","Cleverness","School Life","school stories","Wizards","Magic","MAGIA","MAGOS","Juvenile fiction","Fiction","NOVELAS INGLESAS","Schools","orphans","fantasy fiction","England in fiction","Witches in fiction","Wizards in fiction","Alchemy","New York Times bestseller","Juvenile literature","Magic in fiction","Open Library Staff Picks","Juvenile audience","Children's stories","Juvenile works","Schools in fiction","Fantasy","Hogwarts School of Witchcraft and Wizardry (Imaginary place)","Harry Potter (Fictitious character)","Ficción juvenil","Escuelas","Hogwarts School of Witchcraft and Wizardry (Imaginary organization)","Translations from English","Chinese fiction","Hermione Granger (Fictitious character)","Reading Level-Grade 9","Reading Level-Grade 11","Reading Level-Grade 10","Reading Level-Grade 12","Hogwarts school of witchcraft and wizardry (imaginary organization), fiction","Children's fiction","Schools, fiction","England, fiction","Potter, harry (fictitious character), fiction","Wizards, fiction","Magic, fiction","Fiction, fantasy, general","Large type books","Magier","Fabeltiere","Lehrling","Kinderbuch","Stein der Weisen","Ungeheuer","Junge","English language","Translating into Welsh","Modern history to 20th century: c 1700 to c 1900","Literary theory","English literature","Ron Weasley (Fictitious character)","Latin language materials","Romans, nouvelles, etc. pour la jeunesse","Poudlard, école de sorcellerie (Organisation imaginaire)","Sorciers","Sorcières","Magie","Internats","Adventure and adventurers, fiction","Action & Adventure","Fantasy & Magic","Social Themes","Friendship","Harry Potter (Fictional character)","Friendship, fiction","German language materials","Witchcraft, fiction","Wizard","NOVELAS FANTÁSTICAS","NOVELAS JUVENILES INGLESAS","LITERATURA JUVENIL ESTADOUNIDENSE","Écoles","Hechicería","Novela juvenil","Ingleterra","Mystery","roman","English Fantasy literature","Translations into Marathi","English fiction","Translations into Chinese","Children - harry potter","Teen fiction","Children - fiction & literature","Science fiction & fantasy","Fiction - people","Places & cultures","Adventure","Supernatural"],
//            "publication_date" => guessDateFormat('2023')]);
//        Book::create([
//            "isbn" => "9781338815283",
//            "title" => "Harry Potter and the Prisoner of Azkaban (MinaLima Edition)",
//            "author" => "J. K. Rowling",
//            "cover_url" => "https://covers.openlibrary.org/b/id/14126209-L.jpg",
//            "description" => "{\'type\': \'/type/text\', \'value\': \'For Harry Potter, it’s the start of another far-from-ordinary year at Hogwarts when the Knight Bus crashes through the darkness and comes to an abrupt halt in front of him.\r\n\r\nIt turns out that Sirius Black, mass-murderer and follower of Lord Voldemort, has escaped – and they say he is coming after Harry.\r\n\r\nIn his first Divination class, Professor Trelawney sees an omen of death in Harry’s tea leaves.\r\n\r\nAnd perhaps most frightening of all are the Dementors patrolling the school grounds with their soul-sucking kiss – in search of fresh victims.\r\n\r\n([source][1])\r\n\r\n\r\n  [1]: https://www.jkrowling.com/book/harry-potter-prisoner-azkaban/\'}",
//            "price" => "14.95",
//            "subjects" =>["Fantasy fiction","orphans","foster homes","fantasy","literature","juvenile fantasy fiction","Locus Award winner","Bram Stoker Award winner","Whitbread Book Award winner","Adventure","Juvenile literature","Juvenile works","Juvenile audience","Children's books","Magic","Open Library Staff Picks","Juvenile fiction","Wizards","New York Times bestseller","Schools","nyt:series_books=2006-09-16","Science Fiction, Fantasy, & Magic","Hogwarts School of Witchcraft and Wizardry (Imaginary place)","Witches","Harry Potter (Fictitious character)","Ficción juvenil","Magos","Magia","Hogwarts School of Witchcraft and Wizardry (Imaginary organization)","Children's Books/Ages 9-12 Fiction","Spanish: Grades 4-7","General","Potter, Harry (Fictitious character)","Potter, Harry (Caracter ficticio)","Hogwarts School of Witchcraft and Wizardry (Lugar imaginario)","Escuelas","Spanish language","Literatura juvenil","Harry Potter (Fictional character)","Orphans & Foster Homes","Fantasy & Magic","French language materials","School stories","Family","Fiction","Social Themes","Friendship","Reading Level-Grade 9","Reading Level-Grade 11","Reading Level-Grade 10","Reading Level-Grade 12","Translations from English","Chinese language materials","England","Chinese fiction","Tong hua","England, fiction","Potter, harry (fictitious character), fiction","Schools, fiction","Children's fiction","Wizards, fiction","Hogwarts school of witchcraft and wizardry (imaginary organization), fiction","Magic, fiction","Fiction, fantasy, general","Magie","Magiciens","Schulferien","Deutschland","Verrat","Freundschaft","Romans, nouvelles, etc. pour la jeunesse","Junge","Good and evil","Jugendgruppe","Fabeltiere","Lüge","Rache","Boarding schools","Deutschland Grenzschutzkommando Mitte Schule","Potter, Harry (Personnage fictif)","English literature","Hermione Granger (Fictitious character)","Ron Weasley (Fictitious character)","Large type books","Juvenile films","Películas cinematográficas juveniles","Hechiceros","Potter, Harry (Personaje literario)","Children stories","Novela juvenil","Reading materials","Adventure and adventurers, fiction","Friendship, fiction","Witches, fiction","English Fantasy literature","Translations into Marathi"],
//            "publication_date" => guessDateFormat('2023')]);
//        Book::create([
//            "isbn" => "9781338878967",
//            "title" => "Harry Potter and the Order of the Phoenix (Harry Potter, Book 5)",
//            "author" => "J. K. Rowling",
//            "cover_url" => "https://covers.openlibrary.org/b/id/13569581-L.jpg",
//            "description" => "{\'type\': \'/type/text\', \'value\': \'After the Dementors’ attack on his cousin Dudley, Harry knows he is about to become Voldemort’s next target.\r\n\r\nAlthough many are denying the Dark Lord’s return, Harry is not alone, and a secret order is gathering at Grimmauld Place to fight against the Dark forces.\r\n\r\nMeanwhile, Voldemort’s savage assaults on Harry’s mind are growing stronger every day.\r\n\r\nHe must allow Professor Snape to teach him to protect himself before he runs out of time.\r\n([source][1])\r\n\r\n\r\n----------\r\nThis work has also been published in multiple volumes. See:\r\n\r\n - [Harry Potter and the Order of the Phoenix: III](https://openlibrary.org/works/OL17937113W/Harry_Potter_and_the_Order_of_the_Phoenix_Chapters_17-23)\r\n - [Harry Potter and the Order of the Phoenix: IV](https://openlibrary.org/works/OL17915213W/Harry_Potter_and_the_Order_of_the_Phoenix_Chapters_24-30)\r\n\r\n  [1]: https://www.jkrowling.com/book/harry-potter-order-phoenix/\'}",
//            "price" => "14.95",
//            "subjects" =>["Children's Books/Ages 9-12 Fiction","Witches and warlocks","Juvenile audience","Juvenile works","Magic","Fantasy fiction","Juvenile fiction","Fiction","Fantasy","Friendship","Children's stories","Juvenile literature","Magia","Novela juvenil","Traducciones al español","Escuelas","Novela inglesa","Romans, nouvelles, etc. pour la jeunesse","Magiciens","Magic in fiction","England in fiction","Schools in fiction","Écoles","Schools","Sorcières","Wizards in fiction","Translations from English","Coming of age","New York Times bestseller","Open Library Staff Picks","nyt:series_books=2006-09-16","School stories","Family","Orphans & Foster Homes","Social Themes","Fantasy & Magic","Boarding schools","Magie","{acute}Ecoles","Sorciaeres","Roman pour la jeunesse","Romans","Witches","Sorciers","Potter, Harry (Personnage fictif)","Hogwarts School of Witchcraft and Wizardry (Imaginary place)","Harry Potter (Fictitious character)","Potter, Harry (Fictitious character)","English Fantasy fiction","Hogwarts School of Witchcraft and Wizardry (Imaginary organization)","Arabic language materials","Magos","Ficción juvenil","Novela fantástica","England","Wizards","Witchcraft","Severus Snape (Fictitious character)","Reading Level-Grade 11","Reading Level-Grade 12","Lebensrettung","Conduct of life","Internat","Junge","Weissagung","Existenzkampf","Fabeltiere","Boarding school students","Military aspects","Parapsychology","Das Böse","Magier","Lebensgefahr","Schüler","Freundschaft","Rollentausch","Jugendgruppe","Youth","Telepathie","Das Gute","Dueling","Teacher-student relationships","Außenseiter","Imaginärer Schauplatz","Hate","Large type books","Potter, harry (fictitious character), fiction","Hogwarts school of witchcraft and wizardry (imaginary organization), fiction","Wizards, fiction","Children's fiction","Magic, fiction","Schools, fiction","England, fiction","English literature","Hermione Granger (Fictitious character)","Ron Weasley (Fictitious character)","Schools - Fiction","Coming of age - Fiction","Magic - Fiction","Fiction, fantasy, general","Adventure and adventurers, fiction","Friendship, fiction","Poudlard (Organisation imaginaire)","Spanish language","Reading materials","Romans, nouvelles","Hogwarts Schools of Witchcraft and Wizardry (Imaginary Place)","Eventyrlige fortællinger","Troldmænd","Magi"],
//            "publication_date" => guessDateFormat('2023')]);
//        Book::create([
//            "isbn" => "9780316629454",
//            "title" => "Midnight Sun",
//            "author" => "Stephenie Meyer",
//            "cover_url" => "",
//            "description" => "",
//            "price" => "14.95",
//            "subjects" =>["New York Times reviewed"],
//            "publication_date" => guessDateFormat('2022')]);
//        Book::create([
//            "isbn" => "9780316300865",
//            "title" => "Life and Death",
//            "author" => "Stephenie Meyer",
//            "cover_url" => "",
//            "description" => "",
//            "price" => "14.95",
//            "subjects" =>["Children's fiction","Supernatural, fiction","Love, fiction","Vampires","Juvenile fiction","Teenagers","Interpersonal attraction","High schools","Fiction","Schools","YOUNG ADULT FICTION / Vampires","YOUNG ADULT FICTION / Romance / General","Interpersonal relations","School stories","Fantasy fiction","Vampires, fiction"],
//            "publication_date" => guessDateFormat('2022')]);
//        Book::create([
//            "isbn" => "9780062237378",
//            "title" => "Small Gods",
//            "author" => "Terry Pratchett",
//            "cover_url" => "https://covers.openlibrary.org/b/id/9023424-L.jpg",
//            "description" => "In the beginning was the Word.
//
//And the Word was: \"Hey, you!\"
//
//For Brutha the novice is the Chosen One. He wants peace and justice and brotherly love.
//
//He also wants the Inquisition to stop torturing him now, please...",
//            "price" => "14.95",
//            "subjects" =>["Discworld (Imaginary place)","Science fiction","Fantasy fiction","Fiction","Fantasy","Discworld (imaginary place), fiction","Fiction, fantasy, general","Fiction, humorous","Comics & graphic novels, fantasy","Science fiction, fantasy, horror","Fiction, humorous, general","English literature","Protected DAISY"],
//            "publication_date" => guessDateFormat('Oct 29, 2013')]);
//        Book::create([
//            "isbn" => "9780062276285",
//            "title" => "Hogfather",
//            "author" => "Terry Pratchett",
//            "cover_url" => "https://covers.openlibrary.org/b/id/14648779-L.jpg",
//            "description" => "Who would want to harm Discworld\'s most beloved icon? Very few things are held sacred in this twisted, corrupt, heartless -- and oddly familiar -- universe, but the Hogfather is one of them. Yet here it is, Hogswatchnight, that most joyous and acquisitive of times, and the jolly old, red-suited gift-giver has vanished without a trace. And there\'s something shady going on involving an uncommonly psychotic member of the Assassins\' Guild and certain representatives of Ankh-Morpork\'s rather extensive criminal element. Suddenly Discworld\'s entire myth system is unraveling at an alarming rate. Drastic measures must be taken, which is why Death himself is taking up the reins of the fat man\'s vacated sleigh . . . which, in turn, has Death\'s level-headed granddaughter, Susan, racing to unravel the nasty, humbuggian mess before the holiday season goes straight to hell and takes everyone along with it.",
//            "price" => "14.95",
//            "subjects" =>["Fiction","Wizards","Discworld (Imaginary place)","Fantasy","Discworld (imaginary place), fiction","Fiction, fantasy, general","Death (fictitious character : pratchett), fiction","satire","humor","mythology","pratchett","discworld","Motion picture plays","Magos","Discworld (Lugar imaginario)","Ficción","Fiction, humorous, general","Literature and fiction, fantasy","Hogfather. (Motion picture)","Hogfather","Scénarios de cinéma","screenplays"],
//            "publication_date" => guessDateFormat('2014')]);
//        Book::create([
//            "isbn" => "9780062225740",
//            "title" => "Pyramids",
//            "author" => "Terry Pratchett",
//            "cover_url" => "https://covers.openlibrary.org/b/id/9021696-L.jpg",
//            "description" => "It\'s bad enough being new on the job, but Teppic hasn\'t a clue as to what a pharaoh is supposed to do. After all, he\'s been trained at Ankh-Morpork\'s famed assassins\' school, across the sea from the Kingdom of the Sun.First, there\'s the monumental task of building a suitable resting place for Dad -- a pyramid to end all pyramids. Then there are the myriad administrative duties, such as dealing with mad priests, sacred crocodiles, and marching mummies. And to top it all off, the adolescent pharaoh discovers deceit, betrayal -- not to mention aheadstrong handmaiden -- at the heart of his realm.",
//            "price" => "14.95",
//            "subjects" =>["American Fantasy fiction","Discworld (Imaginary place)","Fantasy","Fiction","Pyramids","Translations into Russian","Pyramids -- Fiction.","English fiction","Fiction, fantasy, general","Discworld (imaginary place), fiction","Fiction, humorous","Science fiction, fantasy, horror","Fiction, science fiction, general","Fiction, humorous, general","Literature and fiction, science fiction","Fiction, general","Spanish: Adult Fiction"],
//            "publication_date" => guessDateFormat('Apr 30, 2013')]);
//        Book::create([
//            "isbn" => "9780137909100",
//            "title" => "Code",
//            "author" => "Charles Petzold",
//            "cover_url" => "https://covers.openlibrary.org/b/id/14573187-L.jpg",
//            "description" => "",
//            "price" => "14.95",
//            "subjects" =>[],
//            "publication_date" => guessDateFormat('')]);
//        Book::create([
//            "isbn" => "9781119149224",
//            "title" => "PHP and MySQL",
//            "author" => "Jon Duckett",
//            "cover_url" => "https://covers.openlibrary.org/b/id/12403242-L.jpg",
//            "description" => "",
//            "price" => "14.95",
//            "subjects" =>["Php (computer program language)","Web site development","Sql (computer program language)","Mathematics"],
//            "publication_date" => guessDateFormat('2019')]);
//        Book::create([
//            "isbn" => "9781943873005",
//            "title" => "Murachs PHP and MySQL",
//            "author" => "Joel Murach,Ray Harris",
//            "cover_url" => "",
//            "description" => "",
//            "price" => "14.95",
//            "subjects" =>["Computers"],
//            "publication_date" => guessDateFormat('2022')]);
//        Book::create([
//            "isbn" => "9781492093824",
//            "title" => "Learning PHP, MySQL & JavaScript",
//            "author" => "Robin Nixon",
//            "cover_url" => "https://covers.openlibrary.org/b/id/11579767-L.jpg",
//            "description" => "Learning PHP, MySQL & JavaScript will teach you how to create responsive, data-driven websites with the three central technologies of PHP, MySQL and JavaScript - whether or not you know how to program. This simple, streamlined guide explains how the powerful combination of PHP and MySQL provides a painless way to build modern websites with dynamic data and user interaction. You\'ll also learn how to add JavaScript to create rich Internet websites and applications, and how to use Ajax to handle background communication with a web server. This book explains each technology separately, shows you how to combine them, and introduces valuable concepts in modern web programming, including objects, XHTML, cookies, regular expressions and session management.",
//            "price" => "14.95",
//            "subjects" =>["PHP (Computer program language)","Web sites","Web site development","Design","MySQL (Electronic resource)","JavaScript (Computer program language)","Mysql (computer program language)","Cascading style sheets","HTML (Document markup language)","Internet programming","Relational databases","Web sites, design","Query languages (Computer science)","Internetprogrammering","JAVASCRIPT","Webbsidor","CSS (märkspråk)","PHP","Webbdesign","Java (computer program language)","Programming","SQL (Computer program language)","PHP (Langage de programmation)","JavaScript (Langage de programmation)","Langages d'interrogation","Sites Web","Développement","Conception","COMPUTERS / Programming Languages / General","HTML","MySQL","JavaScript (Computer language)","PHP (Computer language)","Web sites - Design","Web programming","General","Site design","Page design","Com060160","Cs.cmp_sc.app_sw","Cs.cmp_sc.intrn_www","Cs.grphc_arts_cmm_dsg.wb_dsg_flsh_dream_html","Cs.offc_tch.intrn_wb_pg_dsg","Professional, career & trade -> computer science -> internet & www","Professional, career & trade -> computer science -> general","Games","Cs.cmp_sc.prog_lang","Sql","Web sites--design","Qa76.73.p224"],
//            "publication_date" => guessDateFormat('Aug 17, 2021')]);
//        Book::create([
//            "isbn" => "9781492054139",
//            "title" => "Programming PHP",
//            "author" => "Rasmus Lerdorf,Kevin Tatroe,Peter MacIntyre",
//            "cover_url" => "",
//            "description" => "",
//            "price" => "14.95",
//            "subjects" =>["Design","PHP (Computer program language)","Web sites","Programming languages (electronic computers)","Web sites, design","Internet programming","Web services","Php (computer program language)","General","Games","Com051010","Cs.cmp_sc.prog_lang","Professional, career & trade -> computer science -> general","Professional, career & trade -> computer science -> programming languages (jr/sr)"],
//            "publication_date" => guessDateFormat('2020')]);
//        Book::create([
//            "isbn" => "9781800562523",
//            "title" => "JavaScript from Beginner to Professional",
//            "author" => "Laurence Lars Svekis,Maaike van Putten,Rob Percival",
//            "cover_url" => "",
//            "description" => "",
//            "price" => "14.95",
//            "subjects" =>[],
//            "publication_date" => guessDateFormat('2021')]);
//    }

    }
}
