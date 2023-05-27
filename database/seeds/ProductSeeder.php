<?php

namespace Database\Seeders;

use App\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('ALTER TABLE achats MODIFY ordonnance MEDIUMBLOB;'
        );

        DB::statement('ALTER TABLE products MODIFY image MEDIUMBLOB;'
        );

        Product::create([

            'nom' => 'Paclitaxel',
            'category' => 'MEDICAMENT',
            'image' =>  file_get_contents( "public/assets/images/paclitaxel.jpg" ),
            'quantite'=>'20'
        ]);

        Product::create([

            'nom' => 'Sutent',
            'category' => 'MEDICAMENT',
            'image' =>  file_get_contents( "public/assets/images/sutent.jpg" ),
            'quantite'=>'15'
        ]);

        Product::create([

            'nom' => 'Avastin',
            'category' => 'MEDICAMENT',
            'image' =>  file_get_contents( "public/assets/images/avastin.jpg" ),
            'quantite'=>'8'
        ]);

        Product::create([

            'nom' => 'Alpharadin',
            'category' => 'MEDICAMENT',
            'image' =>  file_get_contents( "public/assets/images/med4.jpg" ),
            'quantite'=>'14'
        ]);

        Product::create([

            'nom' => 'Perjeta',
            'category' => 'MEDICAMENT',
            'image' =>  file_get_contents( "public/assets/images/med5.jpg" ),
            'quantite'=>'17'
        ]);

        Product::create([

            'nom' => 'Avastin',
            'category' => 'MEDICAMENT',
            'image' =>  file_get_contents( "public/assets/images/med6.jpg" ),
            'quantite'=>'12'
        ]);

        Product::create([

            'nom' => 'BCG-MEDAC',
            'category' => 'MEDICAMENT',
            'image' =>  file_get_contents( "public/assets/images/med7.jpg" ),
            'quantite'=>'30'
        ]);

        Product::create( [

            'nom'=>'Herceptin',
            'category'=>'MEDICAMENT',
            'image'=> file_get_contents( "public/assets/images/med8.jpg" ),
            'quantite'=>'22'
        ] );


        Product::create( [

            'nom'=>'Libyato',
            'category'=>'MEDICAMENT',
            'image'=> file_get_contents( "public/assets/images/med9.jpg" ),
            'quantite'=>'21'
        ] );

        Product::create( [

            'nom'=>'chaise roulante',
            'category'=>'CHAISE_ROULENT',
            'image'=>file_get_contents( "public/assets/images/chaise1.jpg" ),
            'quantite'=>'18'
        ] );

        Product::create( [

            'nom'=>'béquilles pour le fauteuil',
            'category'=>'CHAISE_ROULENT',
            'image'=> file_get_contents( "public/assets/images/chaise2.jpg" ),
            'quantite'=>'20'
        ] );

        Product::create( [

            'nom'=>'béquilles',
            'category'=>'CHAISE_ROULENT',
            'image'=> file_get_contents( "public/assets/images/chaise3.jpg" ),
            'quantite'=>'10'
        ] );


        Product::create( [

            'nom'=>'Chaise Roulant Electronic',
            'category'=>'CHAISE_ROULENT',
            'image'=>file_get_contents( "public/assets/images/chaise4.jpg" ),
            'quantite'=>'16'
        ] );

        Product::create( [

            'nom'=>'Un béquille',
            'category'=>'CHAISE_ROULENT',
            'image'=>file_get_contents( "public/assets/images/chaise5.jpg" ),
            'quantite'=>'12'
        ] );

        Product::create( [

            'nom'=>'Béquille Mains',
            'category'=>'CHAISE_ROULENT',
            'image'=>file_get_contents( "public/assets/images/chaise6.jpg" ),
            'quantite'=>'15'
        ] );

        Product::create( [

            'nom'=>'Cannes de Bequilles',
            'category'=>'CHAISE_ROULENT',
            'image'=>file_get_contents( "public/assets/images/chaise7.jpg" ),
            'quantite'=>'20'
        ] );

        Product::create( [

            'nom'=>'Laide de Déplacent',
            'category'=>'CHAISE_ROULENT',
            'image'=>file_get_contents( "public/assets/images/chaise8.jpg" ),
            'quantite'=>'40'
        ] );

        Product::create( [

            'nom'=>'Chaise Roulant',
            'category'=>'CHAISE_ROULENT',
            'image'=>file_get_contents( "public/assets/images/chaise9.jpg" ),
            'quantite'=>'25'
        ] );

        Product::create( [

            'nom'=>'Les Tensiomètre',
            'category'=>'EQUIPEMENT_MEDICO',
            'image'=>file_get_contents( "public/assets/images/thr1.jpg" ),
            'quantite'=>'20'
        ] );

        Product::create( [

            'nom'=>'Moniteur de glycémie',
            'category'=>'EQUIPEMENT_MEDICO',
            'image'=>file_get_contents( "public/assets/images/thr2.jpg" ),
            'quantite'=>'25'
        ] );

        Product::create( [

            'nom'=>'Thermomètre',
            'category'=>'EQUIPEMENT_MEDICO',
            'image'=>file_get_contents( "public/assets/images/thr3.jpg" ),
            'quantite'=>'30'
        ] );



        Product::create( [

            'nom'=>'Appareil Doxygène',
            'category'=>'EQUIPEMENT_MEDICO',
            'image'=>file_get_contents( "public/assets/images/thr4.jpg" ),
            'quantite'=>'26'
        ] );

        Product::create( [

            'nom'=>'Appariel Respiratoire',
            'category'=>'EQUIPEMENT_MEDICO',
            'image'=>file_get_contents( "public/assets/images/thr5.jpg" ),
            'quantite'=>'45'
        ] );

        Product::create( [

            'nom'=>'Appariel De Mesure Doxygéne',
            'category'=>'EQUIPEMENT_MEDICO',
            'image'=>file_get_contents( "public/assets/images/thr6.jpg" ),
            'quantite'=>'25'
        ] );

        Product::create( [

            'nom'=>'Appariel Respiratoire',
            'category'=>'EQUIPEMENT_MEDICO',
            'image'=>file_get_contents( "public/assets/images/thr7.jpg" ),
            'quantite'=>'23'
        ] );

        Product::create( [

            'nom'=>'Appariel D\'oxygéne',
            'category'=>'EQUIPEMENT_MEDICO',
            'image'=>file_get_contents( "public/assets/images/thr8.jpg" ),
            'quantite'=>'20'
        ] );

        Product::create( [

            'nom'=>'Appareil D\'attention',
            'category'=>'EQUIPEMENT_MEDICO',
            'image'=>file_get_contents( "public/assets/images/thr9.jpg" ),
            'quantite'=>'25'
        ] );



    }
}
