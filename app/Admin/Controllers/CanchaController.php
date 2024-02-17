<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\Cancha;

class CanchaController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Canchas';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Cancha());

        $grid->disableRowSelector();

        //$grid->column('id', __('Id'));
        $grid->column('nombre', __('Nombre'));
        $grid->column('domicilio', __('Domicilio'));        
        $grid->column('imagen')->image('', 75, 75);
        $grid->column('descripcion', __('Descripcion'));
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
        $show = new Show(Cancha::findOrFail($id));

        //$show->field('id', __('Id'));
        $show->field('nombre', __('Nombre: '));
        $show->field('domicilio', __('Domicilio: '));        
        $show->field("imagen", "Imagen: ")->image($base_url = '', $width = 640, $height = 333);
        $show->field('descripcion', __('Descripcion: '));
        

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Cancha());

        $form->text('nombre', __('Nombre'))->rules('required')->placeholder('Nombre de la cancha');
        $form->text('domicilio', __('Domicilio'))->rules('required')->placeholder('Domicilio postal');
        $form->image('imagen', __('Imagen'))->rules('required')->placeholder('Ingrese una fotografia de la canha');
        $form->text('descripcion', __('Descripcion'));

        return $form;
    }
}
