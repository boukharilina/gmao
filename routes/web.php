<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/','HomeController@index')->name('home')->middleware('auth');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');
Route::get('/homet', 'HomeController@indextechnicien')->middleware('auth');
Route::get('/equipements','EquipementsController@index')->middleware('auth');

/* Users route */
Route::get('/profile','UsersController@profile')->middleware('auth');
Route::get('/profile/mod','UsersController@profilemod')->middleware('auth');
Route::post('/modprofile','UsersController@modprofile')->middleware('auth');
Route::get('/users','UsersController@index')->middleware('auth');
Route::get('/user/add','UsersController@create')->middleware('auth');
Route::post('/adduser','UsersController@store')->middleware('auth');
Route::post('/user/filter','UsersController@filter')->middleware('auth');
Route::get('/user/{id}','UsersController@show')->middleware('auth');
Route::post('/moduser/{id}','UsersController@update')->middleware('auth');
Route::get('/user/delete/{id}','UsersController@destroy')->middleware('auth');
Route::get('/users/loop', "UsersController@loop")->name('loop')->middleware('auth');

/* Equipements route 

Route::get('/equipement/add','EquipementsController@create')->middleware('auth');
Route::post('/addequipement','EquipementsController@store')->middleware('auth');*/
Route::post('/equipement/filter','EquipementsController@filter')->middleware('auth');
Route::get('/equipement/{id}','EquipementsController@show')->middleware('auth');
Route::get('/equipement/mod/{id}','EquipementsController@edit')->middleware('auth'); 
Route::get('/equipement/del/{id}','EquipementsController@destroy')->middleware('auth');
Route::post('/modequipement/{id}','EquipementsController@update')->middleware('auth');
Route::get('/equipements/detect', "EquipementsController@detect")->name('detect')->middleware('auth');
Route::post('/modalites/{modalite_id}/equipements','EquipementsController@store')->name('Equipements.store')->middleware('auth');
Route::get('/modalites/{modalite_id}/equipements/create', 'EquipementsController@create');
/* voir la documementation */ 
Route::get('download-document/{document}', function ($document) {
    $path = storage_path('app/public/' . $document);

    return response()->download($path, $document);})->name('download.document')->middleware('auth');

/* Sous Equipements route */

Route::post('/addsousequipement','SousequipementsController@store')->middleware('auth');
Route::post('/sousequipement/filter','SousequipementsController@filter')->middleware('auth');
Route::get('/sousequipements','SousequipementsController@index')->middleware('auth');
Route::get('/sousequipement/{id}','SousequipementsController@show')->middleware('auth');
Route::get('/equipement/{equipement_id}/sousequipement/mod/{id}','SousequipementsController@edit')->middleware('auth');
Route::get('/sousequipement/del/{id}/{equipement_id}','SousequipementsController@delete')->middleware('auth');
Route::post('/equipement/{equipement_id}/sousequipement','SousequipementsController@update')->name('Sousequipements.update')->middleware('auth');
Route::post('/equipements/{equipement_id}/sousequipements','sousequipementsController@store')->name('Sousequipements.store')->middleware('auth');
Route::get('/equipements/{equipement_id}/sousequipements/create', 'SousequipementsController@create');

/* Accessoires route */
   
Route::post('/addaccessoire','AccessoiresController@store')->middleware('auth');
Route::post('/sousequipement/filter','AccessoiresController@filter')->middleware('auth');
Route::get('/accessoires','AccessoiresController@index')->middleware('auth'); 
Route::get('/sousequipement/{id}','SouequipementsController@show')->middleware('auth');
Route::get('/equipement/mod/{id}','EquipementsController@edit')->middleware('auth');
Route::get('/equipement/del/{id}','EquipementsController@delete')->middleware('auth');
Route::post('/modequipement/{id}','EquipementsController@update')->middleware('auth'); 
Route::post('/equipements/{equipement_id}/accessoires','AccessoiresController@store')->name('Accessoires.store')->middleware('auth');
Route::get('/equipements/{equipement_id}/accessoires/create', 'AccessoiresController@create');

/* Demande d'intervention route */
Route::get('/di','OinterventionsController@index')->middleware('auth');
Route::get('/di/add','OinterventionsController@create')->middleware('auth');
Route::post('/addoi','OinterventionsController@store')->middleware('auth');
Route::post('/oi/filter','OinterventionsController@filter')->middleware('auth');

Route::post('/ointervention/mod/{id}',"OinterventionsController@update")->middleware('auth'); 
Route::get('/ointervention/change/{id}',"OinterventionsController@change")->middleware('auth');
Route::get('/ointervention/delete/{id}',"OinterventionsController@destroy")->middleware('auth');
Route::get('/ointervention/supprimer/{id}',"OinterventionsController@destroyHistorique")->middleware('auth');
Route::get('/di/valider/{id}','OinterventionsController@valider')->middleware('auth');
Route::get('/di/historique','OinterventionsController@historiqueoi')->middleware('auth'); 

Route::get('/ot/{id}','OinterventionsController@ordretravaille')->middleware('auth');
Route::get('/otoi/show/{id}','OinterventionsController@ordretravailleshow')->middleware('auth');
Route::get('/otmp/show/{id}','OinterventionsController@ordretravaillempshow')->middleware('auth');
Route::get('/otmp/historique/{id}','OinterventionsController@historiquempshow')->middleware('auth');
Route::get('/ot/refus/{id}','OinterventionsController@ordrerefus')->middleware('auth');
Route::get('/otmp/refus/{id}','OinterventionsController@ordremprefus')->middleware('auth');
Route::post('/ot/addobservation/{id}','OinterventionsController@addobservationoi')->middleware('auth');
/* Route modifier l'ordre d'intervention */ 
Route::get('/otoi/mod/{id}','OinterventionsController@modordretravail')->middleware('auth');
Route::post('/ot/modobservation/{id}','OinterventionsController@modobservationoi')->middleware('auth');
/*FIN Route modifier l'ordre d'intervention */  

Route::post('/otmp/addobservation/{id}','OinterventionsController@addobservationmp')->middleware('auth');
Route::get('/notification/seen/{id}','NotificationsController@seen')->middleware('auth');
Route::get('/oi/find', "OinterventionsController@find")->name('find')->middleware('auth'); 
/* Rapport d'intervention*/ 
Route::get('download-document/{document}', function ($document) {
    $path = storage_path('app/public/' . $document);

    return response()->download($path, $document);})->name('download.document')->middleware('auth');




/* maintenance preventives route */
Route::get('/mp','MpreventivesController@index')->middleware('auth');
Route::get('/mp/show/{id}','MpreventivesController@show')->middleware('auth');
Route::get('/m/{id}','MaintenancesController@show')->middleware('auth');
Route::get('/mp/add','MpreventivesController@create')->middleware('auth');
Route::post('/addmp','MpreventivesController@store')->middleware('auth');
Route::post('/mp/filter','MpreventivesController@filter')->middleware('auth');
Route::post('/mpreventive/mod/{id}',"MpreventivesController@update")->middleware('auth'); 
Route::get('/mpreventive/change/{id}',"MpreventivesController@change")->middleware('auth');
Route::get('/mpreventive/delete/{id}',"MpreventivesController@destroy")->middleware('auth');
Route::get('/mpreventive/search_mp', "MpreventivesController@search_mp")->name('search_mp')->middleware('auth');

/* plan maintenance route */
Route::get('/pm','PlanmaintenancesController@index')->middleware('auth');

/* Contrats du maintenance route */
Route::get('/cm','ContratsController@index')->middleware('auth');
Route::get('/cm/create','ContratsController@create')->middleware('auth');
Route::post('/cm/filter','ContratsController@filter')->middleware('auth');
Route::post('/addcontrat','ContratsController@add')->middleware('auth');
Route::get('/cm/del/{id}','ContratsController@destroy')->middleware('auth');
Route::get('/cm/mod/{id}','ContratsController@modification')->middleware('auth');
Route::post('/cm/mod/{id}','ContratsController@modification')->middleware('auth');
Route::post('/cm/mod/{id}/valide','ContratsController@edit')->middleware('auth');
Route::get('/cm/recherche', "ContratsController@recherche")->name('recherche')->middleware('auth');



/* Messages Route */

Route::get('/messages',"MessagesController@index")->middleware('auth');
Route::get('/conversation/{id}',"MessagesController@conversation")->middleware('auth');
Route::post('/addmessage',"MessagesController@store")->middleware('auth');

/* Departments routes */

Route::post('/department/filter',"DepartmentsController@filter")->middleware('auth');
Route::get('/department/create',"DepartmentsController@create")->middleware('auth');
Route::post('/department/add',"DepartmentsController@add")->middleware('auth');
Route::post('/department/mod/{id}',"DepartmentsController@update")->middleware('auth');
Route::get('/department/change/{id}',"DepartmentsController@change")->middleware('auth');
Route::get('/departments',"DepartmentsController@index")->middleware('auth');
Route::get('/department/delete/{id}',"DepartmentsController@destroy")->middleware('auth');
Route::get('/department/search', "DepartmentsController@search")->name('search')->middleware('auth');

/*Clients routes */
Route::post('/client/filter',"clientsController@filter")->middleware('auth');
Route::get('/client/create',"clientsController@create")->middleware('auth');
Route::post('/client/add',"clientsController@add")->middleware('auth');
Route::post('/client/mod/{id}',"clientsController@update")->middleware('auth');
Route::get('/client/change/{id}',"clientsController@change")->middleware('auth');
Route::get('/clients',"clientsController@index")->middleware('auth');
Route::get('/client/delete/{id}',"clientsController@destroy")->middleware('auth');
Route::get('/clients/filter', "clientsController@filter")->name('filter')->middleware('auth');

/* Modalités routes */

Route::post('/modalite/filter',"ModalitesController@filter")->middleware('auth');
Route::get('/modalite/create',"ModalitesController@create")->middleware('auth');
Route::post('/modalite/add',"ModalitesController@add")->middleware('auth');
Route::post('/modalite/mod/{id}',"ModalitesController@update")->middleware('auth');
Route::get('/modalite/change/{id}',"ModalitesController@change")->middleware('auth');
Route::get('/modalites',"ModalitesController@index")->middleware('auth');
Route::get('/modalite/delete/{id}',"ModalitesController@destroy")->middleware('auth');
Route::get('/modalite/{id}','ModalitesController@show')->middleware('auth');
Route::get('/department/search', "DepartmentsController@search")->name('search')->middleware('auth');


/* ajouter un sous équipement
Route::get('/sousequipements/ajout', function () {
    return view('sousequipements/ajout');
}); */

/* ajouter accessoires*
Route::get('/Equipements/equipement', function () {
    return view('Equipements/equipement');
});  

Route::get('/addsousequipement', function () {
    return view('sousequipements/index'); 
}); */
















