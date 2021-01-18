<?php

namespace App\Admin\Controllers;

use App\Product;
use App\Category;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use \Illuminate\Support\Str;

class ProductController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Product';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Product());
        $grid->disableExport();
        $grid->quickSearch('name');

        $grid->filter(function($filter){
            // Remove the default id filter
            $filter->disableIdFilter();
            // Add a column filter
            $filter->in('category_id', __('Category'))->multipleSelect([
                '1' => ' Laptops', '2' => 'Desktops', '3' => 'Mobile Phones',
                '4' => 'Tablets',  '5' => ' TVs', '6' => 'Cameras', '7' => 'Headphones'
            ]);

            $filter->between('price')->default(0, 100000000);
        });




        $grid->column('id', __('Id'))->sortable();
        $grid->column('name', __('Name'));
        $grid->column('slug', __('Slug'))->hide();
        $grid->column('detales', __('Detales'))->limit(20);
        $grid->column('price', __('Price'))->sortable();
        $grid->column('image', __('Image'));
        $grid->column('description', __('Description'))->display(function($description) {
            return Str::limit($description, 30, '...');
        });
        $grid->column('created_at', __('Created at'))->hide();
        $grid->column('updated_at', __('Updated at'))->hide();

        $grid->category()->name();

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
        $show = new Show(Product::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('slug', __('Slug'));
        $show->field('detales', __('Detales'));
        $show->field('price', __('Price'));
        $show->field('image', __('Image'));
        $show->field('description', __('Description'));
        $show->field('category_id', __('Category ID'));
        $show->category()->pluck('name');
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
        $form = new Form(new Product());

        $form->text('name', __('Name'));
        $form->text('slug', __('Slug'));
        $form->text('detales', __('Detales'));
        $form->number('price', __('Price'));
        $form->image('image', __('Image'));
        $form->text('description', __('Description'));
        $form->number('category_id', __('Category ID'));

        return $form;
    }
}
