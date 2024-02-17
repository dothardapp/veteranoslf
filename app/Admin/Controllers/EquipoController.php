<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\Equipo;

class EquipoController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Equipos';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Equipo());

        $grid->disableRowSelector();
        $grid->quickSearch('nombre');
        $grid->paginate(12);        

        //$grid->column('id', __('Id'));                
        $grid->column('escudo')->image('', 45, 45);
        $grid->column('nombre', __('Equipo'))->sortable()->display(
            function($nombre){
                return "<p class='h6'>$nombre</p>";                
            }
        );        
        $grid->column('divicion', __('Divicion'))->sortable();      
        
        $grid->filter(function($filter){

            // Remove the default id filter
            $filter->disableIdFilter();
        
            // Add a column filter
            //$filter->like('divicion', 'dvicion');

            $filter->equal('Divicion')->radio([
                ''    => 'Todos',
                'A'   => 'A',
                'B'   => 'B',
                'C'   => 'C',
            ]);
                   
        });

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
        $show = new Show(Equipo::findOrFail($id));

        //$show->field('id', __('Id'));
        $show->field('nombre', __('Equipo: '));
        //$show->field('escudo', __('Logo'));
        $show->field("escudo", "Escudo: ")->image($base_url = '', $width = 75, $height = 75);
        $show->field('divicion', __('Divicion: '));        

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Equipo());

        $form->text('nombre', __('Nombre'));
        $form->image('escudo', __('Escudo'));
        $form->radio('divicion', 'Divicion: ')->options(['A' => ' A ', 'B' => ' B ','C' => ' C '])->default('A');

        return $form;
    }
}
