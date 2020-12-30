<?php

use Illuminate\Database\Seeder;

class AcountTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('acounts')->insert([
            [
                'user_id' => '30',
                'gender' => '男性',
                'age' => '26',
                'profile' => 'アジアを彷徨うバックパッカーです。旅、アジア全般(イスラム圏、チベット圏、ヒンドゥ圏が特に好き)、アジアの屋台、野球(スワローズ、ファイターズ)、欅坂46の世界観とパフォーマンスに衝撃を受ける。',
                'hobby' => '映画鑑賞、アジアの屋台巡り',
                'icon' => '1608636526.images-1.jpg'
            ],
            [
                'user_id' => '31',
                'gender' => '男性',
                'age' => '32',
                'profile' => '2011年、海外放浪中に貯金が尽きたのでブラジルにて路上起業。以来、ブラジル中を行商して周っている。好きなときに、好きな場所で、自分のもっとも適したスタイルで。そんなマインドを軸に、気ままな海外田舎生活を満喫中.',
                'hobby' => 'サンバ、ハーモニカ',
                'icon' => 'images-2.jpg'
            ],
            [
                'user_id' => '32',
                'gender' => '男性',
                'age' => '43',
                'profile' => 'バックパック or 自転車のキャンパーです_(:3 」∠)_なので、軽量化しつつ、私なりのスタイルを追い求めて行きます♫',
                'hobby' => 'サイクリング、アウトドア',
                'icon' => 'images-1.jpg'
            ],
            [
                'user_id' => '33',
                'gender' => '女性',
                'age' => '23',
                'profile' => '洋画・洋楽・EDM・ラーメンが好き /大学3年生になってウェブ制作に出会い遅めのスタートダッシュ！常に新しいことに挑戦',
                'hobby' => '洋画・洋楽・EDM',
                'icon' => 'saren.jpg'
            ],
            [
                'user_id' => '34',
                'gender' => '女性',
                'age' => '24',
                'profile' => '世界一周バックパッカーで
                大体の国は1人でまわりましたよ‼︎
                (挑戦することが好きな方)',
                'hobby' => 'サーフィン、ショッピング',
                'icon' => 'o0386045014284708929.jpg'
            ],
            [
                'user_id' => '35',
                'gender' => '女性',
                'age' => '29',
                'profile' => '元イギリス・ロンドン在住イギリス国旗/『おしゃれで映える、週末女子一人旅』を毎週末にYouTubeへ投稿中！/旅行/海外在住/WACKとCUBERSのヲタクとしても生きています',
                'hobby' => 'アニメ',
                'icon' => '1608634921.images.jpg'
            ],
            [
                'user_id' => '36',
                'gender' => '女性',
                'age' => '34',
                'profile' => 'ヨーロッパとアフリカ地域世界一周×2回、50ヵ国以上旅しました✈。現在、旅の仕事&ライターメインのフリーランス。ブランド立ち上げも挑戦中',
                'hobby' => '旅,ライター',
                'icon' => 'images.jpg'
            ],
        ]);
    }
}
