<?php

namespace App\Admin\Controllers;

use App\Models\Order;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class OrderController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Order';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Order());

        $grid->column('id', __('Id'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->column('size', __('Size'));
        $grid->column('quantity', __('Quantity'));
        $grid->column('item_name', __('Item name'));
        $grid->column('price', __('Price'));
        $grid->column('customer_id', __('Customer id'));

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
        $show = new Show(Order::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('size', __('Size'));
        $show->field('quantity', __('Quantity'));
        $show->field('item_name', __('Item name'));
        $show->field('price', __('Price'));
        $show->field('customer_id', __('Customer id'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Order());

        $form->text('size', __('Size'));
        $form->number('quantity', __('Quantity'));
        $form->text('item_name', __('Item name'));
        $form->decimal('price', __('Price'));
        $form->number('customer_id', __('Customer id'));

        return $form;
    }
}
