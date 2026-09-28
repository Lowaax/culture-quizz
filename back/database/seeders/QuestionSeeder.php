<?php

namespace Database\Seeders;

use App\Models\Categorie;
use App\Models\Question;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'Personnages' => [
                ['question' => "Qui est la mère de Luke et Leia ?", 'reponses' => ['Padmé Amidala', 'Shmi Skywalker', 'Beru Lars', 'Mon Mothma', 'Ahsoka Tano', 'Satine Kryze', 'Breha Organa', "Qi'ra", 'Jyn Erso', 'Rey']],
                ['question' => "Qui est la mère d'Anakin Skywalker ?", 'reponses' => ['Shmi Skywalker', 'Padmé Amidala', 'Beru Lars', 'Mon Mothma', 'Sola Naberrie', 'Ahsoka Tano', 'Breha Organa', 'Jyn Erso', 'Rey', 'Satine Kryze']],
                ['question' => "Qui est la Padawan d'Anakin Skywalker pendant la Guerre des Clones ?", 'reponses' => ['Ahsoka Tano', 'Barriss Offee', 'Aayla Secura', 'Luminara Unduli', 'Shaak Ti', 'Sabine Wren', 'Hera Syndulla', 'Bo-Katan Kryze', 'Jyn Erso', 'Rey']],
                ['question' => "Quelle sénatrice fonde l'Alliance Rebelle et la dirige politiquement ?", 'reponses' => ['Mon Mothma', 'Leia Organa', 'Padmé Amidala', 'Bail Organa', 'Amiral Ackbar', 'Jyn Erso', 'Cassian Andor', 'Lando Calrissian', 'Poe Dameron', 'Wedge Antilles']],
                ['question' => "Quel ami de Han Solo administre la Cité des Nuages de Bespin ?", 'reponses' => ['Lando Calrissian', 'Boba Fett', 'Wedge Antilles', 'Poe Dameron', 'Nien Nunb', 'Greedo', 'Jabba le Hutt', 'Dryden Vos', 'Bail Organa', 'Saw Gerrera']],
                ['question' => "Quel est le nom de l'oncle qui élève Luke sur Tatooine ?", 'reponses' => ['Owen Lars', 'Cliegg Lars', 'Biggs Darklighter', 'Ben Kenobi', 'Watto', 'Jira', 'Dexter Jettster', 'Lor San Tekka', 'Anakin Skywalker', 'Bail Organa']],
                ['question' => "Quel pilote rebelle est l'ami d'enfance de Luke sur Tatooine ?", 'reponses' => ['Biggs Darklighter', 'Wedge Antilles', 'Poe Dameron', 'Nien Nunb', 'Jek Porkins', 'Dak Ralter', 'Cassian Andor', 'Bodhi Rook', 'Snap Wexley', 'Han Solo']],
                ['question' => "Qui commande la flotte rebelle lors de la bataille d'Endor ?", 'reponses' => ['Amiral Ackbar', 'Amiral Raddus', 'Amiral Holdo', 'Général Dodonna', 'Général Rieekan', 'Nien Nunb', 'Amiral Piett', 'Grand Moff Tarkin', 'Général Hux', 'Amiral Statura']],
                ['question' => "Quel Grand Moff commande l'Étoile de la Mort dans Un Nouvel Espoir ?", 'reponses' => ['Grand Moff Tarkin', 'Amiral Piett', 'Général Veers', 'Directeur Krennic', 'Général Hux', 'Amiral Ozzel', 'Moff Gideon', 'Grand Amiral Thrawn', 'Capitaine Needa', 'Colonel Yularen']],
                ['question' => "Quel apprenti Sith au visage rouge et noir affronte Qui-Gon Jinn sur Naboo ?", 'reponses' => ['Dark Maul', 'Dark Vador', 'Comte Dooku', 'Palpatine', 'Général Grievous', 'Savage Opress', 'Asajj Ventress', 'Kylo Ren', 'Dark Bane', 'Dark Plagueis']],
                ['question' => "Qui est le père de Luke Skywalker ?", 'reponses' => ['Dark Vador', 'Obi-Wan Kenobi', 'Han Solo', "L'Empereur Palpatine", 'Yoda', 'Boba Fett', 'Qui-Gon Jinn', 'Owen Lars', 'Lando Calrissian', 'Mace Windu']],
                ['question' => "Quel est le véritable nom de Dark Vador ?", 'reponses' => ['Anakin Skywalker', 'Ben Solo', 'Kylo Ren', 'Sheev Palpatine', 'Jango Fett', 'Dooku', 'Qui-Gon Jinn', 'Obi-Wan Kenobi', 'Finn', 'Poe Dameron']],
                ['question' => "Qui est la sœur jumelle de Luke Skywalker ?", 'reponses' => ['Leia Organa', 'Padmé Amidala', 'Rey', 'Jyn Erso', 'Ahsoka Tano', 'Mon Mothma', "Qi'ra", 'Sabine Wren', 'Rose Tico', 'Bazine Netal']],
                ['question' => "Quelle espèce est Chewbacca ?", 'reponses' => ['Wookiee', 'Ewok', 'Rodien', 'Twi\'lek', 'Gungan', 'Zabrak', 'Jawa', 'Trandoshan', 'Sullustain', 'Mon Calamari']],
                ['question' => "Quel est le véritable nom de Kylo Ren ?", 'reponses' => ['Ben Solo', 'Poe Dameron', 'Finn', 'Hux', 'Snoke', 'Luke Skywalker', 'Anakin Skywalker', 'Dooku', 'Palpatine', 'Rey']],
                ['question' => "Qui est le maître Jedi qui entraîne Luke sur Dagobah ?", 'reponses' => ['Yoda', 'Obi-Wan Kenobi', 'Mace Windu', 'Qui-Gon Jinn', 'Ki-Adi-Mundi', 'Plo Koon', 'Yaddle', 'Luminara Unduli', 'Dooku', 'Kit Fisto']],
                ['question' => "Qui est le capitaine du Faucon Millenium au début de la saga (Episode IV) ?", 'reponses' => ['Han Solo', 'Lando Calrissian', 'Chewbacca', 'Poe Dameron', 'Wedge Antilles', 'Nien Nunb', 'Rey', 'Finn', "Qi'ra", 'Obi-Wan Kenobi']],
                ['question' => "Quel chasseur de primes capture Han Solo dans L'Empire contre-attaque ?", 'reponses' => ['Boba Fett', 'Jango Fett', 'Cad Bane', 'Greedo', 'Bossk', 'Dengar', 'IG-88', 'Zam Wesell', 'Embo', 'Aurra Sing']],
                ['question' => "Quel droïde astromécano accompagne le plus souvent Luke Skywalker ?", 'reponses' => ['R2-D2', 'C-3PO', 'BB-8', 'K-2SO', 'D-O', 'R5-D4', 'IG-11', 'L3-37', 'Chopper', '8D8']],
                ['question' => "Qui devient Empereur de la Galaxie sous le nom de Dark Sidious ?", 'reponses' => ['Palpatine', 'Dooku', 'Maul', 'Tarkin', 'Thrawn', 'Anakin Skywalker', 'Snoke', 'Vador', 'Krennic', 'Motti']],
            ],
            'Planètes & Lieux' => [
                ['question' => "Sur quelle planète Anakin et Padmé se marient-ils en secret ?", 'reponses' => ['Naboo', 'Coruscant', 'Alderaan', 'Tatooine', 'Scarif', 'Kamino', 'Geonosis', 'Mandalore', 'Corellia', 'Bespin']],
                ['question' => "Sur quelle planète océanique l'armée de clones est-elle fabriquée ?", 'reponses' => ['Kamino', 'Geonosis', 'Naboo', 'Mustafar', 'Scarif', 'Coruscant', 'Hoth', 'Bespin', 'Dathomir', 'Corellia']],
                ['question' => "Sur quelle planète tropicale les Rebelles volent-ils les plans de l'Étoile de la Mort dans Rogue One ?", 'reponses' => ['Scarif', 'Jedha', 'Eadu', 'Yavin IV', 'Endor', 'Tatooine', 'Lothal', 'Crait', 'Naboo', 'Hoth']],
                ['question' => "De quelle lune décollent les chasseurs rebelles pour attaquer la première Étoile de la Mort ?", 'reponses' => ['Yavin IV', 'Endor', 'Dantooine', 'Hoth', 'Crait', 'Jedha', 'Scarif', 'Lothal', 'Ajan Kloss', 'Naboo']],
                ['question' => "Sur quelle planète au sol de sel rouge se déroule la bataille finale des Derniers Jedi ?", 'reponses' => ['Crait', 'Hoth', 'Mustafar', 'Jakku', 'Ahch-To', 'Cantonica', 'Exegol', 'Endor', 'Scarif', 'Dagobah']],
                ['question' => "Sur quelle planète couverte d'îles Rey retrouve-t-elle Luke Skywalker en exil ?", 'reponses' => ['Ahch-To', 'Dagobah', 'Jakku', 'Crait', 'Exegol', 'Tatooine', 'Lothal', 'Takodana', 'Kef Bir', 'Mustafar']],
                ['question' => "Sur quelle planète se trouve la ville-casino de Canto Bight ?", 'reponses' => ['Cantonica', 'Coruscant', 'Bespin', 'Takodana', 'Corellia', 'Nar Shaddaa', 'Scarif', 'Jakku', 'Crait', 'Naboo']],
                ['question' => "Quelle planète cachée des Sith Rey découvre-t-elle dans L'Ascension de Skywalker ?", 'reponses' => ['Exegol', 'Moraband', 'Mustafar', 'Dathomir', 'Crait', 'Ahch-To', 'Jakku', 'Korriban', 'Malachor', 'Kef Bir']],
                ['question' => "Sur quelle planète se dresse le château de Maz Kanata ?", 'reponses' => ['Takodana', 'Jakku', 'Naboo', 'Endor', 'Batuu', 'Corellia', 'Cantonica', 'Crait', 'Ahch-To', 'Bespin']],
                ['question' => "De quelle planète Han Solo est-il originaire ?", 'reponses' => ['Corellia', 'Tatooine', 'Coruscant', 'Naboo', 'Jakku', 'Bespin', 'Alderaan', 'Kashyyyk', 'Nar Shaddaa', 'Chandrila']],
                ['question' => "Sur quelle planète Luke Skywalker grandit-il ?", 'reponses' => ['Tatooine', 'Naboo', 'Coruscant', 'Alderaan', 'Hoth', 'Endor', 'Dagobah', 'Jakku', 'Bespin', 'Kamino']],
                ['question' => "Quelle planète est détruite par l'Étoile de la Mort dans Un Nouvel Espoir ?", 'reponses' => ['Alderaan', 'Naboo', 'Hoth', 'Coruscant', 'Dantooine', 'Jedha', 'Hosnian Prime', 'Kashyyyk', 'Bespin', 'Ryloth']],
                ['question' => "Sur quelle planète glacée se trouve la base rebelle Echo dans L'Empire contre-attaque ?", 'reponses' => ['Hoth', 'Tatooine', 'Dagobah', 'Endor', 'Bespin', 'Naboo', 'Kamino', 'Jakku', 'Crait', 'Ilum']],
                ['question' => "Sur quelle planète Yoda vit-il en exil ?", 'reponses' => ['Dagobah', 'Tatooine', 'Naboo', 'Coruscant', 'Endor', 'Hoth', 'Mustafar', 'Kashyyyk', 'Bespin', 'Myrkr']],
                ['question' => "Quelle est la planète natale des Ewoks ?", 'reponses' => ['Endor', 'Kashyyyk', 'Naboo', 'Dagobah', 'Yavin 4', 'Felucia', 'Mygeeto', 'Sullust', 'Batuu', 'Ajan Kloss']],
                ['question' => "Quelle est la capitale de la République puis de l'Empire galactique ?", 'reponses' => ['Coruscant', 'Naboo', 'Corellia', 'Alderaan', 'Chandrila', 'Hosnian Prime', 'Kamino', 'Scarif', 'Takodana', 'Bespin']],
                ['question' => "Sur quelle planète se déroule le duel final entre Obi-Wan Kenobi et Anakin dans La Revanche des Sith ?", 'reponses' => ['Mustafar', 'Naboo', 'Geonosis', 'Kamino', 'Utapau', 'Coruscant', 'Tatooine', 'Polis Massa', 'Dagobah', 'Alderaan']],
                ['question' => "Quelle est la planète natale de Chewbacca ?", 'reponses' => ['Kashyyyk', 'Naboo', 'Endor', 'Ryloth', 'Dathomir', 'Rodia', 'Mandalore', 'Felucia', 'Trandosha', 'Sullust']],
                ['question' => "Sur quelle planète Rey est-elle abandonnée durant son enfance ?", 'reponses' => ['Jakku', 'Tatooine', 'Ahch-To', 'Crait', 'Pasaana', 'Exegol', 'Takodana', 'Endor', 'Naboo', 'Kijimi']],
                ['question' => "Quelle planète abrite la cité flottante de Bespin où se trouve Lando Calrissian ?", 'reponses' => ['Bespin', 'Naboo', 'Coruscant', 'Hoth', 'Tatooine', 'Endor', 'Dagobah', 'Mustafar', 'Kamino', 'Alderaan']],
            ],
            'Vaisseaux & Technologie' => [
                ['question' => "Quel énorme véhicule impérial à quatre pattes attaque la base rebelle de Hoth ?", 'reponses' => ['Le TB-TT (AT-AT)', 'Le TR-TT (AT-ST)', 'Le speeder T-47', 'Le TIE Bomber', 'Le Juggernaut', 'Le AT-TE', 'Le snowspeeder', 'Le landspeeder X-34', 'Le STAP', 'Le char AAT']],
                ['question' => "Quel est le nom du vaisseau personnel de Boba Fett ?", 'reponses' => ['Le Slave I', 'Le Faucon Millenium', 'Le Razor Crest', 'Le Tantive IV', 'Le Ghost', "L'Outrider", 'Le Havoc Marauder', 'Le Nightbrother', 'Le Naboo N-1', 'Le Rogue Shadow']],
                ['question' => "Quel vaisseau diplomatique de la princesse Leia est capturé au début d'Un Nouvel Espoir ?", 'reponses' => ['Le Tantive IV', 'Le Faucon Millenium', 'Le Slave I', 'Le Ghost', 'Le Devastator', 'Le Profundity', 'Le Home One', 'Le Radiant VII', 'Le Razor Crest', 'Le Nebulon-B']],
                ['question' => "Quel bombardier rebelle en forme de marteau participe à la bataille de Yavin ?", 'reponses' => ['Le Y-wing', 'Le X-wing', 'Le A-wing', 'Le B-wing', 'Le U-wing', 'Le TIE Bomber', 'Le Z-95', 'Le V-wing', "L'ARC-170", 'Le TIE Interceptor']],
                ['question' => "Comment s'appelle le Super Destroyer Stellaire de Dark Vador ?", 'reponses' => ["L'Executor", 'Le Devastator', 'Le Finalizer', 'Le Supremacy', 'Le Home One', 'Le Profundity', 'Le Malevolence', "L'Invisible Hand", 'Le Chimaera', "L'Eclipse"]],
                ['question' => "Quel droïde sphérique orange et blanc accompagne Poe Dameron ?", 'reponses' => ['BB-8', 'R2-D2', 'D-O', 'K-2SO', 'BD-1', 'R5-D4', 'C-3PO', 'IG-11', 'L3-37', 'Chopper']],
                ['question' => "Quel droïde impérial reprogrammé accompagne Cassian Andor dans Rogue One ?", 'reponses' => ['K-2SO', 'BB-8', 'R2-D2', 'IG-88', 'C-3PO', 'L3-37', 'D-O', 'Chopper', 'IG-11', '2-1B']],
                ['question' => "Quel dispositif permet à un vaisseau de voyager plus vite que la lumière ?", 'reponses' => ["L'hyperdrive", 'Le moteur ionique', 'Le répulseur', 'Le propulseur subluminique', 'Le turbolaser', 'Le rayon tracteur', 'Le générateur de bouclier', 'Le compensateur inertiel', 'Le noyau hypermatière', 'Le déflecteur']],
                ['question' => "Quelle arme de poing Han Solo porte-t-il à la ceinture ?", 'reponses' => ['Le blaster DL-44', "L'arbalète laser", 'Le fusil E-11', 'Le sabre laser', 'Le disrupteur', 'Le fusil DLT-19', 'Le pistolet Westar-34', 'Le détonateur thermique', "L'électro-bâton", 'Le lance-flammes']],
                ['question' => "Quelle arme Chewbacca porte-t-il en bandoulière ?", 'reponses' => ["L'arbalète laser (bowcaster)", 'Le blaster DL-44', 'Le fusil E-11', 'Le sabre laser', 'Le lance-roquettes', 'Le fusil de Tusken', 'La vibro-hache', 'Le disrupteur', 'Le fouet énergétique', 'Le fusil DLT-19']],
                ['question' => "Comment s'appelle le vaisseau de Han Solo et Chewbacca ?", 'reponses' => ['Le Faucon Millenium', "L'Étoile de la Mort", 'Le Destroyer Stellaire', 'La Navette Tydirium', 'Le Slave I', "L'Ebon Hawk", 'Le Ghost', 'La Razor Crest', 'Le Rebel Transport', "L'X-wing"]],
                ['question' => "Quel type de vaisseau est le Faucon Millenium ?", 'reponses' => ['Un cargo corellien', 'Un chasseur TIE', 'Un croiseur rebelle', 'Un destroyer stellaire', 'Un chasseur X-wing', 'Une navette impériale', 'Un croiseur mon calamari', 'Un chasseur TIE Interceptor', 'Un vaisseau Naboo', 'Un chasseur A-wing']],
                ['question' => "Quel est le nom du chasseur stellaire piloté par les pilotes rebelles comme Luke Skywalker à la bataille de Yavin ?", 'reponses' => ['X-wing', 'Y-wing', 'A-wing', 'TIE Fighter', 'B-wing', 'Chasseur Jedi', 'N-1 Starfighter', 'U-wing', 'Slave I', 'TIE Interceptor']],
                ['question' => "Quel est le petit chasseur utilisé par les pilotes de l'Empire, reconnaissable à ses ailes hexagonales ?", 'reponses' => ['Le chasseur TIE', 'X-wing', 'Y-wing', 'A-wing', 'B-wing', 'Le Faucon Millenium', 'Slave I', 'N-1 Starfighter', 'U-wing', 'Croiseur mon calamari']],
                ['question' => "Quelle arme ultime l'Empire construit-il, capable de détruire une planète entière ?", 'reponses' => ["L'Étoile de la Mort", 'Starkiller Base', "L'Exécuteur", 'Le Dévastateur', 'La Citadelle Noire', 'Le Whirlwind', "L'Arme de Coruscant", 'Le Sarlacc', 'La Station de Geonosis', 'Le Némésis']],
                ['question' => "Dans quoi Han Solo est-il congelé par Dark Vador sur Bespin ?", 'reponses' => ['La carbonite', 'La glace de Hoth', 'Un caisson cryogénique', 'Le sable de Tatooine', 'La lave de Mustafar', 'Un champ de force', 'Un bloc de trandium', 'Le gel bacta', 'Une capsule de stase', 'Un cristal de kyber']],
                ['question' => "Quel droïde est spécialisé dans le protocole et la traduction, toujours accompagné de R2-D2 ?", 'reponses' => ['C-3PO', 'BB-8', 'K-2SO', 'D-O', 'IG-88', 'L3-37', 'R5-D4', 'HK-47', '8D8', 'Chopper']],
                ['question' => "Quelle est l'arme emblématique des Jedi et des Sith ?", 'reponses' => ['Le sabre laser', 'Le blaster', 'Le fusil ionique', 'La lance à énergie', 'Le fouet à plasma', 'Le bâton de combat', 'Le lance-grenades', 'L\'arc vibrant', 'Le fusil sniper', 'Le vibro-poignard']],
                ['question' => "Quelle base secrète de l'Ordre Premier est construite à l'intérieur d'une planète entière ?", 'reponses' => ['Starkiller Base', "L'Étoile de la Mort", "L'Exécuteur", 'La Citadelle Noire', 'Exegol', 'La Forteresse de Vador', 'Le Dévastateur', 'La Base Echo', 'La Base de Scarif', 'La Base de Crait']],
                ['question' => "De quelle couleur est le sabre laser de Luke Skywalker dans Le Retour du Jedi ?", 'reponses' => ['Vert', 'Bleu', 'Rouge', 'Violet', 'Jaune', 'Orange', 'Blanc', 'Noir', 'Rose', 'Cyan']],
            ],
            'La Force & les Jedi' => [
                ['question' => "Quelle formule les Jedi emploient-ils pour se souhaiter bonne chance ?", 'reponses' => ['Que la Force soit avec toi', "Je suis un Jedi, comme mon père avant moi", "Fais-le, ou ne le fais pas", "C'est un piège !", 'Je sais', 'La Force est puissante dans ta famille', "Tu étais l'Élu !", 'Ainsi meurt la liberté', 'Adieu, vieil ami', 'La rébellion est morte']],
                ['question' => "Combien de Sith peuvent exister en même temps selon la Règle des Deux ?", 'reponses' => ['Deux', 'Un', 'Trois', 'Quatre', 'Cinq', 'Six', 'Sept', 'Dix', 'Douze', 'Aucun']],
                ['question' => "Quel rang un Jedi occupe-t-il avant de devenir Chevalier ?", 'reponses' => ['Padawan', 'Initié', 'Maître', 'Grand Maître', 'Youngling', 'Apprenti Sith', 'Gardien', 'Consulaire', 'Sentinelle', 'Sénateur']],
                ['question' => "Quels organismes microscopiques présents dans le sang mesurent la sensibilité à la Force ?", 'reponses' => ['Les midi-chloriens', 'Les cristaux kyber', 'Les holocrons', 'Les vergences', 'Les symbiotes', 'Les nanodroïdes', 'Les spores', 'Les bactas', 'Les plasmoïdes', 'Les krayts']],
                ['question' => "Quel objet renferme les savoirs secrets transmis entre Jedi ?", 'reponses' => ["L'holocron", 'Le datapad', 'Le cristal kyber', 'Le sabre noir', 'Le talisman Sith', 'Le codex Jedi', 'Le grimoire', 'La balise Jedi', 'Le prisme', 'La relique de Malachor']],
                ['question' => "Sur quelle planète glacée les jeunes Jedi récoltent-ils leur cristal kyber ?", 'reponses' => ['Ilum', 'Hoth', 'Dagobah', 'Jedha', 'Christophsis', 'Mustafar', 'Crait', 'Exegol', 'Lothal', 'Dathomir']],
                ['question' => "Qui est le maître Sith de Palpatine ?", 'reponses' => ['Dark Plagueis', 'Dark Maul', 'Comte Dooku', 'Dark Bane', 'Dark Vador', 'Savage Opress', 'Dark Tyranus', 'Snoke', 'Dark Revan', 'Dark Nihilus']],
                ['question' => "Quel nom Sith le Comte Dooku porte-t-il ?", 'reponses' => ['Dark Tyranus', 'Dark Maul', 'Dark Bane', 'Dark Sidious', 'Dark Plagueis', 'Dark Vador', 'Dark Revan', 'Dark Nihilus', 'Kylo Ren', 'Savage Opress']],
                ['question' => "Quelle technique de la Force Dark Vador utilise-t-il pour étouffer ses officiers à distance ?", 'reponses' => ["L'étranglement de la Force", 'La poussée de la Force', 'La persuasion Jedi', 'Les éclairs de Force', 'Le saut de la Force', 'La guérison par la Force', 'La vitesse de la Force', 'La projection de la Force', 'La vision de la Force', 'La fusion des esprits']],
                ['question' => "Quel pouvoir Palpatine déchaîne-t-il contre Luke dans Le Retour du Jedi ?", 'reponses' => ['Les éclairs de Force', "L'étranglement de la Force", 'La persuasion Jedi', 'La guérison par la Force', 'La projection de la Force', 'La télékinésie', 'Le saut de la Force', 'La vision de la Force', 'La vitesse de la Force', 'Le camouflage par la Force']],
                ['question' => "Comment appelle-t-on le côté maléfique de la Force ?", 'reponses' => ['Le Côté Obscur', 'Le Côté Lumineux', 'Le Chaos', 'La Discorde', "L'Anéantissement", 'La Voie Grise', 'Le Chemin des Ombres', 'La Force Noire', 'Le Néant', 'Le Vide']],
                ['question' => "Quel maître Jedi est connu pour sa petite taille et sa grande sagesse ?", 'reponses' => ['Yoda', 'Mace Windu', 'Obi-Wan Kenobi', 'Qui-Gon Jinn', 'Ki-Adi-Mundi', 'Plo Koon', 'Kit Fisto', 'Dooku', 'Yaddle', 'Even Piell']],
                ['question' => "Comment appelle-t-on les utilisateurs du Côté Obscur de la Force ?", 'reponses' => ['Les Sith', 'Les Jedi', 'Les Nightsisters', 'Les Mandaloriens', 'Les Acolytes', 'Les Séparatistes', 'Les Chasseurs de primes', 'Les Sénateurs', 'Les Clones', 'Les Inquisiteurs']],
                ['question' => "Qui est le maître de Dark Vador après sa transformation ?", 'reponses' => ["L'Empereur Palpatine", 'Dark Maul', 'Comte Dooku', 'Dark Plagueis', 'Dark Tyranus', 'Snoke', 'Dark Bane', 'Dark Malgus', 'Dark Revan', 'Dark Krayt']],
                ['question' => "Quel Jedi entraîne Anakin Skywalker en tant que Padawan ?", 'reponses' => ['Obi-Wan Kenobi', 'Qui-Gon Jinn', 'Yoda', 'Mace Windu', 'Dooku', 'Ki-Adi-Mundi', 'Plo Koon', 'Luminara Unduli', 'Kit Fisto', 'Even Piell']],
                ['question' => "Quel Jedi entraîne Obi-Wan Kenobi avant de mourir face à Dark Maul ?", 'reponses' => ['Qui-Gon Jinn', 'Mace Windu', 'Yoda', 'Dooku', 'Ki-Adi-Mundi', 'Plo Koon', 'Luminara Unduli', 'Kit Fisto', 'Even Piell', 'Adi Gallia']],
                ['question' => "Comment nomme-t-on les cristaux qui alimentent les sabres laser ?", 'reponses' => ['Cristaux Kyber', 'Cristaux Adegan', 'Cristaux Corusca', 'Cristaux de carbonite', 'Cristaux Sith', 'Cristaux Nghasa', 'Cristaux Opila', 'Cristaux Ergo', 'Cristaux Mestra', 'Cristaux Ilum']],
                ['question' => "Quel maître Jedi affronte Palpatine en duel dans La Revanche des Sith mais est vaincu ?", 'reponses' => ['Mace Windu', 'Yoda', 'Obi-Wan Kenobi', 'Qui-Gon Jinn', 'Ki-Adi-Mundi', 'Plo Koon', 'Kit Fisto', 'Luminara Unduli', 'Dooku', 'Saesee Tiin']],
                ['question' => "Qui exécute la majorité des Jedi lors de l'Ordre 66 ?", 'reponses' => ['Les clones', 'Les Sith', 'Les droïdes de combat', 'Les Séparatistes', 'Les Mandaloriens', 'Les Inquisiteurs', 'Les Nightsisters', 'Les chasseurs de primes', 'Les Wookiees', 'Les Gungans']],
                ['question' => "Quel titre porte Rey à la toute fin de la trilogie séquelle ?", 'reponses' => ['Chevalier Jedi', 'Maître Sith', 'Impératrice', 'Padawan', 'Sénatrice', 'Mandalorienne', 'Chancelière', 'Inquisitrice', 'Générale', 'Contrebandière']],
            ],
            'Sagas & Films' => [
                ['question' => "Quel est le titre de l'Episode V ?", 'reponses' => ["L'Empire contre-attaque", 'Le Retour du Jedi', 'Un Nouvel Espoir', 'La Menace fantôme', "L'Attaque des clones", 'La Revanche des Sith', 'Le Réveil de la Force', 'Les Derniers Jedi', "L'Ascension de Skywalker", 'Rogue One']],
                ['question' => "Quel est le titre de l'Episode II ?", 'reponses' => ["L'Attaque des clones", 'La Menace fantôme', 'La Revanche des Sith', 'Un Nouvel Espoir', "L'Empire contre-attaque", 'Le Retour du Jedi', 'Le Réveil de la Force', 'Les Derniers Jedi', "L'Ascension de Skywalker", 'Solo']],
                ['question' => "Qui compose la musique de la saga Star Wars ?", 'reponses' => ['John Williams', 'Hans Zimmer', 'Howard Shore', 'Ennio Morricone', 'Michael Giacchino', 'Danny Elfman', 'James Horner', 'Alan Silvestri', 'Jerry Goldsmith', 'John Powell']],
                ['question' => "Qui réalise Les Derniers Jedi (Episode VIII) ?", 'reponses' => ['Rian Johnson', 'J.J. Abrams', 'George Lucas', 'Gareth Edwards', 'Ron Howard', 'Irvin Kershner', 'Richard Marquand', 'Colin Trevorrow', 'Tony Gilroy', 'Dave Filoni']],
                ['question' => "Qui réalise L'Empire contre-attaque ?", 'reponses' => ['Irvin Kershner', 'George Lucas', 'Richard Marquand', 'J.J. Abrams', 'Rian Johnson', 'Ron Howard', 'Gareth Edwards', 'Steven Spielberg', 'Lawrence Kasdan', 'Dave Filoni']],
                ['question' => "Quelle série animée suit Anakin et Ahsoka pendant la Guerre des Clones ?", 'reponses' => ['The Clone Wars', 'Rebels', 'The Bad Batch', 'Resistance', 'Visions', 'Tales of the Jedi', 'The Mandalorian', 'Andor', 'Ahsoka', 'Droids']],
                ['question' => "Quelle série suit un chasseur de primes mandalorien et l'enfant Grogu ?", 'reponses' => ['The Mandalorian', 'Andor', 'Obi-Wan Kenobi', 'Ahsoka', 'The Book of Boba Fett', 'Rebels', 'The Acolyte', 'Skeleton Crew', 'Resistance', 'The Bad Batch']],
                ['question' => "Quel groupe rachète Lucasfilm en 2012 ?", 'reponses' => ['Disney', 'Warner Bros', 'Universal', 'Sony', 'Paramount', 'Netflix', '20th Century Fox', 'MGM', 'Amazon', 'Pixar']],
                ['question' => "Quel studio distribue les six premiers films de la saga au cinéma ?", 'reponses' => ['20th Century Fox', 'Disney', 'Warner Bros', 'Universal', 'Paramount', 'Columbia', 'MGM', 'United Artists', 'Lionsgate', 'New Line']],
                ['question' => "Comment appelle-t-on le texte jaune qui défile au début de chaque film ?", 'reponses' => ["Le crawl d'ouverture", 'Le générique', 'Le prologue', "L'épilogue", 'Le teaser', 'Le carton-titre', 'La voix off', 'Le synopsis', "L'intertitre", 'Le chapitre']],
                ['question' => "Quel est le titre de l'Episode IV de Star Wars ?", 'reponses' => ['Un Nouvel Espoir', "L'Empire contre-attaque", 'Le Retour du Jedi', 'La Menace fantôme', "L'Attaque des clones", 'La Revanche des Sith', 'Le Réveil de la Force', 'Les Derniers Jedi', "L'Ascension de Skywalker", 'Rogue One']],
                ['question' => "Quel est le premier film de la saga Star Wars sorti au cinéma, en 1977 ?", 'reponses' => ['Un Nouvel Espoir', 'La Menace fantôme', "L'Empire contre-attaque", 'Le Retour du Jedi', "L'Attaque des clones", 'La Revanche des Sith', 'Le Réveil de la Force', 'Rogue One', 'Solo', 'Les Derniers Jedi']],
                ['question' => "Quel réalisateur a créé Star Wars ?", 'reponses' => ['George Lucas', 'Steven Spielberg', 'J.J. Abrams', 'Irvin Kershner', 'Richard Marquand', 'Rian Johnson', 'Ron Howard', 'Gareth Edwards', 'James Cameron', 'Peter Jackson']],
                ['question' => "Quel film narre la bataille d'Endor et la destruction de la deuxième Étoile de la Mort ?", 'reponses' => ['Le Retour du Jedi', 'Un Nouvel Espoir', "L'Empire contre-attaque", 'La Menace fantôme', "L'Attaque des clones", 'La Revanche des Sith', 'Le Réveil de la Force', 'Les Derniers Jedi', 'Rogue One', 'Solo']],
                ['question' => "Quel est le titre de l'Episode I ?", 'reponses' => ['La Menace fantôme', "L'Attaque des clones", 'La Revanche des Sith', 'Un Nouvel Espoir', "L'Empire contre-attaque", 'Le Retour du Jedi', 'Le Réveil de la Force', 'Les Derniers Jedi', "L'Ascension de Skywalker", 'Rogue One']],
                ['question' => "Quel film spin-off raconte le vol des plans de l'Étoile de la Mort avant Un Nouvel Espoir ?", 'reponses' => ['Rogue One', 'Solo', 'La Menace fantôme', 'Les Derniers Jedi', "L'Ascension de Skywalker", 'Le Réveil de la Force', "L'Attaque des clones", 'La Revanche des Sith', "L'Empire contre-attaque", 'Le Retour du Jedi']],
                ['question' => "Quel film spin-off raconte la jeunesse de Han Solo ?", 'reponses' => ['Solo: A Star Wars Story', 'Rogue One', 'La Menace fantôme', 'Le Réveil de la Force', 'Les Derniers Jedi', "L'Ascension de Skywalker", "L'Attaque des clones", 'La Revanche des Sith', "L'Empire contre-attaque", 'Le Retour du Jedi']],
                ['question' => "Qui réalise Le Réveil de la Force (Episode VII) ?", 'reponses' => ['J.J. Abrams', 'George Lucas', 'Rian Johnson', 'Irvin Kershner', 'Richard Marquand', 'Ron Howard', 'Gareth Edwards', 'Steven Spielberg', 'James Cameron', 'Peter Jackson']],
                ['question' => "Quel est le dernier film de la trilogie séquelle ?", 'reponses' => ["L'Ascension de Skywalker", 'Le Réveil de la Force', 'Les Derniers Jedi', 'Le Retour du Jedi', 'La Revanche des Sith', 'Rogue One', 'Solo', 'Un Nouvel Espoir', 'La Menace fantôme', "L'Attaque des clones"]],
                ['question' => "En quelle année sort le tout premier film Star Wars au cinéma ?", 'reponses' => ['1977', '1980', '1983', '1999', '2002', '2005', '2015', '2017', '2019', '1975']],
            ],
            'Créatures & Espèces' => [
                ['question' => "Quelle créature griffue attaque Luke sous le palais de Jabba le Hutt ?", 'reponses' => ['Le Rancor', 'Le Sarlacc', 'Le Wampa', 'Le Krayt Dragon', 'Le Nexu', "L'Acklay", 'Le Reek', 'Le Gundark', 'Le Dianoga', 'Le Varactyl']],
                ['question' => "Quel monstre tentaculaire vit dans le compacteur de déchets de l'Étoile de la Mort ?", 'reponses' => ['Le Dianoga', 'Le Sarlacc', 'Le Rancor', "L'Exogorth", 'Le Wampa', 'Le Gundark', 'Le Mynock', 'Le Nexu', 'Le Krayt Dragon', 'Le Reek']],
                ['question' => "Quelle créature géante avale le Faucon Millenium dans un champ d'astéroïdes ?", 'reponses' => ["L'Exogorth (ver de l'espace)", 'Le Dianoga', 'Le Sarlacc', 'Le Rancor', 'Le Mynock', 'Le Krayt Dragon', 'Le Purrgil', 'Le Summa-verminoth', 'Le Wampa', 'Le Gundark']],
                ['question' => "Quels parasites ailés s'accrochent à la coque du Faucon Millenium ?", 'reponses' => ['Les Mynocks', 'Les Porgs', 'Les Dianogas', 'Les Gundarks', 'Les Purrgils', 'Les Womp rats', 'Les Nexus', 'Les Reeks', 'Les Acklays', 'Les Tauntauns']],
                ['question' => "Quels petits oiseaux marins peuplent l'île d'Ahch-To ?", 'reponses' => ['Les Porgs', 'Les Mynocks', 'Les Convors', 'Les Loth-chats', 'Les Fathiers', 'Les Vulptex', 'Les Tauntauns', 'Les Womp rats', 'Les Kowakiens', 'Les Nerfs']],
                ['question' => "Quelles créatures de cristal ressemblant à des renards vivent sur Crait ?", 'reponses' => ['Les Vulptex', 'Les Porgs', 'Les Loth-chats', 'Les Fathiers', 'Les Convors', 'Les Mynocks', 'Les Tauntauns', 'Les Nexus', 'Les Massifs', 'Les Corvax']],
                ['question' => "À quelle espèce cornue appartient Dark Maul ?", 'reponses' => ['Les Zabraks', "Les Twi'leks", 'Les Togrutas', 'Les Rodiens', 'Les Trandoshans', 'Les Gamorréens', 'Les Nautolans', 'Les Kaminoans', 'Les Quarren', 'Les Chagrians']],
                ['question' => "Quelle espèce élancée aux grands yeux fabrique l'armée de clones ?", 'reponses' => ['Les Kaminoans', 'Les Mon Calamari', 'Les Géonosiens', 'Les Neimoidiens', 'Les Muuns', 'Les Quarren', 'Les Gungans', 'Les Ithorians', 'Les Toydariens', 'Les Bith']],
                ['question' => "Quelle espèce insectoïde construit les usines de droïdes de Geonosis ?", 'reponses' => ['Les Géonosiens', 'Les Kaminoans', 'Les Neimoidiens', 'Les Gungans', 'Les Wookiees', 'Les Ugnaughts', 'Les Jawas', 'Les Rodiens', 'Les Trandoshans', 'Les Bith']],
                ['question' => "De quelle espèce aux montrals rayés est Ahsoka Tano ?", 'reponses' => ['Togruta', "Twi'lek", 'Zabrak', 'Nautolan', 'Mirialan', 'Rodien', 'Chiss', 'Pantoran', 'Mon Calamari', 'Kaminoan']],
                ['question' => "Quelle créature géante vit dans une fosse près du palais de Jabba le Hutt ?", 'reponses' => ['Le Sarlacc', 'Le Rancor', 'Le Wampa', 'Le Krayt Dragon', "L'Exogorth", 'Le Dianoga', 'Le Gundark', 'Le Nexu', "L'Acklay", 'Le Reek']],
                ['question' => "Quelle créature des glaces attaque Luke Skywalker sur Hoth ?", 'reponses' => ['Le Wampa', 'Le Rancor', 'Le Sarlacc', 'Le Tauntaun', "L'Exogorth", 'Le Krayt Dragon', 'Le Dianoga', 'Le Gundark', 'Le Nexu', "L'Acklay"]],
                ['question' => "Quel animal Luke et Han montent-ils pour se déplacer sur Hoth ?", 'reponses' => ['Le Tauntaun', 'Le Wampa', 'Le Bantha', 'Le Rancor', 'Le Dewback', 'Le Ronto', 'Le Nerf', 'Le Fathier', 'Le Kaadu', 'Le Massif']],
                ['question' => "Quel animal est souvent utilisé comme monture par les Jawas et les Tuskens sur Tatooine ?", 'reponses' => ['Le Bantha', 'Le Tauntaun', 'Le Dewback', 'Le Wampa', 'Le Ronto', 'Le Nerf', 'Le Varactyl', 'Le Fathier', 'Le Kaadu', 'Le Massif']],
                ['question' => "Quelle espèce de petits pilleurs encapuchonnés récupère des droïdes sur Tatooine ?", 'reponses' => ['Les Jawas', 'Les Ewoks', 'Les Tuskens', 'Les Ugnaughts', 'Les Ithorians', 'Les Gungans', 'Les Gamorréens', 'Les Rodiens', 'Les Chadra-Fan', 'Les Sullustains']],
                ['question' => "Quelle espèce de petits guerriers vivant dans les arbres d'Endor aide les Rebelles ?", 'reponses' => ['Les Ewoks', 'Les Jawas', 'Les Gungans', 'Les Wookiees', 'Les Ugnaughts', 'Les Ithorians', 'Les Gamorréens', 'Les Rodiens', 'Les Chadra-Fan', 'Les Sullustains']],
                ['question' => "Quelle espèce amphibie maladroite habite Naboo aux côtés des humains ?", 'reponses' => ['Les Gungans', 'Les Ewoks', 'Les Jawas', "Les Twi'leks", 'Les Mon Calamari', 'Les Ithorians', 'Les Rodiens', 'Les Zabraks', 'Les Toydariens', 'Les Quarren']],
                ['question' => "Quelle est l'espèce de Jabba le Hutt ?", 'reponses' => ['Hutt', 'Toydarien', 'Rodien', "Twi'lek", 'Gungan', 'Mon Calamari', 'Sullustain', 'Trandoshan', 'Quarren', 'Neimoidien']],
                ['question' => "Quelle espèce à tête de poisson dirige la flotte rebelle aux côtés de l'Amiral Ackbar ?", 'reponses' => ['Les Mon Calamari', 'Les Quarren', 'Les Gungans', 'Les Ithorians', "Les Twi'leks", 'Les Rodiens', 'Les Sullustains', 'Les Toydariens', 'Les Chadra-Fan', 'Les Aqualish']],
                ['question' => "Quelle espèce de guerriers velus, dont fait partie Chewbacca, vit sur Kashyyyk ?", 'reponses' => ['Les Wookiees', 'Les Ewoks', 'Les Trandoshans', 'Les Gungans', 'Les Jawas', 'Les Gamorréens', 'Les Rodiens', 'Les Zabraks', 'Les Sullustains', 'Les Ithorians']],
            ],
        ];

        foreach ($data as $categorieName => $questions) {
            $categorie = Categorie::where('categorie', $categorieName)->first();
            if (!$categorie) {
                continue;
            }

            foreach ($questions as $q) {
                [$r1, $r2, $r3, $r4, $r5, $r6, $r7, $r8, $r9, $r10] = $q['reponses'];

                // firstOrCreate plutôt que create : le seeder peut être relancé
                // après l'ajout de questions sans dupliquer les anciennes.
                Question::firstOrCreate([
                    'categorie_id' => $categorie->id,
                    'question' => $q['question'],
                ], [
                    'reponse1' => $r1,
                    'reponse2' => $r2,
                    'reponse3' => $r3,
                    'reponse4' => $r4,
                    'reponse5' => $r5,
                    'reponse6' => $r6,
                    'reponse7' => $r7,
                    'reponse8' => $r8,
                    'reponse9' => $r9,
                    'reponse10' => $r10,
                ]);
            }
        }
    }
}
