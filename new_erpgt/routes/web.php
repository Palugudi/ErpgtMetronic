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

Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index');

Route::post('language', 'LanguageController@changeLanguage');

Route::group(['middleware' => ['auth']], function(){
	Route::resource('site', 'SiteController');
	Route::get('site.listajax', 'SiteController@listajax')->name('site.listajax');
	Route::get('site.listajaxuser/{id}', 'SiteController@listajaxuser')->name('site.listajaxuser');
    Route::get('site/{id}/downloadFile/{name}', 'SiteController@downloadFile')->name('site.downloadFile');
    Route::get('site/{id}/equipment/{equipment_id}/downloadFile/{name}', 'SiteController@downloadEquipmentFile')->name('site.downloadEquipmentFile');
    Route::POST('search', 'SiteController@search');


	Route::resource('brand', 'BrandController');
	Route::get('brand.listajax', 'BrandController@listajax')->name('brand.listajax');

	Route::resource('document_type', 'Document_typeController', ['except' => ['update']]);
	Route::get('document_type.listajax', 'Document_typeController@listajax')->name('document_type.listajax');
	Route::post('document_type/{id}', 'Document_typeController@update')->name('document_type.update');

	Route::resource('domain', 'DomainController', ['except' => ['update']]);
	Route::get('domain.listajax', 'DomainController@listajax')->name('domain.listajax');
	Route::get('domain/{id}/equipment_types', 'DomainController@equipment_typesList')->name('domain.equipment_types');
	Route::post('domain/{id}', 'DomainController@update')->name('domain.update');

	Route::resource('equipment_type', 'Equipment_typeController', ['except' => ['update']]);
	Route::get('equipment_type.listajax', 'Equipment_typeController@listajax')->name('equipment_type.listajax');
	Route::post('equipment_type/{id}', 'Equipment_typeController@update')->name('equipment_type.update');
	
	Route::resource('equipment', 'EquipmentController');
	Route::get('equipment/listajax/{id}', 'EquipmentController@listajax')->name('equipment.listajax');
	Route::put('equipment/{id}/updatePosition', 'EquipmentController@updatePosition')->name('equipment.updatePosition');

	Route::resource('localisation', 'LocalisationController');
	Route::get('localisation.listajax', 'LocalisationController@listajax')->name('localisation.listajax');

	Route::resource('map', 'MapController');
	Route::get('map/listajax/{id}', 'MapController@listajax')->name('map.listajax');
	Route::get('map/{id}/listequipments', 'MapController@listequipments')->name('map.listequipments');
	
	Route::resource('status', 'StatusController');
	Route::get('status.listajax', 'StatusController@listajax')->name('status.listajax');

	Route::resource('energy', 'EnergyController', ['except' => ['update']]);
	Route::get('energy.listajax', 'EnergyController@listajax')->name('energy.listajax');
	Route::post('energy/{id}', 'EnergyController@update')->name('energy.update');

	Route::resource('interventionstatus', 'InterventionstatusController', ['except' => ['update']]);
	Route::get('interventionstatus.listajax', 'InterventionstatusController@listajax')->name('interventionstatus.listajax');
	Route::post('interventionstatus/{id}', 'InterventionstatusController@update')->name('interventionstatus.update');

	Route::resource('interventiontype', 'InterventiontypeController', ['except' => ['update']]);
	Route::get('interventiontype.listajax', 'InterventiontypeController@listajax')->name('interventiontype.listajax');
	Route::post('interventiontype/{id}', 'InterventiontypeController@update')->name('interventiontype.update');

	Route::resource('priority', 'PriorityController', ['except' => ['update']]);
	Route::get('priority.listajax', 'PriorityController@listajax')->name('priority.listajax');
	Route::post('priority/{id}', 'PriorityController@update')->name('priority.update');

	Route::resource('consumption', 'ConsumptionController', ['except' => ['index', 'update']]);
	Route::get('consumption/{site_id}/index', 'ConsumptionController@index')->name('consumption.index');
	Route::get('consumption/{site_id}/waterlistajax', 'ConsumptionController@waterlistajax')->name('consumption.waterlistajax');
	Route::get('consumption/{site_id}/gaslistajax', 'ConsumptionController@gaslistajax')->name('consumption.gaslistajax');
	Route::get('consumption/{site_id}/elechplistajax', 'ConsumptionController@elechplistajax')->name('consumption.elechplistajax');
	Route::get('consumption/{site_id}/elechclistajax', 'ConsumptionController@elechclistajax')->name('consumption.elechclistajax');
	Route::get('consumption/{site_id}/watergraphajax', 'ConsumptionController@watergraphajax')->name('consumption.watergraphajax');
	Route::get('consumption/{site_id}/gasgraphajax', 'ConsumptionController@gasgraphajax')->name('consumption.gasgraphajax');
	Route::get('consumption/{site_id}/elechpgraphajax', 'ConsumptionController@elechpgraphajax')->name('consumption.elechpgraphajax');
	Route::get('consumption/{site_id}/elechcgraphajax', 'ConsumptionController@elechcgraphajax')->name('consumption.elechcgraphajax');
	Route::post('consumption/{id}', 'ConsumptionController@update')->name('consumption.update');

	Route::resource('document', 'DocumentController', ['except' => ['update']]);
	Route::get('document/listajax/{id}', 'DocumentController@listajax')->name('document.listajax');
	Route::post('document/{id}', 'DocumentController@update')->name('document.update');

	Route::resource('equipment_picture', 'Equipment_pictureController', ['except' => ['update']]);
	Route::get('equipment_picture/listajax/{id}', 'Equipment_pictureController@listajax')->name('equipment_picture.listajax');
	Route::post('equipment_picture/{id}', 'Equipment_pictureController@update')->name('equipment_picture.update');

	Route::resource('equipment_document', 'Equipment_documentController', ['except' => ['update']]);
	Route::get('equipment_document/listajax/{id}', 'Equipment_documentController@listajax')->name('equipment_document.listajax');
	Route::post('equipment_document/{id}', 'Equipment_documentController@update')->name('equipment_document.update');

	Route::resource('picture', 'PictureController', ['except' => ['index', 'update']]);
	Route::get('picture/{site_id}/index', 'PictureController@index')->name('picture.index');
	Route::get('picture/listajax/{id}', 'PictureController@listajax')->name('picture.listajax');
	Route::post('picture/{id}', 'PictureController@update')->name('picture.update');

	Route::resource('enterprise', 'EnterpriseController', ['except' => ['index', 'update']]);
	Route::get('enterprise/{site_id}/index', 'EnterpriseController@index')->name('enterprise.index');
	Route::get('enterprise/listajax/{id}', 'EnterpriseController@listajax')->name('enterprise.listajax');
	Route::post('enterprise/{id}', 'EnterpriseController@update')->name('enterprise.update');

	Route::resource('contact', 'ContactController', ['update']);
	Route::get('contact.listajax', 'ContactController@listajax')->name('contact.listajax');
	Route::post('contact/{id}', 'ContactController@update')->name('contact.update');

	Route::resource('planning', 'PlanningController', ['except' => ['index', 'update']]);
	Route::get('planning/{site_id}/index', 'PlanningController@index')->name('planning.index');
	Route::get('planning/listajax/{id}', 'PlanningController@listajax')->name('planning.listajax');
	Route::get('planning/listequipmentajax/{id}', 'PlanningController@listequipmentajax')->name('planning.listequipmentajax');
	Route::post('planning/{id}', 'PlanningController@update')->name('planning.update');

	Route::resource('intervention', 'InterventionController', ['except' => ['update']]);
	Route::get('intervention.listajax', 'InterventionController@listajax')->name('intervention.listajax');
	Route::get('intervention/listajaxsite/{site_id}', 'InterventionController@listajaxsite')->name('intervention.listajaxsite');
	Route::get('intervention/listajaxuser/{user_id}', 'InterventionController@listajaxuser')->name('intervention.listajaxuser');
	Route::post('intervention/{id}', 'InterventionController@update')->name('intervention.update');
	Route::get('intervention/{id}/generalcomments', 'GeneralCommentController@listajax')->name('intervention.generalcomment');
	Route::get('intervention/{id}/internalcomments', 'InternalCommentController@listajax')->name('intervention.internalcomment');
	Route::get('intervention/{id}/time', 'TimeController@listajax')->name('intervention.time');


	// General comments :
	Route::resource('generalcomment', 'GeneralcommentController', ['update']);
	Route::post('generalcomment/{id}/update', 'GeneralcommentController@update')->name('generalcomment.update');


	// Internal comments :
	Route::resource('internalcomment', 'InternalcommentController', ['update']);
	Route::post('internalcomment/{id}/update', 'InternalcommentController@update')->name('internalcomment.update');


	// Time_type :
	Route::resource('time_type', 'Time_typeController', ['update']);
	Route::post('time_type/{id}', 'Time_typeController@update')->name('time_type.update');
	Route::get('time_type.listajax', 'Time_typeController@listajax')->name('time_type.listajax');


	// Time :
	Route::resource('time', 'TimeController', ['update']);
	Route::post('time/{id}', 'TimeController@update')->name('time.update');


	// Orders :
	Route::resource('order', 'OrderController', ['update', 'index']);
	Route::get('order/{id}/index', 'OrderController@index')->name('order.index');
	Route::post('order/{id}', 'OrderController@update')->name('order.update');
	Route::get('order.listajax/{id}', 'OrderController@listajax')->name('order.listajax');

	Route::get('orders', 'OrderController@ordersindex')->name('orders');
	Route::get('orders.listajax', 'OrderController@listajaxorders')->name('orders.listajax');

	Route::get('order.listajaxequipment/{id}', 'OrderController@listajaxequipment')->name('order.listajaxequipment');
	Route::post('order/equipement/{id}', 'OrderController@equipmentcreate')->name('order.save');
	Route::put('order/update/{id}', 'OrderController@equipmentupdate')->name('order.equipmentupdate');

	Route::get('order.listajaxintervention/{id}', 'OrderController@listajaxintervention')->name('order.listajaxintervention');
	Route::post('order/intervention/{id}', 'OrderController@interventioncreate')->name('order.saveintervention');
	Route::put('order/updateintervention/{id}', 'OrderController@interventionupdate')->name('order.interventionupdate');


	// Order statuses :
	Route::resource('order_status', 'Order_statusController', ['except' => 'update']);
	Route::get('order_status.listajax', 'Order_statusController@listajax')->name('order_status.listajax');
	Route::post('order_status/{id}', 'Order_statusController@update')->name('order_status.update');


	// Users (admin) :
	Route::resource('users', 'UserController', ['except' => 'update']);
	Route::get('users.listajax', 'UserController@listajax')->name('users.listajax');
	Route::get('users/{id}', 'UserController@show')->name('users.show');
	Route::put('users/{id}/update', 'UserController@update')->name('users.update');
	Route::delete('users/{user_id}/delete/{site_id}', 'UserController@destroyUserSite')->name('users.destroyusersite');
	Route::post('users/{user_id}/createsitelink', 'UserController@createUserSite')->name('users.createusersite');
	Route::post('users/changepassword', 'UserController@changepassword')->name('users.changepassword');


	// Reports :
	Route::resource('report', 'ReportController', ['except' => 'update']);
	Route::get('report/{id}/index', 'ReportController@index')->name('report.index');
	Route::get('reports', 'ReportController@reportsindex')->name('reports');
	Route::get('reports.listajax', 'ReportController@listajaxreports')->name('reports.listajax');
	Route::post('report/{id}', 'ReportController@update')->name('report.update');
	Route::get('report.listajax/{id}', 'ReportController@listajax')->name('report.listajax');

	Route::get('report.listajaxintervention/{id}', 'ReportController@listajaxintervention')->name('report.listajaxintervention');
	Route::post('report/intervention/{id}', 'ReportController@interventioncreate')->name('report.save');
	Route::put('report/update/{id}', 'ReportController@interventionupdate')->name('report.interventionupdate');

	Route::get('report.listajaxequipment/{id}', 'ReportController@listajaxequipment')->name('report.listajaxequipment');
	Route::post('report/equipment/{id}', 'ReportController@equipmentcreate')->name('report.equipmentsave');
	Route::put('report/updateequipment/{id}', 'ReportController@equipmentupdate')->name('report.equipmentupdate');

	// Keys :
	Route::resource('key', 'KeyController', ['except' => ['update', 'index']]);
	Route::get('key/{site_id}/index', 'KeyController@index')->name('key.index');
	Route::get('key.listajax/{site_id}', 'KeyController@listajax')->name('key.listajax');
	Route::post('key/{id}', 'KeyController@update')->name('key.update');
	
	// Qrcode :
	Route::resource('qrcode', 'QrcodeController', ['except' => 'index']);
	Route::get('qrcode/{site_id}/index', 'QrcodeController@index')->name('qrcode.index');
	Route::get('qrcode/print/{id}', 'QrcodeController@printQrcode')->name('qrcode.print');

	// Report pictures :
	Route::resource('report_picture', 'Report_pictureController', ['except' => ['update']]);
	Route::get('report_picture/listajax/{id}', 'Report_pictureController@listajax')->name('report_picture.listajax');
	Route::post('report_picture/{id}', 'Report_pictureController@update')->name('report_picture.update');

	// Report documents :
	Route::resource('report_document', 'Report_documentController', ['except' => ['update']]);
	Route::get('report_document/listajax/{id}', 'Report_documentController@listajax')->name('report_document.listajax');
	Route::post('report_document/{id}', 'Report_documentController@update')->name('report_document.update');

	
});