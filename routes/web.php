<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('web_app_home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix'=>'dashboard','middleware'=>'auth'],function (){
    Route::get('index',[App\Http\Controllers\dashboard\HomeController::class , 'index'])->name('dashboard.index');
    // Route::group(['prefix'=>'users'],function (){
    //     Route::get('index',[App\Http\Controllers\dashboard\admin\users\UserController::class , 'index'])->name('dashboard.users.index');
    //     Route::get('add_form',[App\Http\Controllers\dashboard\admin\users\UserController::class, 'add_form'])->name('dashboard.users.add_form');
    //     Route::post('create',[App\Http\Controllers\dashboard\admin\users\UserController::class, 'create'])->name('dashboard.users.create');
    // });
    Route::group(['prefix' => 'users'], function () {
        Route::get('/index', [App\Http\Controllers\dashboard\UserController::class, 'index'])->name('dashboard.users.index');
        Route::post('/updateStatus', [App\Http\Controllers\dashboard\UserController::class, 'updateStatus'])->name('dashboard.users.updateStatus');
        Route::get('add_form',[App\Http\Controllers\dashboard\UserController::class, 'add_form'])->name('dashboard.users.add_form');
        Route::post('create',[App\Http\Controllers\dashboard\UserController::class, 'create'])->name('dashboard.users.create');
        Route::post('update/{id}',[App\Http\Controllers\dashboard\UserController::class, 'update'])->name('dashboard.users.update');
        Route::post('update_user_ajax',[App\Http\Controllers\dashboard\UserController::class, 'update_user_ajax'])->name('dashboard.users.update_user_ajax');
        Route::post('upload_image',[App\Http\Controllers\dashboard\UserController::class, 'upload_image'])->name('dashboard.users.upload_image');

        Route::group(['prefix' => 'insurance_companies'], function () {
            Route::get('/index', [App\Http\Controllers\dashboard\admin\users\InsuranceCompaniesController::class, 'index'])->name('dashboard.users.insurance_companies.index');
            Route::get('/add', [App\Http\Controllers\dashboard\admin\users\InsuranceCompaniesController::class, 'add'])->name('dashboard.users.insurance_companies.add');
            Route::post('create', [App\Http\Controllers\dashboard\admin\users\InsuranceCompaniesController::class, 'create'])->name('dashboard.users.insurance_companies.create');
            Route::get('edit/{id}', [App\Http\Controllers\dashboard\admin\users\InsuranceCompaniesController::class, 'edit'])->name('dashboard.users.insurance_companies.edit');
            Route::post('update/{id}', [App\Http\Controllers\dashboard\admin\users\InsuranceCompaniesController::class, 'update'])->name('dashboard.users.insurance_companies.update');
            Route::get('details/{id}', [App\Http\Controllers\dashboard\admin\users\InsuranceCompaniesController::class, 'details'])->name('dashboard.users.insurance_companies.details');
            Route::group(['prefix' => 'contact_person'], function () {
                Route::post('create', [App\Http\Controllers\dashboard\admin\users\InsuranceCompaniesController::class, 'createContactPerson'])->name('dashboard.users.insurance_companies.contact_person.create');
            });
        });

        Route::group(['prefix' => 'admins'], function () {
            Route::get('/index', [App\Http\Controllers\dashboard\admin\users\AdminsController::class, 'index'])->name('dashboard.users.admins.index');
            Route::get('/add', [App\Http\Controllers\dashboard\admin\users\AdminsController::class, 'add'])->name('dashboard.users.admins.add');
            Route::post('create', [App\Http\Controllers\dashboard\admin\users\AdminsController::class, 'create'])->name('dashboard.users.admins.create');
            Route::get('edit/{id}', [App\Http\Controllers\dashboard\admin\users\AdminsController::class, 'edit'])->name('dashboard.users.admins.edit');
            Route::post('update/{id}', [App\Http\Controllers\dashboard\admin\users\AdminsController::class, 'update'])->name('dashboard.users.admins.update');
            Route::get('details/{id}', [App\Http\Controllers\dashboard\admin\users\AdminsController::class, 'details'])->name('dashboard.users.admins.details');
        });

        Route::group(['prefix' => 'appraiser'], function () {
            Route::get('/index', [App\Http\Controllers\dashboard\admin\users\AppraiserController::class, 'index'])->name('dashboard.users.appraiser.index');
            Route::get('/add', [App\Http\Controllers\dashboard\admin\users\AppraiserController::class, 'add'])->name('dashboard.users.appraiser.add');
            Route::post('create', [App\Http\Controllers\dashboard\admin\users\AppraiserController::class, 'create'])->name('dashboard.users.appraiser.create');
            Route::get('edit/{id}', [App\Http\Controllers\dashboard\admin\users\AppraiserController::class, 'edit'])->name('dashboard.users.appraiser.edit');
            Route::post('update/{id}', [App\Http\Controllers\dashboard\admin\users\AppraiserController::class, 'update'])->name('dashboard.users.appraiser.update');
            Route::get('details/{id}', [App\Http\Controllers\dashboard\admin\users\AppraiserController::class, 'details'])->name('dashboard.users.appraiser.details');
        });

        Route::group(['prefix' => 'car_part_store'], function () {
            Route::get('/index', [App\Http\Controllers\dashboard\admin\users\CarPartStoreController::class, 'index'])->name('dashboard.users.car_part_store.index');
            Route::get('/add', [App\Http\Controllers\dashboard\admin\users\CarPartStoreController::class, 'add'])->name('dashboard.users.car_part_store.add');
            Route::post('create', [App\Http\Controllers\dashboard\admin\users\CarPartStoreController::class, 'create'])->name('dashboard.users.car_part_store.create');
            Route::get('edit/{id}', [App\Http\Controllers\dashboard\admin\users\CarPartStoreController::class, 'edit'])->name('dashboard.users.car_part_store.edit');
            Route::post('update/{id}', [App\Http\Controllers\dashboard\admin\users\CarPartStoreController::class, 'update'])->name('dashboard.users.car_part_store.update');
            Route::get('details/{id}', [App\Http\Controllers\dashboard\admin\users\CarPartStoreController::class, 'details'])->name('dashboard.users.car_part_store.details');
        });

        Route::group(['prefix' => 'garage'], function () {
            Route::get('/index', [App\Http\Controllers\dashboard\admin\users\GarageController::class, 'index'])->name('dashboard.users.garage.index');
            Route::get('/add', [App\Http\Controllers\dashboard\admin\users\GarageController::class, 'add'])->name('dashboard.users.garage.add');
            Route::post('create', [App\Http\Controllers\dashboard\admin\users\GarageController::class, 'create'])->name('dashboard.users.garage.create');
            Route::get('edit/{id}', [App\Http\Controllers\dashboard\admin\users\GarageController::class, 'edit'])->name('dashboard.users.garage.edit');
            Route::post('update/{id}', [App\Http\Controllers\dashboard\admin\users\GarageController::class, 'update'])->name('dashboard.users.garage.update');
            Route::get('details/{id}', [App\Http\Controllers\dashboard\admin\users\GarageController::class, 'details'])->name('dashboard.users.garage.details');
        });

        Route::group(['prefix' => 'tow_truck_owner'], function () {
            Route::get('/index', [App\Http\Controllers\dashboard\admin\users\TowTruckOwnerController::class, 'index'])->name('dashboard.users.tow_truck_owner.index');
            Route::get('/add', [App\Http\Controllers\dashboard\admin\users\TowTruckOwnerController::class, 'add'])->name('dashboard.users.tow_truck_owner.add');
            Route::post('create', [App\Http\Controllers\dashboard\admin\users\TowTruckOwnerController::class, 'create'])->name('dashboard.users.tow_truck_owner.create');
            Route::get('edit/{id}', [App\Http\Controllers\dashboard\admin\users\TowTruckOwnerController::class, 'edit'])->name('dashboard.users.tow_truck_owner.edit');
            Route::post('update/{id}', [App\Http\Controllers\dashboard\admin\users\TowTruckOwnerController::class, 'update'])->name('dashboard.users.tow_truck_owner.update');
            Route::get('details/{id}', [App\Http\Controllers\dashboard\admin\users\TowTruckOwnerController::class, 'details'])->name('dashboard.users.tow_truck_owner.details');
        });

        Route::group(['prefix' => 'visitor'], function () {
            Route::get('/index', [App\Http\Controllers\dashboard\admin\users\VisitorController::class, 'index'])->name('dashboard.users.visitor.index');
            Route::get('/add', [App\Http\Controllers\dashboard\admin\users\VisitorController::class, 'add'])->name('dashboard.users.visitor.add');
            Route::post('create', [App\Http\Controllers\dashboard\admin\users\VisitorController::class, 'create'])->name('dashboard.users.visitor.create');
            Route::get('edit/{id}', [App\Http\Controllers\dashboard\admin\users\VisitorController::class, 'edit'])->name('dashboard.users.visitor.edit');
            Route::post('update/{id}', [App\Http\Controllers\dashboard\admin\users\VisitorController::class, 'update'])->name('dashboard.users.visitor.update');
            Route::get('details/{id}', [App\Http\Controllers\dashboard\admin\users\VisitorController::class, 'details'])->name('dashboard.users.visitor.details');
        });



        //{-------------------future work/ users------------------------}//
        Route::group(['prefix' => 'procurement_officer'], function () {
            Route::get('/index', [App\Http\Controllers\users\ProcurmentOfficerController::class, 'index'])->name('dashboard.users.procurement_officer.index');
            Route::get('/add', [App\Http\Controllers\users\ProcurmentOfficerController::class, 'add'])->name('dashboard.users.procurement_officer.add');
            Route::post('create', [App\Http\Controllers\users\ProcurmentOfficerController::class, 'create'])->name('dashboard.users.procurement_officer.create');
            Route::get('edit/{id}', [App\Http\Controllers\users\ProcurmentOfficerController::class, 'edit'])->name('dashboard.users.procurement_officer.edit');
            Route::post('update/{id}', [App\Http\Controllers\users\ProcurmentOfficerController::class, 'update'])->name('dashboard.users.procurement_officer.update');
            Route::get('details/{id}', [App\Http\Controllers\users\ProcurmentOfficerController::class, 'details'])->name('dashboard.users.procurement_officer.details');

            Route::group(['prefix' => 'tasks'], function () {
                Route::get('/index', [App\Http\Controllers\procurement_officer\tasks\TasksController::class, 'index'])->name('procurement_officer.tasks.index');
            });
            // TODO طلبات الشراء
            Route::group(['prefix' => 'orders'], function () {
                Route::get('/index', [App\Http\Controllers\users\ProcurmentOfficerController::class, 'orders_index'])->name('orders.procurement_officer.order_index');
                Route::get('/order_items_index/{order_id}', [App\Http\Controllers\users\ProcurmentOfficerController::class, 'order_items_index'])->name('orders.procurement_officer.order_items_index');
                Route::post('/create_order', [App\Http\Controllers\users\ProcurmentOfficerController::class, 'create_order'])->name('orders.procurement_officer.create_order');
                Route::post('/order_table', [App\Http\Controllers\users\ProcurmentOfficerController::class, 'order_table'])->name('orders.procurement_officer.order_table');
                Route::get('/listOrderForOfficerIndex', [App\Http\Controllers\users\ProcurmentOfficerController::class, 'listOrderForOfficerIndex'])->name('orders.procurement_officer.listOrderForOfficerIndex');
                Route::post('/listOrderForOfficer', [App\Http\Controllers\users\ProcurmentOfficerController::class, 'listOrderForOfficer'])->name('orders.procurement_officer.listOrderForOfficer');
                Route::post('/update_reference_number', [App\Http\Controllers\users\ProcurmentOfficerController::class, 'update_reference_number'])->name('orders.procurement_officer.update_reference_number');
                Route::get('/getReferenceNumber', [App\Http\Controllers\users\ProcurmentOfficerController::class, 'getReferenceNumber'])->name('orders.procurement_officer.getReferenceNumber');
                Route::get('/show_due_date', [App\Http\Controllers\users\ProcurmentOfficerController::class, 'show_due_date'])->name('orders.procurement_officer.show_due_date');
                Route::post('/update_due_date', [App\Http\Controllers\users\ProcurmentOfficerController::class, 'update_due_date'])->name('orders.procurement_officer.update_due_date');
                Route::get('/delete_order/{id}', [App\Http\Controllers\users\ProcurmentOfficerController::class, 'delete_order'])->name('orders.procurement_officer.delete_order');
                Route::get('/list_orders_from_storekeeper', [App\Http\Controllers\users\ProcurmentOfficerController::class, 'list_orders_from_storekeeper'])->name('orders.procurement_officer.list_orders_from_storekeeper');
                Route::post('/updateOrderStatus', [App\Http\Controllers\users\ProcurmentOfficerController::class, 'updateOrderStatus'])->name('orders.procurement_officer.updateOrderStatus');
                Route::post('/updateToUser', [App\Http\Controllers\users\ProcurmentOfficerController::class, 'updateToUser'])->name('orders.procurement_officer.updateToUser');
                Route::group(['prefix'=>'order_archive'],function(){
                    Route::get('index', [App\Http\Controllers\OrderArchiveController::class, 'index'])->name('order_archive.index');
                    Route::post('archive_order_table', [App\Http\Controllers\OrderArchiveController::class, 'archive_order_table'])->name('order_archive.archive_order_table');
                    Route::post('update_reference_number', [App\Http\Controllers\OrderArchiveController::class, 'update_reference_number'])->name('order_archive.update_reference_number');
                    Route::post('update_due_date', [App\Http\Controllers\OrderArchiveController::class, 'update_due_date'])->name('order_archive.update_due_date');
                });
                Route::group(['prefix'=>'product'],function(){
                    Route::get('index/{order_id}', [App\Http\Controllers\procurement_officer\ProductController::class, 'index'])->name('procurement_officer.orders.product.index');
                    Route::post('/create_order_items', [App\Http\Controllers\procurement_officer\ProductController::class, 'create_order_items'])->name('procurement_officer.orders.create_order_items');
                    Route::get('/product_list_pdf/{order_id}', [App\Http\Controllers\procurement_officer\ProductController::class, 'product_list_pdf'])->name('procurement_officer.orders.product.product_list_pdf');
                    Route::post('/search_product_ajax', [App\Http\Controllers\procurement_officer\ProductController::class, 'search_product_ajax'])->name('procurement_officer.orders.product.search_product_ajax');
                    Route::post('/create_product_ajax', [App\Http\Controllers\procurement_officer\ProductController::class, 'create_product_ajax'])->name('procurement_officer.orders.product.create_product_ajax');
                    Route::post('/order_items_table', [App\Http\Controllers\procurement_officer\ProductController::class, 'order_items_table'])->name('procurement_officer.orders.product.order_items_table');
                });
                Route::group(['prefix'=>'price_offer'],function(){
                    Route::get('index/{order_id}',[App\Http\Controllers\procurement_officer\PriceOfferController::class, 'index'])->name('procurement_officer.orders.price_offer.index');
                    Route::post('create_price_offer', [App\Http\Controllers\procurement_officer\PriceOfferController::class, 'create_price_offer'])->name('procurement_officer.orders.price_offer.create_price_offer');
                    Route::get('edit_price_offer/{id}', [App\Http\Controllers\procurement_officer\PriceOfferController::class, 'edit_price_offer'])->name('procurement_officer.orders.price_offer.edit_price_offer');
                    Route::post('update_price_offer/{id}', [App\Http\Controllers\procurement_officer\PriceOfferController::class, 'update_price_offer'])->name('procurement_officer.orders.price_offer.update_price_offer');
                    Route::get('details_offer_price/{id}', [App\Http\Controllers\procurement_officer\PriceOfferController::class, 'details_offer_price'])->name('procurement_officer.orders.price_offer.details_offer_price');
                    Route::get('delete_offer_price/{id}', [App\Http\Controllers\procurement_officer\PriceOfferController::class, 'delete_offer_price'])->name('procurement_officer.orders.price_offer.delete_offer_price');
                    Route::post('updateCurrency', [App\Http\Controllers\procurement_officer\PriceOfferController::class, 'updateCurrency'])->name('procurement_officer.orders.price_offer.updateCurrency');
                    Route::get('price_offer_export/{order_id}', [App\Http\Controllers\procurement_officer\PriceOfferController::class, 'exportExcel'])->name('procurement_officer.orders.price_offer.exportExcel');
                    Route::post('price_offer_import', [App\Http\Controllers\procurement_officer\PriceOfferController::class, 'importExcel'])->name('procurement_officer.orders.price_offer.importExcel');
                });
                Route::group(['prefix'=>'anchor'],function(){
                    Route::get('index/{order_id}',[App\Http\Controllers\procurement_officer\AnchorController::class, 'index'])->name('procurement_officer.orders.anchor.index');
                    Route::post('create_anchor', [App\Http\Controllers\procurement_officer\AnchorController::class, 'create_anchor'])->name('procurement_officer.orders.anchor.create_anchor');
                    Route::get('delete_anchor/{id}', [App\Http\Controllers\procurement_officer\AnchorController::class, 'delete_anchor'])->name('procurement_officer.orders.anchor.delete_anchor');
                    Route::post('updateNotesForAnchor', [App\Http\Controllers\procurement_officer\AnchorController::class, 'updateNotesForAnchor'])->name('procurement_officer.orders.anchor.updateNotesForAnchor');
                    Route::get('anchor_table_pdf/{order_id}/{price_offer}', [App\Http\Controllers\procurement_officer\AnchorController::class, 'anchor_table_pdf'])->name('procurement_officer.orders.anchor.anchor_table_pdf');
                    Route::get('compare_price_offers/{order_id}', [App\Http\Controllers\procurement_officer\AnchorController::class, 'compare_price_offers'])->name('procurement_officer.orders.anchor.compare_price_offers');
                    Route::post('upload_image', [App\Http\Controllers\procurement_officer\AnchorController::class, 'upload_image'])->name('procurement_officer.orders.anchor.upload_image');
                    Route::get('delete_attachment/{id}', [App\Http\Controllers\procurement_officer\AnchorController::class, 'delete_attachment'])->name('procurement_officer.orders.anchor.delete_attachment');
                });
                Route::group(['prefix'=>'financial_file'],function(){
                    Route::get('index/{order_id}',[App\Http\Controllers\procurement_officer\FinancialFileController::class, 'index'])->name('procurement_officer.orders.financial_file.index');
                    Route::post('create_cash_payment',[App\Http\Controllers\procurement_officer\FinancialFileController::class, 'create_cash_payment'])->name('procurement_officer.orders.financial_file.create_cash_payment');
                    Route::post('create_letter_bank',[App\Http\Controllers\procurement_officer\FinancialFileController::class, 'create_letter_bank'])->name('procurement_officer.orders.financial_file.create_letter_bank');
                    Route::get('edit_cash_payment/{id}',[App\Http\Controllers\procurement_officer\FinancialFileController::class, 'edit_cash_payment'])->name('procurement_officer.orders.financial_file.edit_cash_payment');
                    Route::post('update_cash_payment',[App\Http\Controllers\procurement_officer\FinancialFileController::class, 'update_cash_payment'])->name('procurement_officer.orders.financial_file.update_cash_payment');
                    Route::get('delete_cash_payment/{id}',[App\Http\Controllers\procurement_officer\FinancialFileController::class, 'delete_cash_payment'])->name('procurement_officer.orders.financial_file.delete_cash_payment');
                    Route::get('edit_letter_bank/{id}',[App\Http\Controllers\procurement_officer\FinancialFileController::class, 'edit_letter_bank'])->name('procurement_officer.orders.financial_file.edit_letter_bank');
                    Route::post('update_letter_bank',[App\Http\Controllers\procurement_officer\FinancialFileController::class, 'update_letter_bank'])->name('procurement_officer.orders.financial_file.update_letter_bank');
                    Route::get('delete_letter_bank/{id}',[App\Http\Controllers\procurement_officer\FinancialFileController::class, 'delete_letter_bank'])->name('procurement_officer.orders.financial_file.delete_letter_bank');
                    Route::get('extension_index/{letter_bank_id}',[App\Http\Controllers\procurement_officer\FinancialFileController::class, 'index_extension'])->name('procurement_officer.orders.financial_file.index_extension');
                    Route::post('create_extension',[App\Http\Controllers\procurement_officer\FinancialFileController::class, 'create_extension'])->name('procurement_officer.orders.financial_file.create_extension');
                    Route::get('edit_extension/{id}',[App\Http\Controllers\procurement_officer\FinancialFileController::class, 'edit_extension'])->name('procurement_officer.orders.financial_file.edit_extension');
                    Route::post('update_extension',[App\Http\Controllers\procurement_officer\FinancialFileController::class, 'update_extension'])->name('procurement_officer.orders.financial_file.update_extension');
                    Route::get('delete_extension/{id}',[App\Http\Controllers\procurement_officer\FinancialFileController::class, 'delete_extension'])->name('procurement_officer.orders.financial_file.delete_extension');
                    Route::post('updatePaymentStatus',[App\Http\Controllers\procurement_officer\FinancialFileController::class, 'updatePaymentStatus'])->name('procurement_officer.orders.financial_file.updatePaymentStatus');
                });
                Route::group(['prefix'=>'shipping'],function(){
                    Route::get('index/{order_id}',[App\Http\Controllers\procurement_officer\ShippingController::class, 'index'])->name('procurement_officer.orders.shipping.index');
                    Route::post('create',[App\Http\Controllers\procurement_officer\ShippingController::class, 'create'])->name('procurement_officer.orders.shipping.create');
                    Route::get('edit/{id}',[App\Http\Controllers\procurement_officer\ShippingController::class, 'edit'])->name('procurement_officer.orders.shipping.edit');
                    Route::post('update',[App\Http\Controllers\procurement_officer\ShippingController::class, 'update'])->name('procurement_officer.orders.shipping.update');
                    Route::get('delete/{id}',[App\Http\Controllers\procurement_officer\ShippingController::class, 'delete'])->name('procurement_officer.orders.shipping.delete');
                    Route::get('details/{id}',[App\Http\Controllers\procurement_officer\ShippingController::class, 'details'])->name('procurement_officer.orders.shipping.details');
                    Route::post('create_shipping_award',[App\Http\Controllers\procurement_officer\ShippingController::class, 'create_shipping_award'])->name('procurement_officer.orders.shipping.create_shipping_award');
                    Route::get('shipping_award_status_disable/{id}',[App\Http\Controllers\procurement_officer\ShippingController::class, 'shipping_award_status_disable'])->name('procurement_officer.orders.shipping.shipping_award_status_disable');
                    Route::get('edit_shipping_award/{id}',[App\Http\Controllers\procurement_officer\ShippingController::class, 'edit_shipping_award'])->name('procurement_officer.orders.shipping.edit_shipping_award');
                    Route::post('update_shipping_award',[App\Http\Controllers\procurement_officer\ShippingController::class, 'update_shipping_award'])->name('procurement_officer.orders.shipping.update_shipping_award');
                });
                Route::group(['prefix'=>'calender'],function(){
                    Route::get('index/{order_id}',[App\Http\Controllers\procurement_officer\CalenderController::class, 'index'])->name('procurement_officer.orders.calender.index');
                    Route::get('getEvents/{order_id}',[App\Http\Controllers\procurement_officer\CalenderController::class, 'getEvents'])->name('procurement_officer.orders.calender.getEvents');
                    Route::post('create',[App\Http\Controllers\procurement_officer\CalenderController::class, 'create'])->name('procurement_officer.orders.calender.create');
                });
                Route::group(['prefix'=>'notes'],function(){
                    Route::get('index/{order_id}',[App\Http\Controllers\procurement_officer\OrderNotesController::class, 'index'])->name('procurement_officer.orders.notes.index');
                    Route::post('create_order_notes', [App\Http\Controllers\procurement_officer\OrderNotesController::class, 'create_order_notes'])->name('procurement_officer.orders.notes.create_order_notes');
                    Route::get('edit_order_notes/{order_id}', [App\Http\Controllers\procurement_officer\OrderNotesController::class, 'edit_order_notes'])->name('procurement_officer.orders.notes.edit_order_notes');
                    Route::post('update_order_notes/{id}', [App\Http\Controllers\procurement_officer\OrderNotesController::class, 'update_order_notes'])->name('procurement_officer.orders.notes.update_order_notes');
                    Route::get('delete_order_notes/{order_id}', [App\Http\Controllers\procurement_officer\OrderNotesController::class, 'delete_order_notes'])->name('procurement_officer.orders.notes.delete_order_notes');
                    Route::post('edit_anchor_note', [App\Http\Controllers\procurement_officer\AnchorController::class, 'edit_anchor_note'])->name('procurement_officer.orders.notes.edit_note');
                    Route::post('edit_price_offer_note', [App\Http\Controllers\procurement_officer\PriceOfferController::class, 'edit_price_offer_note'])->name('procurement_officer.orders.notes.edit_price_offer_note');
                    Route::post('edit_cash_payment_note', [App\Http\Controllers\procurement_officer\FinancialFileController::class, 'edit_cash_payment_note'])->name('procurement_officer.orders.notes.edit_cash_payment_note');
                    Route::post('edit_letter_bank_note', [App\Http\Controllers\procurement_officer\FinancialFileController::class, 'edit_letter_bank_note'])->name('procurement_officer.orders.notes.edit_letter_bank_note');
                    Route::post('edit_shipping_note', [App\Http\Controllers\procurement_officer\ShippingController::class, 'edit_shipping_note'])->name('procurement_officer.orders.notes.edit_shipping_note');
                    Route::post('edit_letter_bank_modification_note', [App\Http\Controllers\procurement_officer\FinancialFileController::class, 'edit_letter_bank_modification_note'])->name('procurement_officer.orders.notes.edit_letter_bank_modification_note');
                    Route::post('edit_insurance_note', [App\Http\Controllers\procurement_officer\OrderInsuranceController::class, 'edit_insurance_note'])->name('procurement_officer.orders.notes.edit_insurance_note');
                    Route::post('edit_clearance_note', [App\Http\Controllers\procurement_officer\ClearanceController::class, 'edit_clearance_note'])->name('procurement_officer.orders.notes.edit_clearance_note');
                    Route::post('edit_delivery_note', [App\Http\Controllers\procurement_officer\DeliveryController::class, 'edit_delivery_note'])->name('procurement_officer.orders.notes.edit_delivery_note');
                    Route::post('edit_order_notes_note', [App\Http\Controllers\procurement_officer\OrderNotesController::class, 'edit_order_notes_note'])->name('procurement_officer.orders.notes.edit_order_notes_note');
                    Route::get('delete_note_from_order/{id}/{modal_name}', [App\Http\Controllers\users\ProcurmentOfficerController::class, 'delete_note_from_order'])->name('procurement_officer.orders.notes.delete_note_from_order');
                });
                Route::group(['prefix'=>'attachment'],function(){
                    Route::get('index/{order_id}', [App\Http\Controllers\procurement_officer\OrderAttachmentController::class, 'index'])->name('procurement_officer.orders.attachment.index');
                    Route::post('create_order_attachment', [App\Http\Controllers\procurement_officer\OrderAttachmentController::class, 'create_order_attachment'])->name('procurement_officer.orders.attachment.create_order_attachment');
                    Route::get('edit_order_attachment/{id}', [App\Http\Controllers\procurement_officer\OrderAttachmentController::class, 'edit_order_attachment'])->name('procurement_officer.orders.attachment.edit_order_attachment');
                    Route::get('delete_order_attachment/{id}', [App\Http\Controllers\procurement_officer\OrderAttachmentController::class, 'delete_order_attachment'])->name('procurement_officer.orders.attachment.delete_order_attachment');
                });
                Route::group(['prefix'=>'price_offer_items'],function(){
                    Route::post('create', [App\Http\Controllers\procurement_officer\PriceOfferItemsController::class, 'create'])->name('procurement_officer.orders.price_offer_items.create');
                    Route::post('add_or_update_bonus', [App\Http\Controllers\procurement_officer\PriceOfferItemsController::class, 'add_or_update_bonus'])->name('procurement_officer.orders.price_offer_items.add_or_update_bonus');
                    Route::post('add_or_update_discount', [App\Http\Controllers\procurement_officer\PriceOfferItemsController::class, 'add_or_update_discount'])->name('procurement_officer.orders.price_offer_items.add_or_update_discount');
                });
                Route::group(['prefix'=>'insurance'],function(){
                    Route::get('index/{order_id}', [App\Http\Controllers\procurement_officer\OrderInsuranceController::class, 'index'])->name('procurement_officer.orders.insurance.index');
                    Route::post('create', [App\Http\Controllers\procurement_officer\OrderInsuranceController::class, 'create'])->name('procurement_officer.orders.insurance.create');
                    Route::get('edit/{id}', [App\Http\Controllers\procurement_officer\OrderInsuranceController::class, 'edit'])->name('procurement_officer.orders.insurance.edit');
                    Route::post('update', [App\Http\Controllers\procurement_officer\OrderInsuranceController::class, 'update'])->name('procurement_officer.orders.insurance.update');
                    Route::get('delete/{id}', [App\Http\Controllers\procurement_officer\OrderInsuranceController::class, 'delete'])->name('procurement_officer.orders.insurance.delete');
                });
                Route::group(['prefix'=>'clearance'],function(){
                    Route::get('index/{order_id}', [App\Http\Controllers\procurement_officer\ClearanceController::class, 'index'])->name('procurement_officer.orders.clearance.index');
                    Route::post('create', [App\Http\Controllers\procurement_officer\ClearanceController::class, 'create'])->name('procurement_officer.orders.clearance.create');
                    Route::post('create_order_clearance_attachment', [App\Http\Controllers\procurement_officer\ClearanceController::class, 'create_order_clearance_attachment'])->name('procurement_officer.orders.clearance.create_order_clearance_attachment');
                    Route::post('delete_order_clearance_attachment', [App\Http\Controllers\procurement_officer\ClearanceController::class, 'delete_order_clearance_attachment'])->name('procurement_officer.orders.clearance.delete_order_clearance_attachment');
                    Route::post('update_to_null_order_clearance_attachment', [App\Http\Controllers\procurement_officer\ClearanceController::class, 'update_to_null_order_clearance_attachment'])->name('procurement_officer.orders.clearance.update_to_null_order_clearance_attachment');
                    Route::post('clearance_status', [App\Http\Controllers\procurement_officer\ClearanceController::class, 'clearance_status'])->name('procurement_officer.orders.clearance.clearance_status');
                    Route::post('clearance_notes', [App\Http\Controllers\procurement_officer\ClearanceController::class, 'clearance_notes'])->name('procurement_officer.orders.clearance.clearance_notes');
                    Route::get('get_clearance_table', [App\Http\Controllers\procurement_officer\ClearanceController::class, 'get_clearance_table'])->name('procurement_officer.orders.clearance.get_clearance_table');
                    Route::post('update', [App\Http\Controllers\procurement_officer\ClearanceController::class, 'update'])->name('procurement_officer.orders.clearance.update');
                    Route::get('delete/{id}', [App\Http\Controllers\procurement_officer\ClearanceController::class, 'delete'])->name('procurement_officer.orders.clearance.delete');
                });
                Route::group(['prefix'=>'delivery'],function(){
                    Route::get('index/{order_id}', [App\Http\Controllers\procurement_officer\DeliveryController::class, 'index'])->name('procurement_officer.orders.delivery.index');
                    Route::post('create', [App\Http\Controllers\procurement_officer\DeliveryController::class, 'create'])->name('procurement_officer.orders.delivery.create');
                    Route::get('edit/{id}', [App\Http\Controllers\procurement_officer\DeliveryController::class, 'edit'])->name('procurement_officer.orders.delivery.edit');
                    Route::post('update', [App\Http\Controllers\procurement_officer\DeliveryController::class, 'update'])->name('procurement_officer.orders.delivery.update');
                    Route::post('get_table_order_local_delivery_items', [App\Http\Controllers\procurement_officer\DeliveryController::class, 'get_table_order_local_delivery_items'])->name('procurement_officer.orders.delivery.get_table_order_local_delivery_items');
                    Route::post('create_order_local_delivery_items', [App\Http\Controllers\procurement_officer\DeliveryController::class, 'create_order_local_delivery_items'])->name('procurement_officer.orders.delivery.create_order_local_delivery_items');
                    Route::post('delete_order_local_delivery_items', [App\Http\Controllers\procurement_officer\DeliveryController::class, 'delete_order_local_delivery_items'])->name('procurement_officer.orders.delivery.delete_order_local_delivery_items');
                    Route::post('update_order_local_delivery_items', [App\Http\Controllers\procurement_officer\DeliveryController::class, 'update_order_local_delivery_items'])->name('procurement_officer.orders.delivery.update_order_local_delivery_items');
                    Route::get('delete/{id}', [App\Http\Controllers\procurement_officer\DeliveryController::class, 'delete'])->name('procurement_officer.orders.delivery.delete');
                });

                Route::group(['prefix'=>'forms'],function(){
                    Route::get('index/{order_id}', [App\Http\Controllers\procurement_officer\FormsController::class, 'index'])->name('procurement_officer.orders.forms.index');
                    Route::post('product_supplier_pdf', [App\Http\Controllers\procurement_officer\FormsController::class, 'product_supplier_pdf'])->name('procurement_officer.orders.forms.product_supplier_pdf');
                    Route::get('order_summery/{order_id}', [App\Http\Controllers\procurement_officer\FormsController::class, 'order_summery'])->name('procurement_officer.orders.forms.order_summery');
                });
                Route::group(['prefix'=>'invoices'],function(){
                    Route::get('index/{order_id}', [App\Http\Controllers\procurement_officer\InvoiceController::class, 'index'])->name('procurement_officer.orders.invoices.index');
                    Route::post('create', [App\Http\Controllers\procurement_officer\InvoiceController::class, 'create'])->name('procurement_officer.orders.invoices.create');
                });
            });
        });
        Route::group(['prefix' => 'storekeeper'], function () {
            Route::get('/index', [App\Http\Controllers\users\StorekeeperController::class, 'index'])->name('users.storekeeper.index');
            Route::get('/add', [App\Http\Controllers\users\StorekeeperController::class, 'add'])->name('users.storekeeper.add');
            Route::post('create', [App\Http\Controllers\users\StorekeeperController::class, 'create'])->name('users.storekeeper.create');
            Route::get('edit/{id}', [App\Http\Controllers\users\StorekeeperController::class, 'edit'])->name('users.storekeeper.edit');
            Route::post('update/{id}', [App\Http\Controllers\users\StorekeeperController::class, 'update'])->name('users.storekeeper.update');
            Route::get('details/{id}', [App\Http\Controllers\users\StorekeeperController::class, 'details'])->name('users.storekeeper.details');
            Route::get('personal_account/{id}', [App\Http\Controllers\users\StorekeeperController::class, 'personal_account'])->name('users.storekeeper.personal_account');
            Route::group(['prefix'=>'orders'],function(){
                Route::get('index',[App\Http\Controllers\storekeeper\OrderController::class,'index'])->name('users.storekeeper.orders.index');
            });
        });
        Route::group(['prefix' => 'secretarial'], function () {
            Route::get('/index', [App\Http\Controllers\users\SecretarialController::class, 'index'])->name('users.secretarial.index');
            Route::get('/add', [App\Http\Controllers\users\SecretarialController::class, 'add'])->name('users.secretarial.add');
            Route::post('create', [App\Http\Controllers\users\SecretarialController::class, 'create'])->name('users.secretarial.create');
            Route::get('edit/{id}', [App\Http\Controllers\users\SecretarialController::class, 'edit'])->name('users.secretarial.edit');
            Route::post('update/{id}', [App\Http\Controllers\users\SecretarialController::class, 'update'])->name('users.secretarial.update');
            Route::get('details/{id}', [App\Http\Controllers\users\SecretarialController::class, 'details'])->name('users.secretarial.details');
        });
        Route::group(['prefix' => 'supplier'], function () {
            Route::get('/index', [App\Http\Controllers\users\SupplierController::class, 'index'])->name('users.supplier.index');
            Route::post('/supplier_table', [App\Http\Controllers\users\SupplierController::class, 'supplier_table'])->name('users.supplier.supplier_table');
            Route::get('/add', [App\Http\Controllers\users\SupplierController::class, 'add'])->name('users.supplier.add');
            Route::post('create', [App\Http\Controllers\users\SupplierController::class, 'create'])->name('users.supplier.create');
            Route::get('edit/{id}', [App\Http\Controllers\users\SupplierController::class, 'edit'])->name('users.supplier.edit');
            Route::post('update/{id}', [App\Http\Controllers\users\SupplierController::class, 'update'])->name('users.supplier.update');
            Route::get('details/{id}', [App\Http\Controllers\users\SupplierController::class, 'details'])->name('users.supplier.details');
            Route::post('createProductSupplier', [App\Http\Controllers\users\SupplierController::class, 'createProductSupplier'])->name('users.supplier.createProductSupplier');
            Route::get('delete_product_supplier/{id}', [App\Http\Controllers\users\SupplierController::class, 'delete_product_supplier'])->name('users.supplier.delete_product_supplier');
            Route::post('create_for_supplier', [App\Http\Controllers\UsersFollowUpRecordsController::class, 'create_for_supplier'])->name('users.supplier.create_for_supplier');
            Route::get('delete_for_supplier/{id}', [App\Http\Controllers\UsersFollowUpRecordsController::class, 'delete_for_supplier'])->name('users.supplier.delete_for_supplier');
            Route::post('update_follow_by', [App\Http\Controllers\users\SupplierController::class, 'update_follow_by'])->name('users.supplier.update_follow_by');
            Route::post('product_search_ajax', [App\Http\Controllers\users\SupplierController::class, 'product_search_ajax'])->name('users.supplier.product_search_ajax');
            Route::post('product_list_ajax', [App\Http\Controllers\users\SupplierController::class, 'product_list_ajax'])->name('users.supplier.product_list_ajax');
            Route::post('add_to_product_supplier_ajax', [App\Http\Controllers\users\SupplierController::class, 'add_to_product_supplier_ajax'])->name('users.supplier.add_to_product_supplier_ajax');
            Route::group(['prefix' => 'company_contact_person'], function () {
                Route::get('edit/{id}', [App\Http\Controllers\users\SupplierController::class, 'contact_person_edit'])->name('users.supplier.contact_person_edit');
                Route::post('update', [App\Http\Controllers\users\SupplierController::class, 'contact_person_update'])->name('users.supplier.contact_person_update');
            });
            Route::group(['prefix' => 'bank_supplier'], function () {
                Route::post('create_bank_supplier', [App\Http\Controllers\users\SupplierController::class, 'create_bank_supplier'])->name('users.supplier.create_bank_supplier');
                Route::get('edit_bank_supplier/{id}', [App\Http\Controllers\users\SupplierController::class, 'edit_bank_supplier'])->name('users.supplier.edit_bank_supplier');
                Route::post('update_bank_supplier', [App\Http\Controllers\users\SupplierController::class, 'update_bank_supplier'])->name('users.supplier.update_bank_supplier');
                Route::get('delete_bank_supplier/{id}', [App\Http\Controllers\users\SupplierController::class, 'delete_bank_supplier'])->name('users.supplier.delete_bank_supplier');
            });
        });
        Route::group(['prefix' => 'delivery_company'], function () {
            Route::get('/index', [App\Http\Controllers\users\DeliveryCompanyController::class, 'index'])->name('users.delivery_company.index');
            Route::get('/add', [App\Http\Controllers\users\DeliveryCompanyController::class, 'add'])->name('users.delivery_company.add');
            Route::post('create', [App\Http\Controllers\users\DeliveryCompanyController::class, 'create'])->name('users.delivery_company.create');
            Route::get('edit/{id}', [App\Http\Controllers\users\DeliveryCompanyController::class, 'edit'])->name('users.delivery_company.edit');
            Route::post('update/{id}', [App\Http\Controllers\users\DeliveryCompanyController::class, 'update'])->name('users.delivery_company.update');
            Route::get('details/{id}', [App\Http\Controllers\users\DeliveryCompanyController::class, 'details'])->name('users.delivery_company.details');
        });
        Route::group(['prefix' => 'clearance_companies'], function () {
            Route::get('/index', [App\Http\Controllers\users\ClearanceCompaniesController::class, 'index'])->name('users.clearance_companies.index');
            Route::get('/add', [App\Http\Controllers\users\ClearanceCompaniesController::class, 'add'])->name('users.clearance_companies.add');
            Route::post('create', [App\Http\Controllers\users\ClearanceCompaniesController::class, 'create'])->name('users.clearance_companies.create');
            Route::get('edit/{id}', [App\Http\Controllers\users\ClearanceCompaniesController::class, 'edit'])->name('users.clearance_companies.edit');
            Route::post('update/{id}', [App\Http\Controllers\users\ClearanceCompaniesController::class, 'update'])->name('users.clearance_companies.update');
            Route::get('details/{id}', [App\Http\Controllers\users\ClearanceCompaniesController::class, 'details'])->name('users.clearance_companies.details');
        });
        Route::group(['prefix' => 'local_carriers'], function () {
            Route::get('/index', [App\Http\Controllers\users\LocalCarriersController::class, 'index'])->name('users.local_carriers.index');
            Route::get('/add', [App\Http\Controllers\users\LocalCarriersController::class, 'add'])->name('users.local_carriers.add');
            Route::post('create', [App\Http\Controllers\users\LocalCarriersController::class, 'create'])->name('users.local_carriers.create');
            Route::get('edit/{id}', [App\Http\Controllers\users\LocalCarriersController::class, 'edit'])->name('users.local_carriers.edit');
            Route::post('update/{id}', [App\Http\Controllers\users\LocalCarriersController::class, 'update'])->name('users.local_carriers.update');
            Route::get('details/{id}', [App\Http\Controllers\users\LocalCarriersController::class, 'details'])->name('users.local_carriers.details');
            Route::post('create_delivery_estimation_cost', [App\Http\Controllers\users\LocalCarriersController::class, 'create_delivery_estimation_cost'])->name('users.local_carriers.create_delivery_estimation_cost');
            Route::get('edit_delivery/{id}', [App\Http\Controllers\users\LocalCarriersController::class, 'edit_delivery'])->name('users.local_carriers.edit_delivery');
            Route::post('update_delivery', [App\Http\Controllers\users\LocalCarriersController::class, 'update_delivery'])->name('users.local_carriers.update_delivery');
            Route::get('delete_delivery/{id}', [App\Http\Controllers\users\LocalCarriersController::class, 'delete_delivery'])->name('users.local_carriers.delete_delivery');
        });
        Route::group(['prefix' => 'clients'], function () {
            Route::get('/index', [App\Http\Controllers\users\ClientsController::class, 'index'])->name('users.clients.index');
            Route::get('/add', [App\Http\Controllers\users\ClientsController::class, 'add'])->name('users.clients.add');
            Route::post('create', [App\Http\Controllers\users\ClientsController::class, 'create'])->name('users.clients.create');
            Route::get('edit/{id}', [App\Http\Controllers\users\ClientsController::class, 'edit'])->name('users.clients.edit');
            Route::post('update/{id}', [App\Http\Controllers\users\ClientsController::class, 'update'])->name('users.clients.update');
            Route::get('details/{id}', [App\Http\Controllers\users\ClientsController::class, 'details'])->name('users.clients.details');
        });
        Route::group(['prefix'=>'employees'],function(){
            Route::get('index',[App\Http\Controllers\hr\EmployeesController::class, 'index'])->name('users.employees.index');
            Route::get('add',[App\Http\Controllers\hr\EmployeesController::class, 'add'])->name('users.employees.add');
            Route::post('create',[App\Http\Controllers\users\EmployeesController::class, 'create'])->name('users.employees.create');
            Route::post('employee_table',[App\Http\Controllers\hr\EmployeesController::class, 'employee_table'])->name('users.employees.employee_table');
            Route::get('details/{id}',[App\Http\Controllers\hr\EmployeesController::class, 'details'])->name('users.employees.details');
            Route::get('edit/{id}',[App\Http\Controllers\hr\EmployeesController::class, 'edit'])->name('users.employees.edit');
            Route::group(['prefix'=>'rewards'],function(){
                Route::post('create',[App\Http\Controllers\hr\DiscountRewardController::class, 'create_reward'])->name('users.employees.rewards.create');
                Route::post('edit',[App\Http\Controllers\hr\DiscountRewardController::class, 'create_reward'])->name('users.employees.rewards.edit');
                Route::post('reward_change_date_by_ajax',[App\Http\Controllers\hr\DiscountRewardController::class, 'reward_change_date_by_ajax'])->name('users.employees.rewards.reward_change_date_by_ajax');
            });
            Route::group(['prefix'=>'discounts'],function(){
                Route::post('create',[App\Http\Controllers\hr\DiscountRewardController::class, 'create_discount'])->name('users.employees.discounts.create');
                Route::post('edit',[App\Http\Controllers\hr\DiscountRewardController::class, 'edit_discount'])->name('users.employees.discounts.edit');
                Route::post('discount_change_date_by_ajax',[App\Http\Controllers\hr\DiscountRewardController::class, 'discount_change_date_by_ajax'])->name('users.employees.discounts.discount_change_date_by_ajax');
            });
            Route::group(['prefix'=>'advances'],function(){
                Route::post('create',[App\Http\Controllers\hr\DiscountRewardController::class, 'create_advance'])->name('users.employees.advances.create');
                Route::post('edit',[App\Http\Controllers\hr\DiscountRewardController::class, 'edit_advance'])->name('users.employees.advances.edit');
                Route::post('advance_change_date_by_ajax',[App\Http\Controllers\hr\DiscountRewardController::class, 'advance_change_date_by_ajax'])->name('users.employees.advances.advance_change_date_by_ajax');
            });
            Route::group(['prefix'=>'vacations'],function(){
                Route::post('create',[App\Http\Controllers\hr\VacationsController::class, 'create'])->name('users.employees.vacations.create');
                Route::post('vacations_change_date_by_ajax',[App\Http\Controllers\hr\VacationsController::class, 'vacations_change_date_by_ajax'])->name('users.employees.vacations.vacations_change_date_by_ajax');
                Route::post('edit',[App\Http\Controllers\hr\VacationsController::class, 'edit'])->name('users.employees.vacations.edit');
            });
            Route::group(['prefix'=>'bonuses'],function(){
                Route::post('create',[App\Http\Controllers\hr\BonusesController::class, 'create'])->name('users.employees.bonuses.create');
                Route::post('edit',[App\Http\Controllers\hr\BonusesController::class, 'edit'])->name('users.employees.bonuses.edit');
            });
            Route::group(['prefix'=>'evaluations'],function(){
                Route::post('create',[App\Http\Controllers\hr\EvaluationsController::class, 'create'])->name('users.employees.evaluations.create');
                Route::post('edit',[App\Http\Controllers\hr\EvaluationsController::class, 'edit'])->name('users.employees.evaluations.edit');
            });
            Route::group(['prefix'=>'permanent_type'],function(){
                Route::post('update_permanent_type',[App\Http\Controllers\hr\WorkingHoursController::class, 'update_permanent_type'])->name('users.employees.permanent_type.update_permanent_type');
                Route::post('create_working_houre',[App\Http\Controllers\hr\WorkingHoursController::class, 'create_working_houre'])->name('users.employees.permanent_type.create_working_houre');
            });
        });
        // {-------------------------------------------------------------}//
    });
    Route::group(['prefix'=>'settings'],function (){
        Route::get('index',[App\Http\Controllers\dashboard\admin\settings\SettingsController::class , 'index'])->name('dashboard.settings.index');
        Route::group(['prefix'=>'cities'],function (){
            Route::get('index',[App\Http\Controllers\dashboard\admin\settings\CitiesController::class , 'index'])->name('dashboard.settings.cities.index');
            Route::post('create',[App\Http\Controllers\dashboard\admin\settings\CitiesController::class , 'create'])->name('dashboard.settings.cities.create');
            Route::post('get',[App\Http\Controllers\dashboard\admin\settings\CitiesController::class , 'get'])->name('dashboard.settings.cities.get');
            Route::post('update',[App\Http\Controllers\dashboard\admin\settings\CitiesController::class , 'update'])->name('dashboard.settings.cities.update');
        });
        Route::group(['prefix'=>'cars_type'],function (){
            Route::get('index',[App\Http\Controllers\dashboard\admin\settings\CarsTypeController::class , 'index'])->name('dashboard.settings.cars_type.index');
            Route::post('create',[App\Http\Controllers\dashboard\admin\settings\CarsTypeController::class , 'create'])->name('dashboard.settings.cars_type.create');
            Route::post('delete',[App\Http\Controllers\dashboard\admin\settings\CarsTypeController::class , 'delete'])->name('dashboard.settings.cars_type.delete');
            Route::post('update',[App\Http\Controllers\dashboard\admin\settings\CarsTypeController::class , 'update'])->name('dashboard.settings.cars_type.update');
            Route::get('car_models/{id}',[App\Http\Controllers\dashboard\admin\settings\CarsTypeController::class , 'car_models'])->name('dashboard.settings.cars_type.car_models');
            Route::post('createCarModel',[App\Http\Controllers\dashboard\admin\settings\CarsTypeController::class , 'createCarModel'])->name('dashboard.settings.cars_type.createCarModel');
            Route::post('deleteCarModel',[App\Http\Controllers\dashboard\admin\settings\CarsTypeController::class , 'deleteCarModel'])->name('dashboard.settings.cars_type.deleteCarModel');
            Route::post('updateCarModel',[App\Http\Controllers\dashboard\admin\settings\CarsTypeController::class , 'updateCarModel'])->name('dashboard.settings.cars_type.updateCarModel');
        });
    });
});
