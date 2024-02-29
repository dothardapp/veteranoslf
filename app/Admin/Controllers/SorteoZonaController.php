<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\SorteoZona;
use \App\Models\Equipo;
use \App\Models\Campeonato;
use App\Admin\Extensions\Popover;
use OpenAdmin\Admin\Grid\Column;


class SorteoZonaController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Sorteo de Zonas';    

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        Column::extend('popover', Popover::class);

        $grid = new Grid(new SorteoZona());                

        $grid->quickSearch(function ($model, $query) {
            $model->whereHas('equipo', function ($q) use ($query) {
                $q->where('nombre', 'like', "%{$query}%");
            });
        });
        

        $grid->disableRowSelector();        
        $grid->paginate(12);     

        $grid->fixColumns(2, -1);

        //$grid->column('id', __('Id'));
        $grid->column('campeonato.nombre', __('Campeonato'))->width(300);
        $grid->column('division', __('Division'))->width(100);             
                
        $grid->column('zona', __('Zona'))->width(200);                                
                        
        $grid->column('equipo.nombre', __('Equipo'))->display(function ($nombreDelEquipo) {
            if (empty($nombreDelEquipo)) {
                // Aplica una clase diferente o maneja registros vacíos según sea necesario
                return "<div class=\"bg-warning p-2 text-dark\">" . __('Sin equipo') . "</div>";
            }
            return "<div class=\"custom-info-bg p-2\">{$nombreDelEquipo}</div>"; // Usa la clase custom-blue-bg
        });
        
        
        //$grid->column('equipo_id', __('Equipo id'));
        
        //$grid->column('fecha', __('Fecha'));

        $grid->filter(function ($filter) {
                        
            $filter->disableIdFilter();
            
            $filter->setCols(4, 6); // sets the widths of label / field

            $filter->equal('campeonato.nombre', __('Campeonato'))->select(['Apertura 2024' => 'Apertura 2024',
                                                    'Clausura 2024' => 'Clausura 2024' ]);
    
            $filter->column(1/2, function ($filter) {
                $filter->equal('Division')->radio([
                    ''    => 'Todos',
                    'A'   => 'A',
                    'B'   => 'B',
                    'C'   => 'C',
                ]);
            });
    
            $filter->column(1/2, function ($filter) {
                $filter->equal('Zona')->radio([
                    ''    => 'Ambas',
                    '1'   => 'Zona 1',
                    '2'   => 'Zona 2',                    
                ]);
            });
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
        $show = new Show(SorteoZona::findOrFail($id));

        //$show->field('id', __('Id'));
        
        $show->field('division', __('Division'));
        $show->field('zona', __('Zona'));
        $show->field('fecha', __('Fecha'));
        //$show->field('campeonato_id', __('Campeonato id'));
        //$show->field('equipo_id', __('Equipo id'));
        

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new SorteoZona());
        
        $form->radio('division','Division')->options(['A' => 'A', 'B' => 'B', 'C' => 'C'])->default('A');
        $form->select('campeonato_id', __("Campeonato"))->options(Campeonato::all()->pluck('nombre', 'id'));
        $form->radio('zona','Zona')->options(['1' => 'Zona 1', '2' => 'Zona 2'])->default('1');

        $form->select('equipo_id', __("Equipo"))->options(Equipo::all()->pluck('nombre', 'id'));                        
        $form->date('fecha', __('Fecha'))->default(date('Y-m-d'));        

        return $form;
    }
}
