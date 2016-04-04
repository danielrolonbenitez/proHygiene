<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class CursosInscripto extends Model {

protected $table='cursos_inscriptos';

protected $fillable = ['curso','email','skype'];



}

