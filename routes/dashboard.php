<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\AuthController;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\Dashboard\StaffController;
use App\Http\Controllers\Dashboard\ReportsController;


use App\Http\Controllers\Dashboard\MerchantsController;
use App\Http\Controllers\Dashboard\DistributorsController;
use App\Http\Controllers\Dashboard\ServicesController;
use App\Http\Controllers\Dashboard\CompaniesController;
use App\Http\Controllers\Dashboard\CardsServiceCompaniesController;
use App\Http\Controllers\Dashboard\CardMainCategoriesController;
use App\Http\Controllers\Dashboard\CardCategoriesController;
use App\Http\Controllers\Dashboard\CardsController;

use App\Http\Controllers\Dashboard\IndebtednessController;
use App\Http\Controllers\Dashboard\CollectIndebtednessController;
use App\Http\Controllers\Dashboard\CompensationController;
use App\Http\Controllers\Dashboard\PledgesController;
use App\Http\Controllers\Dashboard\CollectPledgesController;

use App\Http\Controllers\Dashboard\AddCreditRequestsController;
use App\Http\Controllers\Dashboard\ProfitWithdrawalRequestsController;
use App\Http\Controllers\Dashboard\MerchantPackagesController;
use App\Http\Controllers\Dashboard\HelpController;
use App\Http\Controllers\Dashboard\UserTransactionsController;


use App\Http\Controllers\Dashboard\SettingsController;
use App\Http\Controllers\Dashboard\ContactUsController;
use App\Http\Controllers\Dashboard\CommonController;
use App\Http\Controllers\Dashboard\RolesController;
use App\Http\Controllers\Dashboard\AjaxController;



Route::get('dashboard/login', [AuthController::class, 'login_page'])->middleware('guest');
Route::post('dashboard/login', [AuthController::class, 'login'])->middleware('guest')->name('dashboard.login');
Route::post('dashboard/logout', [AuthController::class, 'logout'])->middleware('auth:web')->name('dashboard.logout');

Route::get('forgot-password', [AuthController::class, 'forgot_password_page'])->middleware('guest')->name('password.request');
Route::post('forgot-password', [AuthController::class, 'forgot_password'])->middleware('guest')->name('password.email');
Route::get('/reset-password/{token}', [AuthController::class, 'reset_password_token'])->middleware('guest')->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'reset_password'])->middleware('guest')->name('password.update');

Route::middleware(['auth:web'])->prefix('dashboard')->name('dashboard.')->group(function () {


    Route::get('home', [HomeController::class, 'index'])->name('home');



    Route::get('reports', [ReportsController::class, 'index'])->name('reports.index');
    Route::post('items-report', [ReportsController::class, 'items_report'])->name('items-report');
    Route::post('products-report', [ReportsController::class, 'products_report'])->name('products-report');
    Route::post('representatives-report', [ReportsController::class, 'representatives_report'])->name('representatives-report');
    Route::post('representative-report', [ReportsController::class, 'representative_report'])->name('representative-report');
    Route::post('representative-general-report', [ReportsController::class, 'representative_general_report'])->name('representative-general-report');
    Route::post('representative-governorate-report', [ReportsController::class, 'representative_governorate_report'])->name('representative-governorate-report');
    Route::post('representative-city-report', [ReportsController::class, 'representative_city_report'])->name('representative-city-report');



    Route::post('doctors-report', [ReportsController::class, 'doctors_report'])->name('doctors-report');
    Route::post('specialties-visits-report', [ReportsController::class, 'specialties_report'])->name('specialties-visits-report');



    Route::post('representative-visits-report', [ReportsController::class, 'representative_visits_report'])->name('representative-visits-report');










    Route::get('settings/general', [SettingsController::class, 'general_settings_edit'])->name('settings.general');
    Route::put('settings/general/update', [SettingsController::class, 'general_settings_update'])->name('settings.general.update');
    Route::get('settings/merchants-app', [SettingsController::class, 'merchants_app_edit'])->name('settings.merchants-app');
    Route::put('settings/merchants-app/update', [SettingsController::class, 'merchants_app_update'])->name('settings.merchants-app.update');
    Route::get('settings/distributors-app', [SettingsController::class, 'distributors_app_edit'])->name('settings.distributors-app');
    Route::put('settings/distributors-app/update', [SettingsController::class, 'distributors_app_update'])->name('settings.distributors-app.update');
    Route::get('settings/smtp', [SettingsController::class, 'smtp'])->name('settings.smtp');
    Route::put('settings/smtp/update', [SettingsController::class, 'smtp_update'])->name('settings.smtp.update');
    Route::post('settings/smtp/test', [SettingsController::class, 'send_test_email'])->name('settings.smtp.test');

    Route::resource('roles', RolesController::class);

    Route::get('dark-mode-update', [ProfileController::class, 'dark_mode_update'])->name('profile.dark-mode-update');
    
    Route::get('profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('profile/{id}/info-update', [ProfileController::class, 'info_update'])->name('profile.info-update');

    Route::resource('staff', StaffController::class);
    Route::put('staff/{id}/update-info', [StaffController::class, 'update_info'])->name('staff.update-info');

  
    Route::resource('merchants', MerchantsController::class);
    Route::resource('distributors', DistributorsController::class);

    Route::resource('companies', CompaniesController::class);
    Route::resource('services', ServicesController::class);
    Route::resource('cards-service-companies', CardsServiceCompaniesController::class);
    Route::put('service-status-update/{id}', [ServicesController::class, 'service_status_update'])->name('service-status-update');



 
    Route::resource('card-main-categories', CardMainCategoriesController::class)->except(['create', 'index']);
    Route::get('company-card-main-categories/{company_id}/index', [CardMainCategoriesController::class, 'index'])->name('card-main-categories.index');
    Route::get('company-card-main-categories/{company_id}/create', [CardMainCategoriesController::class, 'create'])->name('card-main-categories.create');


    Route::resource('card-categories', CardCategoriesController::class)->except(['create', 'index']);
    Route::get('company-card-categories/{company_id}/index', [CardCategoriesController::class, 'index'])->name('card-categories.index');
    Route::get('company-card-categories/{company_id}/create', [CardCategoriesController::class, 'create'])->name('card-categories.create');


    Route::resource('cards', CardsController::class)->except(['create', 'index']);
    Route::get('cards/{category_id}/index'  , [CardsController::class, 'index'])->name('cards.index');
    Route::get('cards/{category_id}/create', [CardsController::class, 'create'])->name('cards.create');
    Route::post('cards-import', [CardsController::class, 'import'])->name('cards-import');




    Route::resource('indebtedness', IndebtednessController::class);
    Route::resource('collect-indebtedness', CollectIndebtednessController::class);

    Route::resource('compensation', CompensationController::class);
    Route::resource('pledges', PledgesController::class);
    Route::resource('collect-pledges', CollectPledgesController::class);
    Route::resource('merchant-packages', MerchantPackagesController::class);


    Route::resource('profit-withdrawal-requests', ProfitWithdrawalRequestsController::class);
    Route::get('new-profit-withdrawal-requests', [ProfitWithdrawalRequestsController::class, 'new_requests'])->name('profit-withdrawal-requests.new');
    Route::get('watched-profit-withdrawal-requests', [ProfitWithdrawalRequestsController::class, 'watched_requests'])->name('profit-withdrawal-requests.watched');
    Route::get('accepted-profit-withdrawal-requests', [ProfitWithdrawalRequestsController::class, 'accepted_requests'])->name('profit-withdrawal-requests.accepted');
    Route::get('transferred-profit-withdrawal-requests', [ProfitWithdrawalRequestsController::class, 'transferred_requests'])->name('profit-withdrawal-requests.transferred');
    Route::get('rejected-profit-withdrawal-requests', [ProfitWithdrawalRequestsController::class, 'rejected_requests'])->name('profit-withdrawal-requests.rejected');


    Route::resource('add-credit-withdrawal-requests', AddCreditRequestsController::class);
    Route::get('new-add-credit-withdrawal-requests', [AddCreditRequestsController::class, 'new_requests'])->name('add-credit-withdrawal-requests.new');
    Route::get('watched-add-credit-withdrawal-requests', [AddCreditRequestsController::class, 'watched_requests'])->name('add-credit-withdrawal-requests.watched');
    Route::get('accepted-add-credit-withdrawal-requests', [AddCreditRequestsController::class, 'accepted_requests'])->name('add-credit-withdrawal-requests.accepted');
    Route::get('transferred-add-credit-withdrawal-requests', [AddCreditRequestsController::class, 'transferred_requests'])->name('add-credit-withdrawal-requests.transferred');
    Route::get('rejected-add-credit-withdrawal-requests', [AddCreditRequestsController::class, 'rejected_requests'])->name('add-credit-withdrawal-requests.rejected');


    Route::resource('help', HelpController::class);
    Route::get('new-help', [HelpController::class, 'new_help'])->name('help.new');
    Route::get('watched-help', [HelpController::class, 'watched_help'])->name('help.watched');
    Route::get('accepted-help', [HelpController::class, 'accepted_help'])->name('help.accepted');
    Route::get('transferred-help', [HelpController::class, 'transferred_help'])->name('help.transferred');
    Route::get('rejected-help', [HelpController::class, 'rejected_help'])->name('help.rejected');


    Route::get('user-transactions/{user_id}/all-transactions', [UserTransactionsController::class, 'all_transactions'])->name('user-transactions.all-transactions');
    Route::get('user-transactions/{transaction_id}/show', [UserTransactionsController::class, 'show_transaction'])->name('user-transactions.show');


    Route::get('user-transactions/{user_id}/all-pledges', [UserTransactionsController::class, 'all_pledges'])->name('user-transactions.all-pledges');
    Route::get('user-transactions/{user_id}/collect-pledges', [UserTransactionsController::class, 'collect_pledges'])->name('user-transactions.collect-pledges');

    Route::get('user-transactions/{user_id}/all-indebtedness', [UserTransactionsController::class, 'all_indebtedness'])->name('user-transactions.all-indebtedness');
    Route::get('user-transactions/{user_id}/collect-indebtedness', [UserTransactionsController::class, 'collect_indebtedness'])->name('user-transactions.collect-indebtedness');
    Route::get('user-transactions/{user_id}/show-indebtedness', [UserTransactionsController::class, 'show_indebtedness'])->name('user-transactions.show-indebtedness');


    Route::get('user-transactions/{user_id}/all-compensation', [UserTransactionsController::class, 'all_compensation'])->name('user-transactions.all-compensation');
    Route::get('user-transactions/{user_id}/show-compensation', [UserTransactionsController::class, 'show_compensation'])->name('user-transactions.show-compensation');

    Route::get('user-transactions/{user_id}/all-profit-withdrawal-requests', [UserTransactionsController::class, 'all_profit_withdrawal_requests'])->name('user-transactions.all-profit-withdrawal-requests');
    Route::get('user-transactions/{user_id}/show-profit-withdrawal-request', [UserTransactionsController::class, 'show_profit_withdrawal_request'])->name('user-transactions.show-profit-withdrawal-request');

    Route::get('user-transactions/{user_id}/all-add-credit-withdrawal-requests', [UserTransactionsController::class, 'all_add_credit_withdrawal_requests'])->name('user-transactions.all-add-credit-withdrawal-requests');
    Route::get('user-transactions/{user_id}/show-add-credit-withdrawal-request', [UserTransactionsController::class, 'show_add_credit_withdrawal_request'])->name('user-transactions.show-add-credit-withdrawal-request');






    Route::get('image-delete/{id}', [CommonController::class, 'image_delete'])->name('common.image-delete');



    Route::resource('contact-us', ContactUsController::class);
});