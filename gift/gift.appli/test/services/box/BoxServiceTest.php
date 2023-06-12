<?php
declare(strict_types=1);


namespace gift\test\services\box;

use gift\app\models\Box;
use gift\app\models\Prestation;
use gift\app\services\box\BoxService;
use Illuminate\Database\Capsule\Manager as DB;
use PHPUnit\Framework\TestCase;

final class BoxServiceTest extends TestCase
{

    private static array $prestations = [];
    private static array $boxs = [];

    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        $db = new DB();
        $db->addConnection(parse_ini_file(__DIR__ . '/../../../src/conf/gift.db.tests.ini'));
        $db->setAsGlobal();
        $db->bootEloquent();
        $faker = \Faker\Factory::create('fr_FR');

        $box1 = Box::create([
            'id' => $faker->uuid(),
            'libelle' => $faker->word(),
            'description' => $faker->paragraph(3),

        ]);

        $box2 = Box::create([
            'id' => $faker->uuid(),
            'libelle' => $faker->word(),
            'description' => $faker->paragraph(3),

        ]);
        self::$boxs = [$box1, $box2];

        $presta1 = Prestation::create([
            'id' => $faker->uuid(),
            'libelle' => $faker->word(),
            'description' => $faker->paragraph(3),
            'tarif' => $faker->randomFloat(2, 20, 200),
            'unite' => $faker->numberBetween(1, 3)
        ]);

        $presta2 = Prestation::create([
            'id' => $faker->uuid(),
            'libelle' => $faker->word(),
            'description' => $faker->paragraph(3),
            'tarif' => $faker->randomFloat(2, 20, 200),
            'unite' => $faker->numberBetween(1, 3)
        ]);
        self::$prestations = [$presta1, $presta2];


    }

    public static function tearDownAfterClass(): void
    {
        foreach (self::$boxs as $box) {
            $box->detach();
            $box->delete();

        }
        foreach (self::$prestations as $prestation) {
            $prestation->delete();

        }

    }

    public function testgetBoxes(): void
    {
        $boxService = new BoxService();
        $boxs = $boxService->getBoxes();

        $this->assertSameSize(self::$boxs, $boxs);
        $this->assertEquals(self::$boxs[0]->id, $boxs[0]['id']);
        $this->assertEquals(self::$boxs[0]->libelle, $boxs[0]['libelle']);
        $this->assertEquals(self::$boxs[0]->description, $boxs[0]['description']);
        $this->assertEquals(self::$boxs[1]->id, $boxs[1]['id']);
        $this->assertEquals(self::$boxs[1]->libelle, $boxs[1]['libelle']);
        $this->assertEquals(self::$boxs[1]->description, $boxs[1]['description']);

    }


    public function testaddBox(): void
    {
        $boxService = new BoxService();
        $data = [
            'libelle' => 'test ',
            'description' => 'descriptionadzs',
            'kdo' => 1,
            'message_kdo' => 'test',
        ];
        $boxID = $boxService->addBox($data);
        $box = $boxService->getBoxById($boxID);
        self::$boxs[] = $box;

        $this->assertEquals($box['montant'], 0);
        $this->assertEquals($box['statut'], Box::CREATED);

    }


    public function testgetBoxById() : void
    {
        $boxService = new BoxService();
        $box = $boxService->getBoxById(self::$boxs[0]->id);

        $this->assertEquals(self::$boxs[0]->id, $box['id']);
        $this->assertEquals(self::$boxs[0]->libelle, $box['libelle']);
    }

    public function testaddPrestaToBox() : void
    {
        $boxService = new BoxService();
        $boxService->addPrestaToBox(self::$prestations[0]->id, self::$boxs[0]->id, 2);
        $box = $boxService->getBoxById(self::$boxs[0]->id);

        $this->assertEquals(self::$prestations[0]->tarif * 2, $box['montant']);
    }
}