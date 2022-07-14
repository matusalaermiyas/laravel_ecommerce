<?php

namespace App\Admin\Controllers;

use App\Models\Customer;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class CustomerController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Customer';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Customer());

        $grid->quickSearch('customer_name');

        $grid->column('id', __('Id'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->column('customer_name', __('Customer name'));
        $grid->column('phone', __('Phone'));
        $grid->column('region', __('Region'));
        $grid->column('kebele', __('Kebele'));
        $grid->column('delivered', __('Delivered'));
        $grid->column('payed', __('Payed'))->filter();

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
        $show = new Show(Customer::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('customer_name', __('Customer name'));
        $show->field('phone', __('Phone'));
        $show->field('region', __('Region'));
        $show->field('kebele', __('Kebele'));
        $show->field('delivered', __('Delivered'));
        $show->field('payed', __('Payed'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Customer());

        $form->text('customer_name', __('Customer name'));
        $form->mobile('phone', __('Phone'));
        $form->text('region', __('Region'));
        $form->text('kebele', __('Kebele'));
        $form->text('delivered', __('Delivered'));
        $form->switch('payed', __('Payed'));

        return $form;
    }
}
