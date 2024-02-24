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

        // Obtiene las canchas desde la base de datos
        $canchas = Cancha::pluck('nombre', 'id');                
        // Utiliza los resultados para las opciones del select
        $grid->column('cancha_id', __('Cancha'))->select($canchas->toArray());                 

        $grid->column('hora_num', __('Hs.'))->radio([
            0 => 'A determinar',
            1 => 'Primera hora',
            2 => 'Segunda hora',            
        ]);

        $grid->column('equipo_local', __('Local'));
        $grid->column('equipo_visitante', __('Visitante'));

        //$grid->column('goles_equipo_local', __('Goles equipo local'));
        //$grid->column('goles_equipo_visitante', __('Goles equipo visitante'));

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
