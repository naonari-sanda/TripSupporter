<?php

namespace App\Admin\Controllers;

use App\Models\Review;
use App\Models\Country;
use App\Models\User;

use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ReviewController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Review';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Review());

        $grid->column('id', __('Id'));
        $grid->column('user.name', __('ユーザー'));
        $grid->column('country.name', __('国名'));
        $grid->column('recommend', __('Recommend'));
        $grid->column('safe', __('Safe'));
        $grid->column('cost', __('Cost'));
        $grid->column('fun', __('Fun'));
        $grid->column('tourism', __('Tourism'));
        $grid->column('food', __('Food'));
        $grid->column('english', __('English'));
        $grid->column('city', __('City'));
        $grid->column('review', __('Review'));
        $grid->column('imgpath', __('Imgpath'));
        // $grid->column('created_at', __('Created at'));
        // $grid->column('updated_at', __('Updated at'));


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
        $show = new Show(Review::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('user.name', __('ユーザー'));
        $show->field('country.name', __('国名'));
        $show->field('recommend', __('Recommend'));
        $show->field('safe', __('Safe'));
        $show->field('cost', __('Cost'));
        $show->field('fun', __('Fun'));
        $show->field('tourism', __('Tourism'));
        $show->field('food', __('Food'));
        $show->field('english', __('English'));
        $show->field('city', __('City'));
        $show->field('review', __('Review'));
        $show->field('imgpath', __('Imgpath'));
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
        $form = new Form(new Review());

        $form->text('user.name', __('ユーザー'));
        $form->text('country.name', __('国名'));
        $form->decimal('recommend', __('Recommend'));
        $form->number('safe', __('Safe'));
        $form->number('cost', __('Cost'));
        $form->number('fun', __('Fun'));
        $form->number('tourism', __('Tourism'));
        $form->number('food', __('Food'));
        $form->number('english', __('English'));
        $form->text('city', __('City'));
        $form->text('review', __('Review'));
        $form->image('imgpath', __('Imgpath'));

        return $form;
    }
}
