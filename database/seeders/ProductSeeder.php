<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'name'=>'Samsung Galaxy S23 Ultra',
                "price"=>"295000",
                "description"=>"The Galaxy S23 Ultra is unapologetically big, with a 6.8-inch screen. If the Samsung S22 Ultra was the ultimate evolution of a slab-style smartphone,",
                "category"=>"Mobile",
                "gallery"=>"https://www.ideabeam.com/images/product/big/samsung-galaxy-s23-ultra.jpg"
            ],
            [
                'name'=>'iPhone 14 Pro Max',
                "price"=>"384990",
                "description"=>"Device dimensions are 77.6 × 160.7 × 7.9 millimeters (3.06 × 6.33 × 0.31 inches). The device weighs 240 g. iPhone 14 Pro Max has a large-sized LTPO Super Retina XDR OLED display.",
                "category"=>"Mobile",
                "gallery"=>"https://m.media-amazon.com/images/I/71T5NVOgbpL._AC_UF1000,1000_QL80_.jpg"
            ],
            [
                'name'=>'Panasonic 32 Inch LED TV',
                "price"=>"75700",
                "description"=>"Display Resolution, 1366 x 768 ; Viewing Angle, AccuView Display Strong Panel With Wide Viewing Angle ; Brightness, Vivid Digital Pro ; Noise Reduction, Yes.",
                "category"=>"Tv",
                "gallery"=>"https://www.jungle.lk/wp-content/uploads/2021/07/Panasonic-32-Inch-HD-LED-TV-TH-32J401N.jpg"
            ],
            [
                'name'=>'LG 308L Refrigerator',
                "price"=>"151990",
                "description"=>"LG Door Cooling+™ makes inside temperature more even and cools the refrigerator 35% faster than the conventional cooling system. ",
                "category"=>"Refrigerator",
                "gallery"=>"https://www.lg.com/lk/images/refrigerators/md07528515/gallery/gl-m332rpzi-Refrigerators-Front-View-MZ-01.jpg"
            ],
            [
                'name'=>'ASEL 50L Electrical Oven',
                "price"=>"45990",
                "description"=>"50L Capacity. 1500W power, Adjustable temperature control. Capacity : 4kg. 90 min timer with automatic shut off",
                "category"=>"Oven",
                "gallery"=>"https://d1nrmmyttbe8ey.cloudfront.net/media/upload/product/Electric%20oven/ASOVAF5023/1.jpg?1622435094147"
            ],
            [
                'name'=>'Singer Air Fryer',
                "price"=>"28674",
                "description"=>" Kg / 3.5L Capacity 1500W Warranty: 1 Year Rapid Air Convection Technology, Little Oil Required Or In Some Cases No Oil (Oil-Less Fryer) 60 Minute Manual Timer, Auto Shut-Off.",
                "category"=>"Oven",
                "gallery"=>"https://asianlanka.lk/wp-content/uploads/2022/12/SIN_KA-TXG-DS11A-01_zoom.jpg"
            ]
        ]);
    }
}
