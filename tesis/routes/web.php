<?php

//Ruta pra petición ajax
Route::get('data_user/{id}','PetitionsController@getDataUser');

//Ruta para solicitar un nuevo trámite (get)
Route::get('/Solicitud', function () {
    return view('verificacion');
})->name('petitions');

//Ruta que envía los datos para una nueva solicitud (post)
Route::post('/Solicitud','PetitionsController@store')->name('petitions.store');

//Ruta que se genera en el Email
Route::get('/register/verify/{ID}/{code}','RequestController@verify')->name('request.verify');

//Rutas para los formularios de los trámites correspondientes:

//Materias en paralelo (get)
Route::get('/MateriasParalelo/{ID}/{code}', function () {
    return view('MateriasEnParalelo');
})->name('request.parallel');

//Materias en paralelo (post)
Route::post('/MateriasParalelo/{ID}/{code}', 'RequestController@uploadParallel')->name('request.parallel_post');

//Colisión de horarios(get)
Route::get('/ColisionHorario/{ID}/{code}', function () {
    return view('ColisionHorario');
})->name('request.schedule_collision');

//Colisión de horarios (post)
Route::post('/ColisionHorario/{ID}/{code}', 'RequestController@uploadSchedule_collision')->name('request.schedule_collision_post');

//Exceso de unidades de créditos (get)
Route::get('/ExcesoUnidades/{ID}/{code}', function () {
    return view('ExcesoUnidades');
})->name('request.excess_credit_units');

//Exceso de unidades de créditoso (post)
Route::post('/ExcesoUnidades/{ID}/{code}', 'RequestController@uploadExcess_credit_units')->name('request.excess_credit_units_post');

//Proyecto de grado (get)
Route::get('/ProyectoGrado/{ID}/{code}', function () {
    return view('ProyectoGrado');
})->name('request.graduation_project');

//Proyecto de grado (post)
Route::post('/ProyectoGrado/{ID}/{code}', 'RequestController@uploadGraduation_project')->name('request.graduation_project_post');

//Ruta para la página de inicio
Route::get('/', function () {
    return view('welcome');
});

//Ruta para la página de búsqueda de solicitud
Route::get('/Seguimiento', function () {
    return view('Buscador');
})->name('search.find');

//Ruta que busca la página las solicitudes asociadas a un ID
Route::post('/Seguimiento', 'SearchController@search')->name('search.find_post');

//Ruta para la página de busquedad
Route::get('/Busqueda/{ID}', 'SearchController@find')->name('search.found')->where('ID', '^[V|E][0-9]{6,7}[0-9]$');

Route::post('/Busqueda/{ID}', 'SearchController@send')->name('send');

