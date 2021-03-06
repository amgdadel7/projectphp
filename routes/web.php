<?php
use App\Mail\NotifyEmail;
use Illuminate\Support\Facades\Mail;
define('PAGINATION_COUNT',2);

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

//define('')
//Route::get('/', function () {
//    $data=[];
//    $data['id']=5;
//    $data['name'] = 'Amjad Adel Alhakimi';
//
//
//});
//
//Route::get('index','Front\UserController@getIndex');
//
//Route::get('indexes','Front\UserController@getIndexes');
//
//Route::get('test1',function (){
//    return 'welcome';
//});
//
////route parameter
//Route::get('show-number/{id}',function ($id){
//    return $id;
//})-> name('a');
//
//Route::get('show-string/{id?}',function (){
//    return 'welcome';
//})-> name('b');
//
//
////route name
//
////Route::namespace('Front')->group(function (){
////    //all route only access controller or methods in folder name Front
////    Route::get('users','UserController@showUserName');
////});
//
////Route::prefix('users')-> group(function (){
////   Route::get('show','UserController@showUserName');
////   Route::delete('delete','UserController@showUserName');
////    Route::get('edit','UserController@showUserName');
////    Route::put('update','UserController@showUserName');
////});
//
////Route::group(['prefix' => 'users','middleware' => 'auth'],function(){
////    Route::get('/',function (){
////        return 'work';
////    });
////    Route::get('show','UserController@showUserName');
////    Route::delete('delete','UserController@showUserName');
////    Route::get('edit','UserController@showUserName');
////    Route::put('update','UserController@showUserName');
////});
//
////Route::get('check',function (){
////    return 'middleware';
////}) -> middleware('auth');
////Route::get('offers/show','UserController@showUserName');
////Route::delete('offers/delete','UserController@showUserName');
////Route::get('offers/edit','UserController@showUserName');
////Route::put('offers/update','UserController@showUserName');
//
//Route::group(['namespace'=> 'Admin'],function (){
//Route::get('second','SecondController@showString0')->middleware('auth');
//    Route::get('second1','SecondController@showString1');
//    Route::get('second2','SecondController@showString2');
//    Route::get('second3','SecondController@showString3');
//});
//
//Route::get('login',function (){
//   return 'Must Be login To access this Route';
//})-> name('login');
////middleware
////Route::get('users','UserController@index');
//
////Route::group(['middleware'=>'auth'],function (){
////    Route::get('users','UserController@index');
////
////});
//
//Route::resource('news','NewsController');
//
////Route::get('news','NewsController@show');
////Route::post('news','NewsController@store');
////Route::get('news/create','NewsController@create');
////Route::get('news/{id}/edit','NewsController@edit');
////Route::post('update/{id }','NewsController@update');
////Route::delete('delete/{id }','NewsController@delete');
//
////Route::get('create', 'controller@method');
//Route::get('/about',function (){
//   return view('about');
//});
//
//Auth::routes();
//
//Route::get('/home', 'HomeController@index')->name('home');



Auth::routes(['verify'=>true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');
//Route::get('/home', 'HomeController@index')->name('home');
Route::get('/dashboard', function (){
    return 'Not adult';
})-> name('not.adult');

Route::get('fillable','CrudController@getoffers');

    Route::group(['prefix' =>LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function (){

        Route::group(['prefix' => 'offers'],function (){
            Route::get('create','CrudController@create');
            Route::post('store','CrudController@store')->name('offers.store');

            Route::get('edit/{offer_id}','CrudController@editOffer');
            Route::post('update/{offer_id}','CrudController@updateOffer')->name('offers.update');
            Route::get('delete/{offer_id}','CrudController@delete')->name('offers.delete');
            Route::get('all','CrudController@getAllOffers')-> name('offers.all');
            Route::get('get-all-inactive-offer', 'CrudController@getAllInactiveOffers');
        });
//        Route::group(['prefix' =>''])
        Route::get('youtube','CrudController@getVideo')->middleware('auth');
//    Route::post('store','CrudController@store')-> name('offers.store');
});

//###################################################Begin Ajax routes###################################
Route::group(['prefix' => 'ajax-offers'], function () {
    Route::get('create', 'OfferController@create');
    Route::post('store', 'OfferController@store')->name('ajax.offers.store');
    Route::get('all', 'OfferController@all')->name('ajax.offers.all');
   Route::post('delete', 'OfferController@delete')->name('ajax.offers.delete');
   Route::get('edit/{offer_id}', 'OfferController@edit')->name('ajax.offers.edit');
    Route::post('update', 'OfferController@Update')->name('ajax.offers.update');
});


###################################################Begin Ajax routes###################################

##################### Begin Authentication && Guards ##############

Route::group(['middleware' => 'CheckAge','namespace' => 'Auth'], function () {
    Route::get('adults', 'CustomAuthController@adualt')-> name('adult');

});
Route::get('site', 'Auth\CustomAuthController@site')->middleware('auth:web')-> name('site');
Route::get('admin','Auth\CustomAuthController@admin')->middleware('auth:admin')->name('admin');
//Route::get('admin', 'Auth\CustomAuthController@admin')->middleware('auth:admin') -> name('admin');

//Route::get('admin',function (){
//    return view('admin');
//})->name('admin');

//middleware('auth')
//
Route::get('admin/login', 'Auth\CustomAuthController@adminLogin')-> name('admin.login');
Route::post('admin/login', 'Auth\CustomAuthController@checkAdminLogin')-> name('save.admin.login');


##################### End Authentication && Guards ##############


##############Begin one to one relations#######################
Route::get('has-one','Relation\RelastionsContoroller@hasOneRelation');
Route::get('has-one-reserve','Relation\RelastionsContoroller@hasOneRelationReverse');
Route::get('get-user-has-phones','Relation\RelastionsContoroller@getUserHasPhones');
Route::get('get-user-not-has-phones','Relation\RelastionsContoroller@getUserNotHasPhones');
Route::get('get-user-where-has-phone-with-condition','Relation\RelastionsContoroller@getUserWhereHasPhoneWithCondition');

##############End relations#########################
################## Begin one To many Relationship #####################
Route::get('hospital-has-many','Relation\RelastionsContoroller@getHospitalDoctors');

Route::get('hospitals','Relation\RelastionsContoroller@hospitals') -> name('hospital.all');

Route::get('doctors/{hospital_id}','Relation\RelastionsContoroller@doctors')-> name('hospital.doctors');




Route::get('hospitals/{hospital_id}','Relation\RelastionsContoroller@deleteHospital') -> name('hospital.delete');

Route::get('hospitals_has_doctors','Relation\RelastionsContoroller@hospitalsHasDoctor');

Route::get('hospitals_has_doctors_male','Relation\RelastionsContoroller@hospitalsHasOnlyMaleDoctors');

Route::get('hospitals_not_has_doctors','Relation\RelastionsContoroller@hospitals_not_has_doctors');


################## End one To many Relationship #####################


################## Begin  Many To many Relationship #####################

Route::get('doctors-services','Relation\RelastionsContoroller@getDoctorServices');

Route::get('service-doctors','Relation\RelastionsContoroller@getServiceDoctors');


Route::get('doctors/services/{doctor_id}','Relation\RelastionsContoroller@getDoctorServicesById')-> name('doctors.services');
Route::post('saveServices-to-doctor','Relation\RelastionsContoroller@saveServicesToDoctors')-> name('save.doctors.services');


################## End Many To many Relationship #####################


######################### has one through ##########################


Route::get('has-one-through','Relation\RelastionsContoroller@getPatientDoctor');

Route::get('has-many-through','Relation\RelastionsContoroller@getCountryDoctor');


################### End relations  routes ########################


#######################  Begin accessors and mutators ###################

//Route::get('accessors','Relation\RelastionsContoroller@getDoctors'); //get data

#######################  End accessors and mutators ###################
