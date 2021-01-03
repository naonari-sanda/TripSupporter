<?php

namespace App\Admin\Controllers;

use App\Models\User;
use App\Models\Acount;
use App\Models\Review;
use App\Models\Image;
use App\Models\like;
use App\Models\Country;

use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class UserController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\Models\User';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new User());

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('email', __('Email'));
        // $grid->column('email_verified_at', __('Email verified at'));
        // $grid->column('password', __('Password'));
        // $grid->column('remember_token', __('Remember token'));
        // $grid->column('created_at', __('Created at'));
        // $grid->column('updated_at', __('Updated at'));
        // $grid->column('acount.user_id',  __('user_id'));
        $grid->column('acount.gender',  __('Gender'));
        $grid->column('acount.age',  __('Age'));
        $grid->column('acount.hobby',  __('Hobby'));
        $grid->column('acount.profile',  __('Profile'));
        $grid->column('acount.icon',  __('Icon'));

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
        $show = new Show(User::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('email', __('Email'));

        $show->acount('アカウント', function ($acount) {
            $acount->user_id();
            $acount->age();
            $acount->gender();
            $acount->hobby();
            $acount->profile();
            $acount->age();
            $acount->icon();
        });


        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new User());

        $form->tab('ユーザー', function ($form) {
            $form->text('name', __('Name'));
            $form->email('email', __('Email'));
            $form->text('acount.gender',  __('Gender'));
            $form->text('acount.age',  __('Age'));
            $form->text('acount.hobby',  __('Hobby'));
            $form->text('acount.profile',  __('Profile'));
            $form->text('acount.icon',   __('Icon'));
        })->tab('アカウント', function ($form) {
            $form->text('gender', __('Gender'));
            $form->text('age', __('Age'));
            $form->text('profile', __('Profile'));
            $form->text('hobby', __('Hobby'));
            $form->image('icon', __('Icon'));
        })->tab('レビュー', function ($form) {
            $form->hasMany('reviews', 'REVIEW', function (Form\NestedForm $nestedForm) {
                $nestedForm->number('country_d', __('Country_ID'));
                $nestedForm->decimal('recommend', __('Recommend'));
                $nestedForm->number('safe', __('Safe'));
                $nestedForm->number('cost', __('Cost'));
                $nestedForm->number('fun', __('Fun'));
                $nestedForm->number('tourism', __('Tourism'));
                $nestedForm->number('food', __('Food'));
                $nestedForm->number('english', __('English'));
                $nestedForm->text('city', __('City'));
                $nestedForm->text('review', __('Review'));
                $nestedForm->phot('imgpath', __('Imgpat'));
            })->useTab();
        })->tab('いいね', function ($form) {
            $form->hasMany('likes', 'Likes', function (Form\NestedForm $nestedForm) {
                $nestedForm->number('country_id', __('Country_ID'));
            });
        })->tab('画像', function ($form) {
            $form->hasMany('images', 'Image', function (Form\NestedForm $nestedForm) {
                $nestedForm->number('country_id', __('Country id'));
                $nestedForm->image('imgpath', __('Imgpath'));
            });
        });


        return $form;
    }
}
