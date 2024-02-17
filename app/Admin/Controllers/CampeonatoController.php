<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use OpenAdmin\Admin\Widgets\Table;
use \App\Models\Campeonato;
use App\Admin\Actions\ViewZonas;

class CampeonatoController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Campeonato';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Campeonato());

        $grid->disableRowSelector();

        $grid->actions(function ($actions) {
            $actions->add(new ViewZonas());
        });
                

        //$grid->column('id', __('Id'));
        $grid->column('nombre', __('Nombre'))->width(200);
        $grid->column('anio', __('Año'))->width(200);
        $grid->column('descripcion', __('Descripcion'))->width(200);

        //$grid->column('created_at', __('Created at'));
        //$grid->column('updated_at', __('Updated at'));

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
        $show = new Show(Campeonato::findOrFail($id));

        //$show->field('id', __('Id'));
        $show->field('nombre', __('Nombre'));
        $show->field('anio', __('Anio'));
        $show->field('descripcion', __('Descripcion'));
        //$show->field('created_at', __('Created at'));
        //$show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Campeonato());

        $form->text('nombre', __('Nombre'));
        $form->date('anio', __('Año'))->default(date('d-m-Y'));
        //$form->text('descripcion', __('Descripcion'));
        $form->textarea('descripcion','Descripcion')->rows(10);

        return $form;
    }
}
