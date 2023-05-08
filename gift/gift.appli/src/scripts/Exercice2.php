<?php

require_once '../vendor/autoload.php';
use Illuminate\Database\Capsule\Manager as DB;

$PHP_EOL = "<br>";

$db = new DB();
$db->addConnection(parse_ini_file('../conf/gift.db.conf.ini.dist'));
$db->setAsGlobal();
$db->bootEloquent();



echo "Question 1". $PHP_EOL ;
$prestations = \gift\app\models\Prestation::get();
foreach ($prestations as $prestation) {
    echo $prestation->libelle . ', ' . $prestation->description . ', ' . $prestation->tarif . ', ' . $prestation->unite . $PHP_EOL ;
}

echo $PHP_EOL;

echo "Question 2 :" . $PHP_EOL ;
foreach (\gift\app\models\Prestation::with('categorie')->get() as $prestation) {
    echo $prestation->libelle . "{$prestation->categorie->libelle}" . $PHP_EOL ;
    echo $prestation->description . $PHP_EOL;
}
echo $PHP_EOL . $PHP_EOL;

echo "Question 3 :" . $PHP_EOL ;

$categorie3 = \gift\app\models\Categorie::find(3);
echo $categorie3->libelle . $PHP_EOL;

$prestation_cat3 = $categorie3->prestations()->get();
foreach ($prestation_cat3 as $presta){
    echo $presta->libelle . ', ' . $presta->tarif . ', ' . $presta->unite . $PHP_EOL;
};

echo $PHP_EOL;

echo "Question 4" . $PHP_EOL;
$box = \gift\app\models\Box::where('id', '360bb4cc-e092-3f00-9eae-774053730cb2')->first();
echo $box->libelle . ', ' . $box->description . ', ' . $box->montant . $PHP_EOL ;

echo $PHP_EOL;



// qunatite ne fonctionne pas et impossible de faire $box->prestations
echo "Question 5" . $PHP_EOL;
$box = \gift\app\models\Box::with('prestations')
    ->where('id', '360bb4cc-e092-3f00-9eae-774053730cb2')
    ->first();
echo $box->libelle . ', ' . $box->description . ', ' . $box->montant . $PHP_EOL ;

$prestations_box = $box->prestations()->get();
foreach ($prestations_box as $presta_box){
    echo $presta_box->libelle . ', ' . $presta_box->tarif . ', ' . $presta_box->unite . ', ' . $presta_box->quantite . $PHP_EOL;
}

echo $PHP_EOL;


//ne me trouve pas le Uuid et donc la box 6 n'est pas chargé
echo "question 6" . $PHP_EOL;

$box = new \gift\app\models\Box();
$box->id = Uuid::uuid4()->toString();
$box->libelle = 'box 6';
$box->token = base64_encode(random_bytes(32));
$box->description = 'description box 6';
$box->save();


$box->prestations()->attach([
    '4cca8b8e-0244-499b-8247-d217a4bc542d' => ['quantite' => 2],
    '14872d96-97d6-4a9f-8a28-463886fea622' => ['quantite' => 4],
    '63cdce06-cd63-4fbe-9695-885d3cb64c7b' => ['quantite' => 3],
]);