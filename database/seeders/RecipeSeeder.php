<?php

namespace Database\Seeders;

use App\Models\Allergen;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\Recipe;

class RecipeSeeder extends Seeder
{
    public function run(): void
    {
        $user1 = User::where('email', 'admin@example.com')->first();
        $user2 = User::where('email', 'john@example.com')->first();
        $user3 = User::where('email', 'jane@example.com')->first();


        $category1 = Category::where('name', 'Bezmásá jídla')->first();
        $category2 = Category::where('name', 'Zdravé')->first();
        $category3 = Category::where('name', 'Polévky')->first();
        $category4 = Category::where('name', 'Rychlovky')->first();
        $category5 = Category::where('name', 'Dezerty')->first();
        $category6 = Category::where('name', 'Těstoviny')->first();

        if (!$user1 || !$user2 || !$user3) {
            $this->command->error('User does not exist. Please ensure UserSeeder is run first.');
            return;
        }

        if (!$category1 || !$category2 || !$category3 || !$category4 || !$category5 || !$category6) {
            $this->command->error('No categories found. Please ensure CategorySeeder is run first.');
            return;
        }

        $recipes = [
            [
                'name' => 'BigMac Salát',
                'ingredients' => [
                    '100 g mletého hovězího masa',
                    '1 špetka soli',
                    "1 špetka pepře",
                    "50 g ledového salátu",
                    "200 g rajčat",
                    "50 g kyselých/salátových okurek",
                    "50 g cibule",
                    "20 g cheddaru",
                    "2 lžíce kečupu",
                ],
                'rating' => 0,
                'reviews' => 0,
                'allergens' => ['Mléko'],
                'category_id' => $category2->id,
                'user_id' => $user1->id,
                'steps' => 'Ledový salát, rajčata a okurky nakrájej na malé kousky. Cibuli nakrájej najemno a cheddar nakrájej či nastrouhej.
Připrav si omáčku. Stačí ti smíchat kečup, hořčici, a jogurt (pokud máš kyselé okurky, tak i lák z okurek) a vše osolit a opepřit.
Na pánev dej mleté maso, které osol a opepři. Můžeš přidat mletou papriku, dvě lžíce kečupu, hořčici.
Až bude maso hotové, tak už jen zbývá vše naházet do velké misky. Nejprve salát, potom zbylou zeleninu, nastrouhaný sýr, mleté maso a vše pocákej omáčkou.',
                'servings' => 4,
                'image' => 'bigMacSalat.jpg',
            ],
            [
                'name' => 'Jarní závitky',
                'ingredients' => [
                    "rýžové nudle 60 g",
                    "rýžový papír 8 ks",
                    "krevety 200 g",
                    "mrkev 2 ks",
                    "okurka 1/2 ks",
                    "ledový salát",
                    "koriandr",
                    "sůl",
                    "½ lžíce oleje",
                ],
                'rating' => 0,
                'reviews' => 0,
                'allergens' => ['Korýši', 'Měkkýši'],
                'category_id' => $category2->id,
                'user_id' => $user1->id,
                'steps' => 'Mrkev a okurku oloupeme a nakrájíme na tenké proužky. Nemusí být vysloveně julienne, ale rozhodně raději tenčí než silnější.
Rýžové nudle uvaříme podle návodu a řádně je propláchneme ledovou vodou
Krevety očistíme, osolíme a na oleji zarestujeme.
Připravíme si hlubší talíř nebo širší misku, do které se vejde rýžový papír. Do misky vlejeme teplou (vodu a jeden plátek rýžového papíru v něm na pár sekund namočíme, aby změknul. Vyndáme papír a položíme například na čistou suchou utěrku.
Na papír naskládáme všechny ingredience a zarolujeme
Jarní závitky doporučujeme podávat například s Nuoc Cham omáčkou nebo sladkokyselou chilli omáčkou
',
                'servings' => 1,
                'image' => 'jarniZavitky.jpg',
            ],
            [
                'name' => 'Rýže s cizrnovou omáčkou',
                'ingredients' => [
                    "⅓× malá žlutá cibule",
                    "⅓× velké rajče",
                    "40 g bílé rýže basmati v suchém stavu ",
                    "1 lžíce olivového oleje ",
                    "1 lžíce rajčatového protlaku",
                    "150 g předvařené cizrny",
                    "sladká paprika",
                    "35 ml sójové smetany (nebo jiné rostlinné smetany – např. rýžové)",
                    "pepř",
                    "sůl",
                ],
                'rating' => 0,
                'reviews' => 0,
                'allergens' => [],
                'category_id' => $category2->id,
                'user_id' => $user2->id,
                'steps' => 'Cibuli oloupejte a nasekejte najemno. Rajče nakrájejte na kostičky.
Rýži basmati dejte vařit podle návodu na obalu (většinou se vaří přibližně 15 minut na mírném plameni pod pokličkou v 1,5–2násobném množství osolené vody). Pokud používáte rýži basmati natural, počítejte s delší dobou vaření (cca 25–35 minut).
Než se uvaří rýže, připravte si cizrnovou omáčku. Nejprve si v hluboké pánvi rozehřejte 2 lžíce olivového oleje, přidejte nasekanou cibuli a smažte ji cca 2 minuty na mírném plameni, dokud nezesklovatí.
Do pánve přidejte 1 lžíci rajčatového protlaku, předvařenou cizrnu a nakrájené rajče a vše opékejte dalších 5 minut na mírném plameni.
Nakonec do pánve přidejte ½ lžičky pepře a 1 lžičku mleté sladké papriky, vše promíchejte a směs zalijte sójovou smetanou. Poté pánev přiklopte pokličkou a nechte 5 minut povařit na mírném plameni.
Hotovou omáčku podávejte společně s uvařenou rýží.',
                'servings' => 1,
                'image' => 'ryzeCizrna.jpg',
            ],
            [
                'name' => 'Mangová panna cotta',
                'ingredients' => [
                    "želatina 2 plátky",
                    "smetana na šlehání 200 mililitrů",
                    "mléko 200 mililitrů (plnotučné)",
                    "cukr krystal 80 gramů",
                    "vanilkový lusk 1 kus",
                    "mango 1 kus (zralé)",
                    "cukr moučkový (na dochucení)",
                    "limetková kůra (z jedné limetky)",
                ],
                'rating' => 0,
                'reviews' => 0,
                'allergens' => ['mléko'],
                'category_id' => $category5->id,
                'user_id' => $user2->id,
                'steps' => 'smetanu, cukr a semínka vanilky přiveďte k varu a odstavte z ohně.
Nabobtnalou želatinu vymačkejte a zbavte přebytečné vody. Za stálého míchání ji přidejte do horké smetanové směsi a nechte dokonale rozpustit. Nalijte do skleniček a dejte chladit do lednice, ideálně přes noc, minimálně na několik hodin.
Mango podélně rozpulte, opatrně vykrojte pecku. Dužinu nakrájejte do tvaru mřížky a prohněte slupku, snadno tak získáte kostičky dužiny. Pár si jich schovejte na ozdobu, většinu rozmixujte na hladké pyré.
Ztuhlou panna cottu zalijte mangovým pyré. Ozdobte kousky manga, proužky limetové kůry',
                'servings' => 4,
                'image' => 'pannaCotta.jpg',
            ],
            [
                'name' => 'Borůvkové muffiny',
                'ingredients' => [
                    "250 g polohrubé mouky",
                    "125 g másla",
                    "100 g cukru",
                    "125 g borůvek",
                    "125 ml mléka",
                    "2 sáčky vanilkového cukru",
                    "2 lžičky kypřicího prášku do pečiva",
                    "2 vejce",
                    "tuk na vymazání formy",
                    "hrubá mouka na vysypání",
                ],
                'rating' => 0,
                'reviews' => 0,
                'allergens' => ['mléko', 'vejce', 'Lepek (pšenice, žito, ječmen, oves)'],
                'category_id' => $category5->id,
                'user_id' => $user1->id,
                'steps' => 'Utřeme máslo ručním šlehačem s metličkami na nejnižším stupni, spolu s cukrem a vanilkovým cukrem do hladka.
Poté přidáme rozklepnutá vejce a šleháme asi půl minuty. Dále přidáme kypřicí prášek, mouku a mléko. Vypracujeme hladké těsto, do kterého nakonec vmícháme borůvky. (TIP: Těsto můžeme například rozmixovanými borůvkami či barvivem obarvit pro zábavnější vzhled)
Hotové těsto vlijeme do předem vymazané a vysypané formy na muffiny. Můžeme ozdobit například srdíčky či jiným posypem.
V troubě pečeme asi 25 minut při 180 °C.',
                'servings' => 12,
                'image' => 'boruvMufin.jpg',
            ],
            [
                'name' => 'Špagety Aglio e Olio',
                'ingredients' => [
                    "400 g špaget",
                    "4 stroužky česneku",
                    "1/2 hrnku extra panenského olivového oleje",
                    "1 lžička sušených chilli vloček (dle chuti)",
                    "Špetka šafránu na ozdobu",
                    "Sůl podle chuti",
                    "Čerstvá petrželka (nasekaná, volitelné)",
                ],
                'rating' => 0,
                'reviews' => 0,
                'allergens' => ['Lepek (pšenice, žito, ječmen, oves)'],
                'category_id' => $category6->id,
                'user_id' => $user1->id,
                'steps' => 'Vložte špagety do vroucí osolené vody a vařte je dle návodu na obalu tak, aby byly al dente (na skus).
Po uvaření těstoviny slijte, ale ponechte si hrnek vody z těstovin pro zjemnění omáčky.
',
                'servings' => 12,
                'image' => 'spagetyAglio.jpg',
            ],
            [
                'name' => 'Těstoviny se sýrovou omáčkou',
                'ingredients' => [
                    "300 g těstovin ",
                    "250 ml smetany na vaření (min. 30 % tuku)",
                    "150 g sýru (např. čedar, parmezán, niva, gouda nebo jejich kombinace)",
                    "1 lžíce másla",
                    "1 stroužek česneku (volitelné)",
                    "Sůl a pepř podle chuti",
                    "Muškátový oříšek (špetka, volitelné)",
                    "Čerstvé bylinky na ozdobu (např. petrželka nebo pažitka – volitelné) ",
                ],
                'rating' => 0,
                'reviews' => 0,
                'allergens' => ['Lepek (pšenice, žito, ječmen, oves)', 'mléko'],
                'category_id' => $category6->id,
                'user_id' => $user2->id,
                'steps' => 'Krok 1: Příprava těstovin
Naplňte velký hrnec vodou, osolte ji (cca 1 lžička soli na 1 litr vody) a přiveďte k varu.
Do vroucí vody vložte těstoviny a vařte podle návodu na obalu.
Po uvaření těstoviny slijte, ale ponechte si asi 100 ml vody z těstovin (pro případné zjemnění omáčky).

Krok 2: Příprava sýrové omáčky
Na pánvi rozehřejte lžíci másla na středním plamenu.
Pokud chcete přidat česnek, nasekejte ho nadrobno a lehce osmahněte na másle (stačí 30 sekund, aby nezhořkl).
Přilijte smetanu na vaření a nechte ji lehce zahřát, ale nevařte.

Krok 3: Přidání sýra
Postupně přidávejte nastrouhaný sýr do smetany a míchejte, dokud se zcela nerozpustí a nevznikne hladká omáčka.
Dochutťe omáčku špetkou soli, čerstvě mletým pepřem a případně muškátovým oříškem.

Krok 4: Spojení těstovin s omáčkou
Do hotové omáčky přidejte uvařené těstoviny a dobře promíchejte, aby se omáčka rovnoměrně obalila kolem těstovin (já jsem si omáčku na těstoviny nalil).
Pokud je omáčka příliš hustá, přilijte trochu vody, kterou jste si ponechali z vaření těstovin, a zjemněte konzistenci.

Krok 5: Servírování
Těstoviny se sýrovou omáčkou naservírujte na talíře.
Ozdobte nasekanými čerstvými bylinkami a případně posypte trochou nastrouhaného sýru.
Podávejte ihned, aby si pokrm zachoval krémovou strukturu.',
                'servings' => 4,
                'image' => 'syrOmacka.png',
            ],
            [
                'name' => 'Pórková polévka s krutony',
                'ingredients' => [
                    "2 velké pórky (jen bílé a světle zelené části)",
                    "1 lžíce másla",
                    "1 lžíce olivového oleje",
                    "1 litr zeleninového vývaru",
                    "200 ml smetany ke šlehání ",
                    "Sůl a pepř podle chuti",
                    "4 plátky bílého chleba nebo bagety",
                    "2 lžíce olivového oleje nebo másla",
                    "Špetka sušeného česneku nebo bylinek (tymián, rozmarýn)",
                ],
                'rating' => 0,
                'reviews' => 0,
                'allergens' => ['Lepek (pšenice, žito, ječmen, oves)', 'mléko'],
                'category_id' => $category3->id,
                'user_id' => $user3->id,
                'steps' => 'Příprava pórku: Pórky důkladně omyjte a nakrájejte na tenká kolečka.
Základ: V hrnci rozehřejte máslo a olej, přidejte pórek a restujte ho na mírném ohni asi 5 minut, dokud nezměkne, ale nezačne hnědnout.
Vaření: Zalijte zeleninovým vývarem, přiveďte k varu a poté snižte teplotu. Vařte asi 20 minut.
Mixování: Polévku rozmixujte tyčovým mixérem do hladka. Přidejte smetanu, aby byla polévka krémová a nechte ji krátce prohřát. Dochutťe solí a pepřem.

Krutony
Příprava: Nakrájejte chleba nebo bagetu na malé kostičky.
Restování: Na pánvi rozehřejte olivový olej nebo máslo, přidejte kostičky chleba a opékejte, dokud nejsou zlatavé a křupavé. Posypte česnekem nebo bylinkami podle chuti.

Servírování
Nalijte polévku do talíře, přidejte křupavé krutony a případně ozdobte nasekanou petrželkou.',
                'servings' => 4,
                'image' => 'porkPolevka.jpg',
            ],
            [
                'name' => 'Houbová polévka s krutony',
                'ingredients' => [
                    "300 g čerstvých hub (např. žampiony, hříbky nebo směs lesních hub)",
                    "1 cibule",
                    "1 stroužek česneku",
                    "1 lžíce másla",
                    "1 lžíce olivového oleje",
                    "1 litr zeleninového nebo kuřecího vývaru",
                    "200 ml smetany na vaření ",
                    "Sůl a pepř podle chuti",
                    "Špetka tymiánu nebo majoránky",
                    "krutony"
                ],
                'rating' => 0,
                'reviews' => 0,
                'allergens' => ['Lepek (pšenice, žito, ječmen, oves)', 'mléko'],
                'category_id' => $category3->id,
                'user_id' => $user1->id,
                'steps' => 'Příprava hub: Houby očistěte a nakrájejte na plátky.
Základ: V hrnci rozehřejte máslo a olej. Přidejte nadrobno nakrájenou cibuli a restujte do zesklovatění. Přidejte česnek a houby, osolte a opepřete. Restujte, dokud houby nezměknou a nepustí šťávu.
Vaření: Zalijte vývarem a vařte asi 20 minut.
Mixování: Polévku můžete částečně rozmixovat, aby měla krémovou konzistenci, ale stále obsahovala kousky hub. Přidejte smetanu a nechte krátce prohřát.

Krutony
Příprava: Nakrájejte chleba nebo bagetu na malé kostičky.
Restování: Na pánvi rozehřejte olivový olej nebo máslo, přidejte kostičky chleba a opékejte, dokud nejsou zlatavé a křupavé. Posypte česnekem nebo bylinkami podle chuti.

Servírování
Nalijte polévku do talíře, přidejte křupavé krutony a případně ozdobte nasekanou petrželkou.',
                'servings' => 4,
                'image' => 'houbaPolevka.jpg',
            ],
            [
                'name' => 'Chléb s krémovým volským okem a čerstvou pažitkou',
                'ingredients' => [
                    "1 krajíc chleba (ideálně kváskový nebo celozrnný)",
                    "1 vejce",
                    "1 lžička másla (nebo rostlinného oleje)",
                    "1 lžíce smetany na vaření (nebo mléka)",
                    "10 dkg slaniny",
                    "Špetka soli",
                    "Špetka mletého černého pepře",
                    "Čerstvá pažitka (nasekaná, asi 1 lžička)",
                ],
                'rating' => 0,
                'reviews' => 0,
                'allergens' => ['Lepek (pšenice, žito, ječmen, oves)', 'mléko', 'vejce'],
                'category_id' => $category4->id,
                'user_id' => $user1->id,
                'steps' => 'Příprava chleba:
Chléb lehce opečte na pánvi, v toustovači nebo v troubě, dokud nebude křupavý.
Příprava volského oka:
Na pánvi rozehřejte máslo na mírném plameni.
Rozklepněte vejce na pánev a nechte bílek ztuhnout, zatímco žloutek zůstane tekutý.
Jakmile je bílek skoro hotový, přidejte na pánev lžíci smetany, posypte vejce špetkou soli a pepře a zakryjte pánev pokličkou na cca 30 sekund, aby se smetana spojila s vejcem a vytvořila krémovou texturu.
Servírování:
Na opečený chléb položte volské oko, přelijte ho trochou smetanového sosu z pánve. Následně osmahněte slaninu a přidejte na chléb.
Posypte nasekanou čerstvou pažitkou a podávejte ihned.',
                'servings' => 1,
                'image' => 'chlebOko.jpg',
            ],
            [
                'name' => 'Chléb s máslem, sýrem a čerstvou pažitkou',
                'ingredients' => [
                    "Plátek čerstvého chleba (např. kváskový, celozrnný nebo bílý)",
                    "Máslo na namazání chleba (ideálně pokojové teploty)",
                    "Svazek čerstvé pažitky",
                    "Špetka soli (volitelné)",
                ],
                'rating' => 0,
                'reviews' => 0,
                'allergens' => ['Lepek (pšenice, žito, ječmen, oves)', 'mléko'],
                'category_id' => $category4->id,
                'user_id' => $user1->id,
                'steps' => 'Namazání chleba máslem: Máslo si nechte povolit na pokojovou teplotu, aby se snadno roztíralo. Každý plátek chleba potřete rovnoměrnou vrstvou másla.
Přidání sýra: Na máslo položte plátky sýra. Pokud máte sýr strouhaný, nasypte ho na chléb v rovnoměrné vrstvě.
Posypání pažitkou: Čerstvou pažitku opláchněte a osušte. Nasekejte ji nadrobno a posypte každý plátek chleba se sýrem.
Dochucení: Pokud chcete, můžete lehce osolit nebo opepřit, ale pažitka a sýr většinou ',
                'servings' => 1,
                'image' => 'chlebPazi.jpg',
            ],
            [
                'name' => 'Langoše',
                'ingredients' => [
                    "500 g hladké mouky",
                    "250 ml mléka (vlažného)",
                    "20 g čerstvého droždí (nebo 7 g sušeného – je i lepší variantou)",
                    "1 lžička cukru",
                    "1 lžička soli",
                    "2 lžíce oleje",
                    "100 ml vody (vlažné)",
                    "500 ml rostlinného oleje (např. slunečnicového)",
                    "100 g strouhaného sýra (eidam, gouda nebo jiný dle chuti)",
                    "kečup (dle chuti)",
                ],
                'rating' => 0,
                'reviews' => 0,
                'allergens' => ['Lepek (pšenice, žito, ječmen, oves)', 'mléko', 'vejce', 'sója'],
                'category_id' => $category1->id,
                'user_id' => $user1->id,
                'steps' => 'Příprava kvásku:
Do misky nalijte vlažné mléko, přidejte droždí a cukr. Promíchejte a nechte 10–15 minut vzejít kvásek (bublinky naznačí, že droždí pracuje).
Příprava těsta:
Do mísy prosejte mouku, přidejte sůl, olej a hotový kvásek. Postupně přilévejte vlažnou vodu a vypracujte hladké, nelepivé těsto.
Těsto přikryjte utěrkou a nechte kynout na teplém místě asi 1 hodinu, dokud zdvojnásobí svůj objem.
Tvarování a smažení langošů:
Vykynuté těsto rozdělte na 4 stejné části. Z každé vytvořte kuličku a nechte je ještě 10 minut odpočívat.
Poté kuličky těsta rukama vytvarujte do tvaru placky (o průměru cca 20 cm).
V pánvi rozehřejte olej. Každý langoš smažte dozlatova z obou stran (cca 1–2 minuty na každé straně). Poté je odložte na papírové utěrky, aby se odsál přebytečný olej.
Dochucení:
Horké langoše potřete kečupem a posypte strouhaným sýrem. Ihned podávejte.

Nevyužité těsto je možné skladovat v potravinářském sáčku v chladničce. Vydrží tak i několik dní.',
                'servings' => 4,
                'image' => 'langose.png',
            ],
            [
                'name' => 'Míchaná vajíčka s čerstvou zeleninou a křupavým pečivem',
                'ingredients' => [
                    "4 vejce",
                    "50 ml mléka (nebo smetany, dle preference)",
                    "1 lžíce másla (nebo rostlinného oleje)",
                    "Špetka soli",
                    "Špetka mletého černého pepře",
                    "1 rajče (nakrájené na plátky)",
                    "1/2 okurky (nakrájené na kolečka)",
                    "1/2 červené papriky (nakrájené na proužky)",
                    "2 listy salátu (např. ledový nebo římský)",
                    "2 plátky křupavého pečiva (bageta, chléb nebo toast)",
                    "Máslo na potření pečiva (volitelné)",
                ],
                'rating' => 0,
                'reviews' => 0,
                'allergens' => ['Lepek (pšenice, žito, ječmen, oves)', 'mléko', 'vejce'],
                'category_id' => $category1->id,
                'user_id' => $user1->id,
                'steps' => 'Příprava zeleniny a pečiva:
Nakrájejte rajče, okurku a papriku. Opláchněte a osušte salátové listy.
Pečivo můžete opéct na sucho v toustovači, troubě nebo na pánvi, dokud není křupavé. Chcete-li, potřete ho máslem.
Příprava míchaných vajíček:
Do misky rozklepněte vejce, přidejte mléko, sůl a pepř. Směs dobře prošlehejte vidličkou nebo metličkou.
Na pánvi rozehřejte máslo na středním plameni. Jakmile je máslo rozpuštěné, vlijte vaječnou směs.
Pomalu míchejte dřevěnou nebo silikonovou stěrkou, dokud vejce nezačnou houstnout. Odstavte z ohně těsně předtím, než jsou úplně hotová, protože teplo v pánvi je ještě trochu dotáhne. (nikdo nechce spálená míchaná vajíčka)
Servírování:
Na talíř naaranžujte míchaná vajíčka, přidejte čerstvou zeleninu a křupavé pečivo. Podávejte ihned.',
                'servings' => 2,
                'image' => 'vajicka.png',
            ],
        ];


        foreach ($recipes as $data) {
            $recipe = Recipe::create([
                'name' => $data['name'],
                'ingredients' => $data['ingredients'],
                'rating' => $data['rating'],
                'reviews' => $data['reviews'],
                'category_id' => $data['category_id'],
                'user_id' => $data['user_id'],
                'steps' => $data['steps'],
                'servings' => $data['servings'],
                'image' => $data['image'],
            ]);

            if (!empty($data['allergens'])) {
                $allergenIds = Allergen::whereIn('name', $data['allergens'])->pluck('id');
                if ($allergenIds->isNotEmpty()) {
                    $recipe->allergens()->attach($allergenIds);
                } else {
                    $this->command->info("No valid allergens found for recipe: {$data['name']}");
                }
            }
        }
    }
}
