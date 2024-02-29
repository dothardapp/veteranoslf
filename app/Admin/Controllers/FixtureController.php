<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;

use \App\Models\Fixture;
use \App\Models\Cancha;


class FixtureController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Fixture';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Fixture());
                
        $grid->disableRowSelector();        
        $grid->paginate(36);        
        

        $grid->column('fecha_num', __('Fecha'))->display(function ($fecha_n) {
            if (empty($fecha_n)) {
                // Aplica una clase diferente o maneja registros vacíos según sea necesario
                return "<div class=\"bg-warning p-2 text-dark\">" . __('Sin equipo') . "</div>";
            }
            return "<div class=\"custom-light-bg p-2\">{$fecha_n}</div>"; // Usa la clase custom-blue-bg
        })->width(75);

        // Obtiene las canchas desde la base de datos
        $canchas = Cancha::pluck('nombre', 'id');                
        
        // Utiliza los resultados para las opciones del select
        $grid->column('cancha_id', __('Cancha'))->select($canchas->toArray())->display(function ($canchas) {
            if (empty($canchas)) {
                // Aplica una clase diferente o maneja registros vacíos según sea necesario
                return "<div class=\"bg-warning p-2 text-dark\">" . __('Sin equipo') . "</div>";
            }
            return "<div class=\"custom-info-bg p-2\">{$canchas}</div>"; // Usa la clase custom-blue-bg
        })->width(300);

        $grid->column('hora_num', __('Hs.'))->radio([
            0 => 'A determinar',
            1 => 'Primera hora',
            2 => 'Segunda hora',            
        ])->display(function ($hora) {
            if (empty($hora)) {
                // Aplica una clase diferente o maneja registros vacíos según sea necesario
                return "<div class=\"bg-warning p-2 text-dark\">" . __('Sin equipo') . "</div>";
            }
            return "<div class=\"custom-primary-bg p-2\">{$hora}</div>"; // Usa la clase custom-blue-bg
        })->width(180);

        $grid->column('equipo_local', __('Local'))->display(function ($local) {
            if (empty($local)) {
                // Aplica una clase diferente o maneja registros vacíos según sea necesario
                return "<div class=\"bg-warning p-2 text-dark\">" . __('Sin equipo') . "</div>";
            }
            return "<div class=\"custom-danger-bg p-2\">{$local}</div>"; // Usa la clase custom-blue-bg
        })->width(350);

        $grid->column('equipo_visitante', __('Visitante'))->display(function ($visitante) {
            if (empty($visitante)) {
                // Aplica una clase diferente o maneja registros vacíos según sea necesario
                return "<div class=\"bg-warning p-2 text-dark\">" . __('Sin equipo') . "</div>";
            }
            return "<div class=\"custom-warning-bg p-2\">{$visitante}</div>"; // Usa la clase custom-blue-bg
        })->width(350);

        //$grid->column('goles_equipo_local', __('Goles equipo local'));
        //$grid->column('goles_equipo_visitante', __('Goles equipo visitante'));

        $grid->expandFilter();

        $grid->filter(function($filter){

            // Remove the default id filter
            $filter->disableIdFilter();

            // Genera el array de opciones para el filtro de fecha
            $fechas = range(1, 11);                                     // Esto generará un array de 1 a 11
            $options = array_combine($fechas, $fechas);                 // Crea un array asociativo donde las claves y valores son los mismos
        
            // Añade un filtro de columna para 'fecha_num' con un desplegable select
            $filter->equal('fecha_num', __('Fecha: '))->select($options);
           
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
        $show = new Show(Fixture::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('campeonato_id', __('Campeonato id'));
        $show->field('cancha_id', __('Cancha id'));
        $show->field('division', __('Division'));
        $show->field('zona', __('Zona'));
        $show->field('fecha_num', __('Fecha num'));
        $show->field('fecha', __('Fecha'));
        $show->field('hora_num', __('Hora'));
        $show->field('equipo_local', __('Equipo local'));
        $show->field('equipo_visitante', __('Equipo visitante'));
        $show->field('goles_equipo_local', __('Goles equipo local'));
        $show->field('goles_equipo_visitante', __('Goles equipo visitante'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Fixture());

        $form->number('campeonato_id', __('Campeonato id'));
        $form->number('cancha_id', __('Cancha id'));
        $form->text('division', __('Division'));
        $form->text('zona', __('Zona'));
        $form->number('fecha_num', __('Fecha num'));
        $form->date('fecha', __('Fecha'))->default(date('Y-m-d'));
        $form->switch('hora_num', __('Hora'));
        $form->text('equipo_local', __('Equipo local'));
        $form->text('equipo_visitante', __('Equipo visitante'));
        $form->number('goles_equipo_local', __('Goles equipo local'));
        $form->number('goles_equipo_visitante', __('Goles equipo visitante'));

        return $form;
    }
}
