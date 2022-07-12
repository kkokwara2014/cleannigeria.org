<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Impersonate;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\PrintController;
use App\Http\Controllers\ScrapController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\HsriskController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\MachineController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TraineeController;
use App\Http\Controllers\WaybillController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\TransferController;
use App\Http\Controllers\BiometricController;
use App\Http\Controllers\ContactusController;
use App\Http\Controllers\DirectoryController;
use App\Http\Controllers\HsriskmgtController;
use App\Http\Controllers\NewsmediaController;
use App\Http\Controllers\ReplenishController;
use App\Http\Controllers\WorkorderController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DispersantController;
use App\Http\Controllers\FatrainingController;
use App\Http\Controllers\ForkliftopController;
use App\Http\Controllers\GastestingController;
use App\Http\Controllers\GovernanceController;
use App\Http\Controllers\LoginauditController;
use App\Http\Controllers\ManageuserController;
use App\Http\Controllers\MobrequestController;
use App\Http\Controllers\IncidentmgtController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\MembcompanyController;
use App\Http\Controllers\SocialShareController;
use App\Http\Controllers\AccessDeniedController;
use App\Http\Controllers\BiotimesheetController;
use App\Http\Controllers\EmployeeinfoController;
use App\Http\Controllers\FateoilskillController;
use App\Http\Controllers\HazardreportController;
use App\Http\Controllers\KeypersonnelController;
use App\Http\Controllers\MachinemaintController;
use App\Http\Controllers\MaintrequestController;
use App\Http\Controllers\SelfloaderopController;
use App\Http\Controllers\TrainingcertController;
use App\Http\Controllers\MaintscheduleController;
use App\Http\Controllers\ResponseequipController;
use App\Http\Controllers\SafetycultureController;
use App\Http\Controllers\ActiontrackingController;
use App\Http\Controllers\InlandresponseController;
use App\Http\Controllers\MultipleRecordController;
use App\Http\Controllers\VisitorbookingController;
use App\Http\Controllers\EquipmentmanualController;
use App\Http\Controllers\MaintdequipmentController;
use App\Http\Controllers\PowerdrivenscopController;
use App\Http\Controllers\ScannerlocationController;
use App\Http\Controllers\OffshoreresponseController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\HsworkenvironmentController;
use App\Http\Controllers\MasterdocregisterController;
use App\Http\Controllers\MiscinnorespskillController;
use App\Http\Controllers\OperationhandoverController;
use App\Http\Controllers\ShorelineresponseController;
use App\Http\Controllers\SubmittedComptassController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\ImpactoilpollutionController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\MobilizationrequestController;
use App\Http\Controllers\CompetenceassessmentController;
use App\Http\Controllers\SurvmodelvisualizationController;
use App\Http\Controllers\CertificateVerificationController;
use App\Http\Controllers\PrintCompetenceAssessmentController;

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

Route::get('inventory/login', [LoginController::class,'showLoginForm'])->name('login');
Route::post('inventory/login', [LoginController::class,'authenticate']);


// Password Reset Routes...
Route::get('password/reset', [ForgotPasswordController::class,'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class,'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class,'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class,'reset'])->name('password.update');


Route::get('email/verify', [VerificationController::class,'show'])->name('verification.notice');
Route::get('email/verify/{id}', [VerificationController::class,'verify'])->name('verification.verify');
Route::get('email/resend', [VerificationController::class,'resend'])->name('verification.resend');


Route::get('/logout', [LoginController::class,'userLogout'])->name('user.logout');
Route::post('/logout', [LoginController::class,'logout'])->name('logout');


// Auth::routes(['register'=>false]);

Route::get('/',[FrontendController::class,'index'])->name('index');


// for about routes
Route::group(['prefix' => 'about'], function () {

    Route::get('/base-operation',[AboutController::class,'baseoperation'])->name('baseoperation');
    Route::get('/our-objectives',[AboutController::class,'cnaobjectives'])->name('cnaobjectives');
    Route::get('/member-companies',[AboutController::class,'membercompanies'])->name('membercompanies');
    Route::get('/membership',[AboutController::class,'membership'])->name('membership');
    Route::get('/equipment/gallery',[AboutController::class,'gallery'])->name('gallery');
    Route::get('/our-services',[AboutController::class,'services'])->name('services');
    Route::get('/key-staff',[AboutController::class,'keystaff'])->name('keystaff');
});
 //for news and media
Route::group(['prefix' => 'news_and_media'], function () {
    Route::get('/events',[NewsmediaController::class,'events'])->name('events');
    Route::get('/news',[NewsmediaController::class,'news'])->name('news');
    Route::get('/news/{slug}',[NewsmediaController::class,'show'])->name('news_show');


    Route::get('/news/download/{filename}', [NewsmediaController::class,'file'])->name('download.news');

    Route::get('/newsletter',[NewsmediaController::class,'newsletter'])->name('newsletter');
    Route::get('/resources',[NewsmediaController::class,'mediaresources'])->name('mediares');

    Route::get('/share-on-social-media/{slug}',[SocialShareController::class,'socialshare'])->name('socialshare');
});

Route::get('governance',[GovernanceController::class,'governance'])->name('governance');
Route::get('safety/policies',[SafetycultureController::class,'policies'])->name('safetypolicies');


//for contacting CNA
Route::get('contact/us',[ContactusController::class,'create'])->name('contactus');

Route::post('contact/us/save',[ContactusController::class,'store'])->name('contactus.save')->middleware(ProtectAgainstSpam::class);

//for mobilization request
Route::get('mobilization/request',[MobrequestController::class,'create'])->name('mobrequest');
Route::post('mobilization/request/save',[MobrequestController::class,'store'])->name('mobrequest.save')->middleware(ProtectAgainstSpam::class);


Route::group(['prefix' => 'download'], function () {
    Route::get('/document/{filename}', [DownloadController::class,'document'])->name('downloaddoc');
});

//certificate verification
Route::get('verify/certificate', [CertificateVerificationController::class,'verifycertificateform'])->name('certificateverifyform');
Route::post('verify-certificate',[CertificateVerificationController::class,'checkcertificate'])->name('verify.certificate');
Route::get('download/trainee/certificate/{filename}',[CertificateVerificationController::class,'downloadtraineecertificate'])->name('download.trainee.certificate');


// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'dashboard','middleware' => ['auth','staffaccess']], function() {
    Route::get('/',[HomeController::class,'index'])->name('dashboard.index');
    // Route::resource('biometric', BiometricController::class);
    Route::get('biometric', [BiometricController::class, 'index'])->name('bio.home');
    Route::get('biometric/store', [BiometricController::class, 'store'])->name('bio.store');
    Route::get('biometric/capture', [BiometricController::class, 'create'])->name('bio.create');
    Route::get('biometric/add', [BiometricController::class, 'add'])->name('bio.add');
    Route::get('biometric/all', [BiometricController::class, 'show'])->name('bio.all');
    Route::delete('biometric/delete/{user_id}', [BiometricController::class, 'destroy'])->name('bio.destroy');

    Route::post('scanner/location', [ScannerlocationController::class, 'store'])->name('scanner.store');
    Route::get('scanner/location', [ScannerlocationController::class, 'index'])->name('scanner.locations');
    Route::delete('scanner/location/delete/{localion_id}', [ScannerlocationController::class, 'destroy'])->name('scanner.destroy');

    Route::get('biotime/system', [BiotimesheetController::class, 'index'])->name('bio.timesys');
    Route::get('biotime/store', [BiotimesheetController::class, 'store'])->name('biotimesys.store');
    Route::get('biotime/camkey', [BiotimesheetController::class, 'camskey'])->name('cam.key');
    Route::get('print/bio/{user_id}/{date}/{print_type}',[BiotimesheetController::class,'print'])->name('print.bio');

    Route::get('biotimesheet/report', [BiotimesheetController::class, 'report'])->name('timesheet.report');
    Route::get('biotimesheet/monthly/report/{user}/{date}', [BiotimesheetController::class, 'monthlyReport'])->name('timesheet.monthly.report');
    Route::get('biotimesheet/yearly/report/{user}/{date}', [BiotimesheetController::class, 'yearlyReport'])->name('timesheet.yearly.report');
    
    Route::middleware(['admin'])->group(function () {
        Route::get('/impersonate/user/{id}',[Impersonate::class,'index'])->name('staff.impersonate');
        Route::resource('manageusers', ManageuserController::class,['except'=>['show','create','store']]);      
    });
    
    //getting and updating user profile
    Route::get('/update/profile',[ProfileController::class,'updateprofile'])->name('update.profile');
    Route::put('/update/profile/{id}',[ProfileController::class,'profileupdated'])->name('profile.updated');
    
    Route::get('/user/profile',[ProfileController::class,'userprofile'])->name('userprofile');
    Route::post('/upload/user/profile-image/{id}',[ProfileController::class,'uploadprofileimage'])->name('uploadprofileimage');
    Route::get('/staff/profile/{id}',[ProfileController::class,'staffprofile'])->name('staffprofile');

    Route::resource('roles',RoleController::class);
    Route::resource('staff',StaffController::class);
    Route::post('staff/{id}/activate', [StaffController::class,'activate'])->name('staff.activate');
    Route::post('staff/{id}/deactivate', [StaffController::class,'deactivate'])->name('staff.deactivate');

    //editing staff details
    Route::get('edit/staff/{id}/details',[StaffController::class,'editStaffDetails'])->name('edit.staff.details');
    Route::put('update/staff/edited/{id}/details',[StaffController::class,'updateStaffDetails'])->name('update.edited.details');

    Route::get('/view/uploaded-document/{filename}', [StaffController::class,'viewuploadedfile'])->name('view.uploadedfile');
    //change password
    Route::post('/change-password',[StaffController::class,'changeStaffPassword'])->name('password.change');

    Route::get('/comptassessment/details/{comptassid}/{staffid}',[StaffController::class,'showcomptass'])->name('comptass.show');

    Route::get('all/admins', [AdminController::class,'admins'])->name('all.admin');

    Route::get('admins/{id}/show', [AdminController::class,'show'])->name('admins.show');
    Route::post('admins/{id}/activate', [AdminController::class,'activate'])->name('admins.activate');
    Route::post('admins/{id}/deactivate', [AdminController::class,'deactivate'])->name('admins.deactivate');

    Route::get('user/profile', [UserController::class,'profileimage'])->name('user.profile');
    Route::post('user/profile', [UserController::class,'updateprofileimage'])->name('user.profile.update');

    Route::resource('keypersonnel', KeypersonnelController::class);

    //create new grouped route for these routes
    Route::resource('gallery', GalleryController::class);
    Route::resource('membcompany', MembcompanyController::class);
    Route::resource('service', ServiceController::class);
    Route::resource('contact', ContactController::class);
    Route::resource('mobilizationrequest', MobilizationrequestController::class);
    
    Route::resource('news', NewsController::class);
    Route::get('/download/news-file/{filename}', [NewsController::class,'newsfiledownload'])->name('newsfile.download');

    Route::post('news/{id}/approve', [NewsController::class,'approve'])->name('news.approve');

    Route::resource('location',LocationController::class);
    Route::resource('category',CategoryController::class);
    Route::resource('store',StoreController::class);
    Route::resource('employees',EmployeeinfoController::class);
    Route::resource('supplier',SupplierController::class);

    // Route::resource('manageusers', ManageuserController::class,['except'=>['show','create','store']]);
    Route::get('/login/trails',[LoginauditController::class,'index'])->name('login.details');


    

    Route::resource('transfer', TransferController::class);
    Route::post('transfer/{id}/approve', [TransferController::class,'approve'])->name('transfer.approve');
    Route::resource('scrap', ScrapController::class);
    Route::post('scrap/{id}/approve', [ScrapController::class,'approve'])->name('scrap.approve');
    Route::post('equipment/{id}/unscrap', [ScrapController::class,'unscrap'])->name('srequipment.unscrap');
    Route::resource('replenish', ReplenishController::class);
    Route::post('replenish/{id}/approve', [ReplenishController::class,'approve'])->name('replenish.approve');
    Route::resource('maintenance', MaintenanceController::class);
    Route::post('maintenance/{id}/confirm', [MaintenanceController::class,'confirm'])->name('maintenance.confirm');
    Route::post('maintenance/{id}/approve', [MaintenanceController::class,'approve'])->name('maintenance.approve');
    
    
    Route::resource('leave', LeaveController::class);
    Route::post('leave/{id}/confirm', [LeaveController::class,'confirm'])->name('leave.confirm');
    Route::get('approved/leaves/by-you',[LeaveController::class,'trackapprovedleaves'])->name('track.approvedleaves');
    Route::get('approved/leaves',[LeaveController::class,'approvedLeaves'])->name('all.approvedleaves');
    Route::get('all/approved/leaves',[LeaveController::class,'allapprovedleaves'])->name('allapprovedleaves');



   //Competence Assessment
   Route::resource('competenceassessment', CompetenceassessmentController::class);
   Route::get('competenceassessment/{id}/publish', [CompetenceassessmentController::class,'publish'])->name('compassessment.publish');
   Route::get('competenceassessment/{id}/unpublish', [CompetenceassessmentController::class,'unpublish'])->name('compassessment.unpublish');
   Route::get('/published/competenceassessment', [CompetenceassessmentController::class,'publishedcomptass'])->name('publishedcomptass');
   Route::get('/fill/competenceassessment/{slug}', [CompetenceassessmentController::class,'fillcomptassform'])->name('fillcomptassform');
   Route::put('/competenceassessment/{slug}/edit',[CompetenceassessmentController::class,'update'])->name('compassessment.update');

   //new routes
   Route::get('/select-comptass-year-for/submitted-comptasss',[SubmittedComptassController::class,'selectcomptassyear'])->name('select.comptass.year');
   Route::post('/all/submitted-comptass',[SubmittedComptassController::class,'yearlysubmittedcomptasss'])->name('yearlysubmitted.comptass');
   
   
   Route::get('/select-comptass/submitted-by-you',[SubmittedComptassController::class,'getsomptassbyyou'])->name('select.comptass.byyou');
   Route::post('/all/submitted-comptass/by-you',[SubmittedComptassController::class,'yearlysubmittedcomptasssbyyou'])->name('yearlysubmitted.comptass.byyou');
   
   Route::get('/comptass/submitted-by-you',[SubmittedComptassController::class,'comptassbyyou'])->name('comptassbyyou');
   Route::get('/comptass/submitted-to-you',[SubmittedComptassController::class,'comptassforyou'])->name('comptassforyou');
   Route::get('/comptass/submitted-for-reassessment',[SubmittedComptassController::class,'senttosuperior'])->name('senttosuperior');
   Route::get('/comptass/submitted-for-final-assessment',[SubmittedComptassController::class,'senttogm'])->name('senttogm');
   
   Route::get('/make/final/assessment/{comptassid}/{user_id}',[SubmittedComptassController::class,'makefinalassessment'])->name('makefinalassessment');

//    end of new routes

   Route::post('change/assessor','ChangeAssessorController@changeassessor')->name('assessor.change');

   Route::get('/submitted-competenceassessment',[CompetenceassessmentController::class,'submittedcomptass'])->name('submitted.comptass');
   Route::delete('/delete/submitted-comptass/{comptassid}/{user_id}',[CompetenceassessmentController::class,'deletesubmittedcomptass'])->name('delete.submitted.comptass');
   Route::post('/approve/assessed-comptass/{comptassid}/{user_id}',[CompetenceassessmentController::class,'approveassessedcomptass'])->name('approve.assessed.comptass');

   Route::get('print/approve/competence-assessment/{comptassid}/{user_id}',[PrintCompetenceAssessmentController::class,'printapproveassessedcomptass'])->name('print.approved.competenceassessment');
    
    
    Route::group(['prefix' => 'hsworkingenvironment'], function() {
        Route::post('/save',[HsworkenvironmentController::class,'store'])->name('hsworkenv.store');
        Route::get('/edit/{id}/{slug}',[HsworkenvironmentController::class,'edit'])->name('hsworkenv.edit');
        Route::post('/update/{id}/{slug}',[HsworkenvironmentController::class,'update'])->name('hsworkenv.update');
        Route::delete('/delete/{id}',[HsworkenvironmentController::class,'destroy'])->name('hsworkenv.delete');
        Route::post('/save/assessment',[HsworkenvironmentController::class,'saveassessment'])->name('hsworkenv.saveassessment');
        Route::post('/save/second/assessment',[HsworkenvironmentController::class,'savesecondassessment'])->name('hsworkenv.savesecondassessment');
        Route::post('/save/assessmentbygm',[HsworkenvironmentController::class,'saveassessmentbygm'])->name('hsworkenv.saveassessmentbygm');
        //
    });
    
    Route::group(['prefix' => 'hsrisk'], function() {
        Route::post('/save',[HsriskController::class,'store'])->name('hsrisk.store');
        Route::get('/edit/{id}/{slug}',[HsriskController::class,'edit'])->name('hsrisk.edit');
        Route::post('/update/{id}/{slug}',[HsriskController::class,'update'])->name('hsrisk.update');
        Route::delete('/delete/{id}',[HsriskController::class,'destroy'])->name('hsrisk.delete');
        Route::post('/save/assessment',[HsriskController::class,'saveassessment'])->name('hsrisk.saveassessment');
        Route::post('/save/second/assessment',[HsriskController::class,'savesecondassessment'])->name('hsrisk.savesecondassessment');
        Route::post('/save/assessmentbygm',[HsriskController::class,'saveassessmentbygm'])->name('hsrisk.saveassessmentbygm');
    });

    Route::group(['prefix' => 'hsriskmgt'], function() {
        Route::post('/save',[HsriskmgtController::class,'store'])->name('hsriskmgt.store');
        Route::get('/edit/{id}/{slug}',[HsriskmgtController::class,'edit'])->name('hsriskmgt.edit');
        Route::post('/update/{id}/{slug}',[HsriskmgtController::class,'update'])->name('hsriskmgt.update');
        Route::delete('/delete/{id}',[HsriskmgtController::class,'destroy'])->name('hsriskmgt.delete');
        Route::post('/save/assessment',[HsriskmgtController::class,'saveassessment'])->name('hsriskmgt.saveassessment');
        Route::post('/save/second/assessment',[HsriskmgtController::class,'savesecondassessment'])->name('hsriskmgt.savesecondassessment');
        Route::post('/save/assessmentbygm',[HsriskmgtController::class,'saveassessmentbygm'])->name('hsriskmgt.saveassessmentbygm');
    });

    Route::group(['prefix' => 'fatraining'], function() {
        Route::post('/save',[FatrainingController::class,'store'])->name('fatraining.store');
        Route::get('/edit/{id}/{slug}',[FatrainingController::class,'edit'])->name('fatraining.edit');
        Route::post('/update/{id}/{slug}',[FatrainingController::class,'update'])->name('fatraining.update');
        Route::delete('/delete/{id}',[FatrainingController::class,'destroy'])->name('fatraining.delete');
        Route::post('/save/assessment',[FatrainingController::class,'saveassessment'])->name('fatraining.saveassessment');
        Route::post('/save/second/assessment',[FatrainingController::class,'savesecondassessment'])->name('fatraining.savesecondassessment');
        Route::post('/save/assessmentbygm',[FatrainingController::class,'saveassessmentbygm'])->name('fatraining.saveassessmentbygm');
    });

    
    Route::group(['prefix' => 'gastesting'], function() {
        Route::post('/save',[GastestingController::class,'store'])->name('gastesting.store');
        Route::get('/edit/{id}/{slug}',[GastestingController::class,'edit'])->name('gastesting.edit');
        Route::post('/update/{id}/{slug}',[GastestingController::class,'update'])->name('gastesting.update');
        Route::delete('/delete/{id}',[GastestingController::class,'destroy'])->name('gastesting.delete');
        Route::post('/save/assessment',[GastestingController::class,'saveassessment'])->name('gastesting.saveassessment');
        Route::post('/save/second/assessment',[GastestingController::class,'savesecondassessment'])->name('gastesting.savesecondassessment');
        Route::post('/save/assessmentbygm',[GastestingController::class,'saveassessmentbygm'])->name('gastesting.saveassessmentbygm');
    
    });
    
    Route::group(['prefix' => 'ophandover'], function() {
        Route::post('/save',[OperationhandoverController::class,'store'])->name('ophandover.store');
        Route::get('/edit/{id}/{slug}',[OperationhandoverController::class,'edit'])->name('ophandover.edit');
        Route::post('/update/{id}/{slug}',[OperationhandoverController::class,'update'])->name('ophandover.update');
        Route::delete('/delete/{id}',[OperationhandoverController::class,'destroy'])->name('ophandover.delete');
        Route::post('/save/assessment',[OperationhandoverController::class,'saveassessment'])->name('ophandover.saveassessment');
        Route::post('/save/second/assessment',[OperationhandoverController::class,'savesecondassessment'])->name('ophandover.savesecondassessment');
        Route::post('/save/assessmentbygm',[OperationhandoverController::class,'saveassessmentbygm'])->name('ophandover.saveassessmentbygm');
    });
    

    Route::group(['prefix' => 'forkliftop'], function() {
        Route::post('/save',[ForkliftopController::class,'store'])->name('forkliftop.store');
        Route::get('/edit/{id}/{slug}',[ForkliftopController::class,'edit'])->name('forkliftop.edit');
        Route::post('/update/{id}/{slug}',[ForkliftopController::class,'update'])->name('forkliftop.update');
        Route::delete('/delete/{id}',[ForkliftopController::class,'destroy'])->name('forkliftop.delete');
        Route::post('/save/assessment',[ForkliftopController::class,'saveassessment'])->name('forkliftop.saveassessment');
        Route::post('/save/second/assessment',[ForkliftopController::class,'savesecondassessment'])->name('forkliftop.savesecondassessment');
        Route::post('/save/assessmentbygm',[ForkliftopController::class,'saveassessmentbygm'])->name('forkliftop.saveassessmentbygm');
    });    
    
    Route::group(['prefix' => 'selfloader'], function() {
        Route::post('/save',[SelfloaderopController::class,'store'])->name('selfloader.store');
        Route::get('/edit/{id}/{slug}',[SelfloaderopController::class,'edit'])->name('selfloader.edit');
        Route::post('/update/{id}/{slug}',[SelfloaderopController::class,'update'])->name('selfloader.update');
        Route::delete('/delete/{id}',[SelfloaderopController::class,'destroy'])->name('selfloader.delete');
        Route::post('/save/assessment',[SelfloaderopController::class,'saveassessment'])->name('selfloader.saveassessment');
        Route::post('/save/second/assessment',[SelfloaderopController::class,'savesecondassessment'])->name('selfloader.savesecondassessment');
        Route::post('/save/assessmentbygm',[SelfloaderopController::class,'saveassessmentbygm'])->name('selfloader.saveassessmentbygm');
    });

    Route::group(['prefix' => 'powerdriven'], function() {
        Route::post('/save',[PowerdrivenscopController::class,'store'])->name('powerdriven.store');
        Route::get('/edit/{id}/{slug}',[PowerdrivenscopController::class,'edit'])->name('powerdriven.edit');
        Route::post('/update/{id}/{slug}',[PowerdrivenscopController::class,'update'])->name('powerdriven.update');
        Route::delete('/delete/{id}',[PowerdrivenscopController::class,'destroy'])->name('powerdriven.delete');
        Route::post('/save/assessment',[PowerdrivenscopController::class,'saveassessment'])->name('powerdriven.saveassessment');
        Route::post('/save/second/assessment',[PowerdrivenscopController::class,'savesecondassessment'])->name('powerdriven.savesecondassessment');
        Route::post('/save/assessmentbygm',[PowerdrivenscopController::class,'saveassessmentbygm'])->name('powerdriven.saveassessmentbygm');
    });
    Route::group(['prefix' => 'respequip'], function() {
        Route::post('/save',[ResponseequipController::class,'store'])->name('respequip.store');
        Route::get('/edit/{id}/{slug}',[ResponseequipController::class,'edit'])->name('respequip.edit');
        Route::post('/update/{id}/{slug}',[ResponseequipController::class,'update'])->name('respequip.update');
        Route::delete('/delete/{id}',[ResponseequipController::class,'destroy'])->name('respequip.delete');
        Route::post('/save/assessment',[ResponseequipController::class,'saveassessment'])->name('respequip.saveassessment');
        Route::post('/save/second/assessment',[ResponseequipController::class,'savesecondassessment'])->name('respequip.savesecondassessment');
        Route::post('/save/assessmentbygm',[ResponseequipController::class,'saveassessmentbygm'])->name('respequip.saveassessmentbygm');
    });
    Route::group(['prefix' => 'miscinnoresp'], function() {
        Route::post('/save',[MiscinnorespskillController::class,'store'])->name('miscinnoresp.store');
        Route::get('/edit/{id}/{slug}',[MiscinnorespskillController::class,'edit'])->name('miscinnoresp.edit');
        Route::post('/update/{id}/{slug}',[MiscinnorespskillController::class,'update'])->name('miscinnoresp.update');
        Route::delete('/delete/{id}',[MiscinnorespskillController::class,'destroy'])->name('miscinnoresp.delete');
        Route::post('/save/assessment',[MiscinnorespskillController::class,'saveassessment'])->name('miscinnoresp.saveassessment');
        Route::post('/save/second/assessment',[MiscinnorespskillController::class,'savesecondassessment'])->name('miscinnoresp.savesecondassessment');
        Route::post('/save/assessmentbygm',[MiscinnorespskillController::class,'saveassessmentbygm'])->name('miscresp.saveassessmentbygm');
    });
    Route::group(['prefix' => 'fateoilresp'], function() {
        Route::post('/save',[FateoilskillController::class,'store'])->name('fateoilresp.store');
        Route::get('/edit/{id}/{slug}',[FateoilskillController::class,'edit'])->name('fateoilresp.edit');
        Route::post('/update/{id}/{slug}',[FateoilskillController::class,'update'])->name('fateoilresp.update');
        Route::delete('/delete/{id}',[FateoilskillController::class,'destroy'])->name('fateoilresp.delete');
        Route::post('/save/assessment',[FateoilskillController::class,'saveassessment'])->name('fateoilresp.saveassessment');
        Route::post('/save/second/assessment',[FateoilskillController::class,'savesecondassessment'])->name('fateoilresp.savesecondassessment');
        Route::post('/save/assessmentbygm',[FateoilskillController::class,'saveassessmentbygm'])->name('fateoil.saveassessmentbygm');
    });
    Route::group(['prefix' => 'impoilpollu'], function() {
        Route::post('/save',[ImpactoilpollutionController::class,'store'])->name('impoilpollu.store');
        Route::get('/edit/{id}/{slug}',[ImpactoilpollutionController::class,'edit'])->name('impoilpollu.edit');
        Route::post('/update/{id}/{slug}',[ImpactoilpollutionController::class,'update'])->name('impoilpollu.update');
        Route::delete('/delete/{id}',[ImpactoilpollutionController::class,'destroy'])->name('impoilpollu.delete');
        Route::post('/save/assessment',[ImpactoilpollutionController::class,'saveassessment'])->name('impoilpollu.saveassessment');
        Route::post('/save/second/assessment',[ImpactoilpollutionController::class,'savesecondassessment'])->name('impoilpollu.savesecondassessment');
        Route::post('/save/assessmentbygm',[ImpactoilpollutionController::class,'saveassessmentbygm'])->name('impoilpollu.saveassessmentbygm');
    });
    Route::group(['prefix' => 'survmodviz'], function() {
        Route::post('/save',[SurvmodelvisualizationController::class,'store'])->name('survmodviz.store');
        Route::get('/edit/{id}/{slug}',[SurvmodelvisualizationController::class,'edit'])->name('survmodviz.edit');
        Route::post('/update/{id}/{slug}',[SurvmodelvisualizationController::class,'update'])->name('survmodviz.update');
        Route::delete('/delete/{id}',[SurvmodelvisualizationController::class,'destroy'])->name('survmodviz.delete');
        Route::post('/save/assessment',[SurvmodelvisualizationController::class,'saveassessment'])->name('survmodviz.saveassessment');
        Route::post('/save/second/assessment',[SurvmodelvisualizationController::class,'savesecondassessment'])->name('survmodviz.savesecondassessment');
        Route::post('/save/assessmentbygm',[SurvmodelvisualizationController::class,'saveassessmentbygm'])->name('survmodviz.saveassessmentbygm');
    });
    Route::group(['prefix' => 'offshoreresp'], function() {
        Route::post('/save',[OffshoreresponseController::class,'store'])->name('offshoreresp.store');
        Route::get('/edit/{id}/{slug}',[OffshoreresponseController::class,'edit'])->name('offshoreresp.edit');
        Route::post('/update/{id}/{slug}',[OffshoreresponseController::class,'update'])->name('offshoreresp.update');
        Route::delete('/delete/{id}',[OffshoreresponseController::class,'destroy'])->name('offshoreresp.delete');
        Route::post('/save/assessment',[OffshoreresponseController::class,'saveassessment'])->name('offshoreresp.saveassessment');
        Route::post('/save/second/assessment',[OffshoreresponseController::class,'savesecondassessment'])->name('offshoreresp.savesecondassessment');
        Route::post('/save/assessmentbygm',[OffshoreresponseController::class,'saveassessmentbygm'])->name('offshoreresp.saveassessmentbygm');
    });
    Route::group(['prefix' => 'dispers'], function() {
        Route::post('/save',[DispersantController::class,'store'])->name('dispers.store');
        Route::get('/edit/{id}/{slug}',[DispersantController::class,'edit'])->name('dispers.edit');
        Route::post('/update/{id}/{slug}',[DispersantController::class,'update'])->name('dispers.update');
        Route::delete('/delete/{id}',[DispersantController::class,'destroy'])->name('dispers.delete');
        Route::post('/save/assessment',[DispersantController::class,'saveassessment'])->name('dispers.saveassessment');
        Route::post('/save/second/assessment',[DispersantController::class,'savesecondassessment'])->name('dispers.savesecondassessment');
        Route::post('/save/assessmentbygm',[DispersantController::class,'saveassessmentbygm'])->name('dispers.saveassessmentbygm');
    });
    Route::group(['prefix' => 'shorelineresp'], function() {
        Route::post('/save',[ShorelineresponseController::class,'store'])->name('shorelineresp.store');
        Route::get('/edit/{id}/{slug}',[ShorelineresponseController::class,'edit'])->name('shorelineresp.edit');
        Route::post('/update/{id}/{slug}',[ShorelineresponseController::class,'update'])->name('shorelineresp.update');
        Route::delete('/delete/{id}',[ShorelineresponseController::class,'destroy'])->name('shorelineresp.delete');
        Route::post('/save/assessment',[ShorelineresponseController::class,'saveassessment'])->name('shorelineresp.saveassessment');
        Route::post('/save/second/assessment',[ShorelineresponseController::class,'savesecondassessment'])->name('shorelineresp.savesecondassessment');
        Route::post('/save/assessmentbygm',[ShorelineresponseController::class,'saveassessmentbygm'])->name('shorelineresp.saveassessmentbygm');
    });
    Route::group(['prefix' => 'inlandresp'], function() {
        Route::post('/save',[InlandresponseController::class,'store'])->name('inlandresp.store');
        Route::get('/edit/{id}/{slug}',[InlandresponseController::class,'edit'])->name('inlandresp.edit');
        Route::post('/update/{id}/{slug}',[InlandresponseController::class,'update'])->name('inlandresp.update');
        Route::delete('/delete/{id}',[InlandresponseController::class,'destroy'])->name('inlandresp.delete');
        Route::post('/save/assessment',[InlandresponseController::class,'saveassessment'])->name('inlandresp.saveassessment');
        Route::post('/save/second/assessment',[InlandresponseController::class,'savesecondassessment'])->name('inlandresp.savesecondassessment');
        Route::post('/save/assessmentbygm',[InlandresponseController::class,'saveassessmentbygm'])->name('inlandresp.saveassessmentbygm');
    });
    Route::group(['prefix' => 'incidentmgt'], function() {
        Route::post('/save',[IncidentmgtController::class,'store'])->name('incidentmgt.store');
        Route::get('/edit/{id}/{slug}',[IncidentmgtController::class,'edit'])->name('incidentmgt.edit');
        Route::post('/update/{id}/{slug}',[IncidentmgtController::class,'update'])->name('incidentmgt.update');
        Route::delete('/delete/{id}',[IncidentmgtController::class,'destroy'])->name('incidentmgt.delete');
        Route::post('/save/assessment',[IncidentmgtController::class,'saveassessment'])->name('incidentmgt.saveassessment');
        Route::post('/save/second/assessment',[IncidentmgtController::class,'savesecondassessment'])->name('incidentmgt.savesecondassessment');
        Route::post('/save/assessmentbygm',[IncidentmgtController::class,'saveassessmentbygm'])->name('incidmgt.saveassessmentbygm');
    });


    Route::resource('directory', DirectoryController::class);

    Route::get('all/admins', [AdminController::class,'admins'])->name('all.admin');

    Route::get('admins/{id}/show', [AdminController::class,'show'])->name('admins.show');
    Route::post('admins/{id}/activate', [AdminController::class,'activate'])->name('admins.activate');
    Route::post('admins/{id}/deactivate', [AdminController::class,'deactivate'])->name('admins.deactivate');

    Route::get('user/profile', [UserController::class,'profileimage'])->name('user.profile');
    Route::post('user/profile', [UserController::class,'updateprofileimage'])->name('user.profile.update');

    
    Route::resource('manuals', EquipmentmanualController::class);
    Route::post('manuals/{id}/approve', [EquipmentmanualController::class,'approve'])->name('manuals.approve');

    //hazard reporting routes
    
    Route::resource('hazardreports', HazardreportController::class);
    Route::resource('hazardactiontracking', ActiontrackingController::class);
    Route::get('hazardreport/{id}/close', [HazardreportController::class,'closereport'])->name('hazardreports.closed');

    Route::get('access-denied',[AccessDeniedController::class,'@index'])->name('access.denied');

    // periodic maintenance modules
    
    Route::resource('machines', MachineController::class);
    Route::resource('schedules', ScheduleController::class);
    Route::post('schedule/{id}/confirm', [ScheduleController::class,'confirm'])->name('schedule.confirm');
    Route::get('myform/ajax/{id}',[HomeController::class,'myformAjax'])->name('myform.ajax');
    Route::get('myform/ajax3/{id}',[HomeController::class,'myformAjax3'])->name('myform.ajax3');
    Route::resource('machinemaints',MachinemaintController::class);
    Route::post('machinemaint/{id}/confirm', [MachinemaintController::class,'confirm'])->name('machinemaints.confirm');
    

    //Employee information modules
    
    Route::resource('employees', EmployeeinfoController::class);


    //for trainee certificates
    Route::resource('trainees', TraineeController::class);
    Route::resource('trainings', TrainingController::class);

    Route::resource('certificates', TrainingcertController::class);
    Route::post('certificate/{id}/approve', [TrainingcertController::class,'approve'])->name('certificate.approve');
    Route::get('/download/certificate/{filename}', [TrainingcertController::class,'certificatefiledownload'])->name('download.certificate');
    //for generating certificates
    Route::get('generate/certificate/{id}',[GenerateCertificateController::class,'generatecertificate'])->name('generate.certificate');

    //for Master Document Registers
    Route::resource('documentregisters', MasterdocregisterController::class);
    Route::get('/view/uploaded-mdr/{filename}', [MasterdocregisterController::class,'viewuploadedfile'])->name('view.uploadedfile');
    Route::post('documentregister/{id}/approve', [MasterdocregisterController::class,'approve'])->name('documregister.approve');

    Route::get('/view/document-register/{filename}', [MasterdocregisterController::class,'viewmasterdocregister'])->name('viewmasterdocregister');
    
    
    
    
    //maintenance module
    Route::resource('maintenanceschedule', MaintscheduleController::class);
    Route::get('select/maintenance/option',[MaintscheduleController::class,'showscheduleoption'])->name('select.maintoption');
    Route::post('schedule/maintenance',[MaintscheduleController::class,'redirectbasedonoption'])->name('redirecttoselectedoptionpage');
    Route::resource('vendors', VendorController::class);
    Route::resource('workorder', WorkorderController::class);
    Route::post('workorder/givefirst/approval/{id}', [WorkorderController::class,'givefirstapproval'])->name('givefirstapproval');
    Route::post('workorder/givefinal/approval/{id}', [WorkorderController::class,'givefinalapproval'])->name('givefinalapproval');
    Route::get('print/workorder/{id}',[WorkorderController::class,'printworkorder'])->name('print.workorder');
    // Route::get('choose/maintenance/type',[MaintscheduleController::class,'getmaintenancetype'])->name('getmaintype');
    // Route::post('create/schedule',[MaintscheduleController::class,'createschedule'])->name('create.schedule');

    Route::get('maintenance-schedule/add-maintained-equipment/{id}', [MaintscheduleController::class,'addmaintdequpment'])->name('create.maintdequipment');
    Route::resource('maintainedequipment', MaintdequipmentController::class);
    Route::get('/download/maintenance/report/{filename}', [MaintdequipmentController::class,'downloadreport'])->name('download.maintreport');
    Route::post('workorder/{id}/approve', [MaintdequipmentController::class,'approveworkorder'])->name('approve.workorder');
    Route::post('/upload-more-files',[MaintdequipmentController::class,'uploadmorefiles'])->name('morefiles.store');
    Route::get('/approved/maintained/equipment',[MaintdequipmentController::class,'approved'])->name('maintdequip.approved');
    Route::get('/unapproved/maintained/equipment',[MaintdequipmentController::class,'unapproved'])->name('maintdequip.unapproved');
    


    Route::get('add/record',[MultipleRecordController::class,'multiplerecordform'])->name('multiplerecordform');
Route::post('save/record',[MultipleRecordController::class,'store'])->name('store.multiplerecord');

Route::resource('waybills',WaybillController::class);
Route::post('waybill/approve/{id}', [WaybillController::class,'giveapproval'])->name('giveapproval');
// Route::post('serach/waybills',[WaybillController::class,'searchwaybill'])->name('searchwaybill');
Route::get('autocomplete', [WaybillController::class, 'autocomplete'])->name('autocomplete');


//print waybill
Route::get('print/waybill/{waybill}',[PrintController::class,'printwaybill'])->name('print.waybill');


//visitor booking
Route::resource('visitorbookings',VisitorbookingController::class);


//partner routes
Route::resource('cnapartners',PartnerController::class);

//maintenance request routes
Route::resource('maintenancerequest',MaintrequestController::class);
Route::get('print/maintenance-request/{id}',[MaintrequestController::class,'printmaintrequest'])->name('printmaintrequest');
Route::post('approve/maintenance-request/{id}',[MaintrequestController::class,'approvemaintrequest'])->name('approvemaintrequest');

    // access denied
    Route::get('access-denied',[AccessDeniedController::class,'index'])->name('access.denied');
});


Route::get('dashboard/impersonate/destroy',[Impersonate::class,'destroy'])->name('staff.impersonate.destroy');


// Route::get('/logout', [LoginController::class,'userLogout'])->name('user.logout');