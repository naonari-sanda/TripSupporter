<?php

namespace App\Admin\Controllers;

use App\Models\Country;
use App\Models\Review;
use App\Models\Like;
use App\Models\Image;

use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class CountryControler extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Country';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Country());

        // $grid->column('id', __('Id'));
        // $grid->column('name', __('Name'));
        // $grid->column('imgpath', __('Imgpath'));
        // $grid->column('area', __('Area'));
        // $grid->column('population', __('Population'));
        // $grid->column('capital', __('Capital'));
        // $grid->column('language', __('Language'));
        // $grid->column('religion', __('Religion'));
        // $grid->column('gdp', __('Gdp'));
        // $grid->column('happiness', __('Happiness'));
        // $grid->column('map', __('Map'));
        // $grid->column('covid', __('Covid'));
        // $grid->column('detail', __('Detail'));
        // $grid->column('comment', __('Comment'));
        // // $grid->column('created_at', __('Created at'));
        // // $grid->column('updated_at', __('Updated at'));
        // $grid->column('reviews.reviews', __('Review'));
        $grid->id('id');
        $grid->name('name');
        $grid->imgpath('Imgpath');
        $grid->area('Area');
        $grid->population('Population');
        $grid->capital('Capital');
        $grid->language('Language');
        $grid->religion('Religion');
        $grid->gdp('Gdp');
        $grid->happiness('Happiness');
        $grid->map('Map');
        $grid->covid('Covid');
        $grid->detail('Detail');
        $grid->comment('Comment');

        $grid->reviews('レビュー数')->pluck('id')->label();
        $grid->likes('いいね数')->pluck('id')->label();
        $grid->images('画像数')->pluck('id')->label();
        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Country::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('imgpath', __('Imgpath'));
        $show->field('area', __('Area'));
        $show->field('population', __('Population'));
        $show->field('capital', __('Capital'));
        $show->field('language', __('Language'));
        $show->field('religion', __('Religion'));
        $show->field('gdp', __('Gdp'));
        $show->field('happiness', __('Happiness'));
        $show->field('map', __('Map'));
        $show->field('covid', __('Covid'));
        $show->field('detail', __('Detail'));
        $show->field('comment', __('Comment'));
        // $show->field('created_at', __('Created at'));
        // $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Country());

        $form->tab('国詳細', function ($form) {
            $form->text('name', __('Name'));
            $form->text('imgpath', __('Imgpath'));
            $form->number('area', __('Area'));
            $form->number('population', __('Population'));
            $form->text('capital', __('Capital'));
            $form->text('language', __('Language'));
            $form->text('religion', __('Religion'));
            $form->number('gdp', __('Gdp'));
            $form->number('happiness', __('Happiness'));
            $form->text('map', __('Map'));
            $form->text('covid', __('Covid'));
            $form->text('detail', __('Detail'));
            $form->text('comment', __('Comment'));
        })->tab('レビュー', function ($form) {
            $form->hasMany('reviews', 'REVIEW', function (Form\NestedForm $nestedForm) {
                $nestedForm->number('user_id', __('ユーザーID'));
                $nestedForm->decimal('recommend', __('Recommend'));
                $nestedForm->number('safe', __('Safe'));
                $nestedForm->number('cost', __('Cost'));
                $nestedForm->number('fun', __('Fun'));
                $nestedForm->number('tourism', __('Tourism'));
                $nestedForm->number('food', __('Food'));
                $nestedForm->number('english', __('English'));
                $nestedForm->text('city', __('City'));
                $nestedForm->text('review', __('Review'));
                $nestedForm->image('imgpath', __('Imgpat'));
            });
        })->tab('いいね', function ($form) {
            $form->hasMany('likes', 'Likes', function (Form\NestedForm $nestedForm) {
                $nestedForm->number('user_id', __('User id'));
            });
        });



        return $form;
    }
}
