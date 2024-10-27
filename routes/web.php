<?php

use Illuminate\Support\Facades\Route;

use App\Http\Middleware\UserRole;
use App\Http\Middleware\AdminRole;

use App\Livewire\Website\Pages\AccountType;
use App\Livewire\Website\Pages\Commodities;
use App\Livewire\Website\Pages\Contact;
use App\Livewire\Website\Pages\Forex;
use App\Livewire\Website\Pages\Homepage;
use App\Livewire\Website\Pages\IbPartner;
use App\Livewire\Website\Pages\Info;
use App\Livewire\Website\Pages\PaymentMethods;
use App\Livewire\Website\Pages\SyntheticIndices;

use App\Livewire\User\Account\Kyc;
use App\Livewire\User\Account\Profile;
use App\Livewire\User\Dashboard as UserDashboard;
use App\Livewire\User\Download;
use App\Livewire\User\Fund\Deposit;
use App\Livewire\User\Fund\Withdraw;
use App\Livewire\User\Help;
use App\Livewire\User\History\Deposit as HistoryDeposit;
use App\Livewire\User\History\Withdraw as HistoryWithdraw;

use App\Livewire\Admin\Dashboard as AdminDashboard;
use App\Livewire\Admin\Deposit\Requests as DepositRequests;
use App\Livewire\Admin\Deposit\Details as DepositDetails;
use App\Livewire\Admin\Withdrawal\Requests as WithdrawalRequests;
use App\Livewire\Admin\Withdrawal\Details as WithdrawalDetails;
use App\Livewire\Admin\User\Table as UserTable;
use App\Livewire\Admin\User\Profile as UserProfile;
use App\Livewire\Admin\User\PlanChangeRequest as UserPlanChangeRequest;
use App\Livewire\Admin\User\KYC\Requests as UserKycRequests;
use App\Livewire\Admin\User\KYC\Details as UserKycDetails;
use App\Livewire\Admin\Visitors as PageViews;
use App\Livewire\Admin\Settings\Help as AdminHelpSection;
use App\Livewire\Admin\Settings\Downloads as AdminDownloadsSection;

Route::any('test', function () {
    return print_r([
        'SERVER' => $_SERVER,
        'REQUEST' => $_REQUEST
    ]);
});
Route::get('/', Homepage::class)->name('homepage');
Route::get('info', Info::class)->name('info');
Route::get('account-type', AccountType::class)->name('accountType');
Route::get('id-partner', IbPartner::class)->name('ibPartner');
Route::get('contact', Contact::class)->name('contact');

Route::get('forex', Forex::class)->name('forex');
Route::get('synthetic-indices', SyntheticIndices::class)->name('syntheticIndices');
Route::get('commodities', Commodities::class)->name('commodities');
Route::get('payment-methods', PaymentMethods::class)->name('paymentMethods');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::middleware(UserRole::class)->group(function () {
        Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
            Route::get('dashboard', UserDashboard::class)->name('dashboard');

            Route::group(['prefix' => 'fund', 'as' => 'fund.'], function () {
                Route::get('deposit', Deposit::class)->name('deposit');
                Route::get('withdraw', Withdraw::class)->name('withdraw');
            });
            Route::group(['prefix' => 'history', 'as' => 'history.'], function () {
                Route::get('deposit', HistoryDeposit::class)->name('deposit');
                Route::get('withdraw', HistoryWithdraw::class)->name('withdraw');
            });
            Route::group(['prefix' => 'account', 'as' => 'account.'], function () {
                Route::get('profile', Profile::class)->name('profile');
                Route::get('kyc', Kyc::class)->name('kyc');
            });

            Route::get('downloads', Download::class)->name('downloads');
            Route::get('help', Help::class)->name('help');

            Route::get('/', function () {
                return redirect('/user/dashboard');
            });
        });
    });
    Route::middleware(AdminRole::class)->prefix('admin')->group(function () {
        Route::group(['as' => 'admin.'], function () {
            Route::get('dashboard', AdminDashboard::class)->name('dashboard');

            Route::group(['prefix' => 'deposit', 'as' => 'deposit.'], function () {
                Route::get('requests', DepositRequests::class)->name('requests');
                Route::get('detail/{id}', DepositDetails::class)->name('detail');

                Route::get('/', function () {
                    return redirect('/admin/deposit/requests');
                });
            });

            Route::group(['prefix' => 'withdrawal', 'as' => 'withdrawal.'], function () {
                Route::get('requests', WithdrawalRequests::class)->name('requests');
                Route::get('detail/{id}', WithdrawalDetails::class)->name('detail');

                Route::get('/', function () {
                    return redirect('/admin/withdrawal/requests');
                });
            });

            Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
                Route::get('all', UserTable::class)->name('table');
                Route::get('profile/{id}', UserProfile::class)->name('profile');
                Route::get('plan-change', UserPlanChangeRequest::class)->name('plans');
                Route::group(['prefix' => 'kyc', 'as' => 'kyc.'], function () {
                    Route::get('requests', UserKycRequests::class)->name('requests');
                    Route::get('detail/{id}', UserKycDetails::class)->name('detail');

                    Route::get('/', function () {
                        return redirect('/admin/user/kyc/requests');
                    });
                });

                Route::get('/', function () {
                    return redirect('/admin/user/all');
                });
            });

            Route::get('visitors', PageViews::class)->name('visitors');

            Route::group(['prefix' => 'settings', 'as' => 'settings.'], function () {
                Route::get('downloads', AdminDownloadsSection::class)->name('downloads');
                Route::get('help', AdminHelpSection::class)->name('help');

                Route::get('/', function () {
                    return redirect('/admin/settings/help');
                });
            });
            Route::get('/', function () {
                return redirect('/admin/dashboard');
            });
        });
    });
});
