<?php

namespace App\Admin\Controllers;

use App\Models\Acount;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class AcountController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Acount';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Acount());

        $grid->column('id', __('Id'));
        $grid->column('user_id', __('User id'));
        $grid->column('gender', __('Gender'));
        $grid->column('age', __('Age'));
        $grid->column('profile', __('Profile'));
        $grid->column('hobby', __('Hobby'));
        $grid->column('icon', __('Icon'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

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
        $show = new Show(Acount::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('user_id', __('User id'));
        $show->field('gender', __('Gender'));
        $show->field('age', __('Age'));
        $show->field('profile', __('Profile'));
        $show->field('hobby', __('Hobby'));
        $show->field('icon', __('Icon'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Acount());

        $form->number('user_id', __('User id'));
        $form->text('gender', __('Gender'));
        $form->text('age', __('Age'));
        $form->text('profile', __('Profile'));
        $form->text('hobby', __('Hobby'));
        $form->image('icon', __('Icon'));

        return $form;
    }
}
