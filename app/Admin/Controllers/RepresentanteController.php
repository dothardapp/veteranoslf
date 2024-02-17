<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\Representante;
use \App\Models\Equipo;

class RepresentanteController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Representantes';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Representante());

        //$grid->column('id', __('Id'));
        $grid->column('dni', __('Dni'));
        $grid->column('nombre', __('Nombre'));
        $grid->column('apellido', __('Apellido'));
        $grid->column('cargo', __('Función'));
        $grid->column('equipo.nombre', __('Equipo'));
                
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
        $show = new Show(Representante::findOrFail($id));

        //$show->field('id', __('Id'));
        $show->field('dni', __('Dni'));
        $show->field('nombre', __('Nombre'));
        $show->field('apellido', __('Apellido'));
        $show->field('cargo', __('Función'));
        $show->field('equipo.nombre', __('Equipo'));        

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Representante());

        //$form->text('dni', __('DNI'))->rules('required|min:8');;
        $form->text('dni', __('DNI'))->rules('required|numeric|min:7|max:8', [
            'numeric' => 'El DNI debe ser numérico',
            'min' => 'El DNI debe tener entre 7 y 8 dígitos',
            'max' => 'El DNI debe tener entre 7 y 8 dígitos',
        ])->placeholder('Documento Nacional de Identidad');
        
        $form->text('nombre', __('Nombre'))->rules('required');
        $form->text('apellido', __('Apellido'))->rules('required');
        $form->text('cargo', __('Función'));        
        $form->select('equipo_id', __("Equipo"))->options(Equipo::all()->pluck('nombre', 'id'));
        return $form;
    }
}
