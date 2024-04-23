<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\AttendanceController;
use App\Http\Controllers\Backend\CatergoryController;
use App\Http\Controllers\Backend\CustomerController;
use App\Http\Controllers\Backend\EmployeeController;
use App\Http\Controllers\Backend\ExpenseController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\PosController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\SalaryController;
use App\Http\Controllers\Backend\SupplierController;
use App\Http\Controllers\ProfileController;
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
});

Route::get('/dashboard', function () {
    return view('index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/admin/logout', [AdminController::class, 'AdminDestroy'])->name('admin.logout');
Route::get('/logout', [AdminController::class, 'AdminLogoutPage'])->name('admin.logout.page');

Route::middleware(['auth'])->group(function(){

Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');
Route::get('/change/password', [AdminController::class, 'ChangePassword'])->name('change.password');
Route::post('/update/password', [AdminController::class, 'UpdatePassword'])->name('update.password');
}); //end user middleware

//Employee All Manage
Route::controller(EmployeeController::class)->group(function(){
    Route::get('all/employee','AllEmployee')->name('all.employee');
    Route::get('add/employee','AddEmployee')->name('add.employee');
    Route::post('store/employee','StoreEmployee')->name('employee.store');
    Route::get('edit/employee/{id}','EditEmployee')->name('edit.employee');
    Route::post('update/employee','UpdateEmployee')->name('employee.update');
    Route::get('delete/employee/{id}','DeleteEmployee')->name('delete.employee');
});

//Customer All Manage
Route::controller(CustomerController::class)->group(function(){
    Route::get('all/customer','AllCustomer')->name('all.customer'); 
    Route::get('add/customer','AddCustomer')->name('add.customer'); 
    Route::post('store/customer','StoreCustomer')->name('customer.store');
    Route::get('edit/customer/{id}','EditCustomer')->name('edit.customer');
    Route::post('update/customer','UpdateCustomer')->name('customer.update');
    Route::get('delete/cutomer/{id}','DeleteCustomer')->name('delete.customer');
});

//Supplier All Manage
Route::controller(SupplierController::class)->group(function(){
    Route::get('all/supplier','AllSupplier')->name('all.supplier');
    Route::get('add/supplier','AddSupplier')->name('add.supplier');  
    Route::post('store/supplier','StoreSupplier')->name('supplier.store');
    Route::get('edit/supplier/{id}','EditSupplier')->name('edit.supplier');
    Route::post('update/supplier','UpdateSupplier')->name('supplier.update');
    Route::get('delete/supplier/{id}','DeleteSupplier')->name('delete.supplier');
    Route::get('details/supplier/{id}','DetailsSupplier')->name('details.supplier');
});

//Salary All Manage
Route::controller(SalaryController::class)->group(function(){
    Route::get('add/advance/salary','AddAdvanceSalary')->name('add.advance.salary');
    Route::post('advance/salary/store','StoreAdvanceSalary')->name('advance.salary.store');
    Route::get('all/advance/salary','AllAdvanceSalary')->name('all.advance.salary');
    Route::get('edit/advance/salary/{id}','EditAdvanceSalary')->name('edit.advance.salary');
    Route::post('advance/salary/update','AdvanceSalaryUpdate')->name('advance.salary.update');
    Route::get('delete/advance/salary/{id}','DeleteAdvanceSalary')->name('delete.advance.salary');
});

//Pay All Manage
Route::controller(SalaryController::class)->group(function(){
    Route::get('pay/salary','PaySalary')->name('pay.salary');
    Route::get('pay/now/salary/{id}','PayNowSalary')->name('pay.now.salary');
    Route::post('employee/salary/store','EmployeeSalaryStore')->name('employee.salary.store');
    Route::get('month/salary','MonthSalary')->name('month.salary'); //employee.attend.list
}); 

//Attendance All Manage
Route::controller(AttendanceController::class)->group(function(){
    Route::get('employee/attend/list','EmployeeAttendList')->name('employee.attend.list');
    Route::get('add/employee/attend','AddEmployeeAttend')->name('add.employee.attend');
    Route::post('employee/attend/store','EmployeeAttendStore')->name('employee.attend.store');
    Route::get('employee/attend/edit/{date}','EmployeeAttendEdit')->name('employee.attend.edit');
    Route::get('view/employee/attend/{date}','ViewEmployeeAttendence')->name('view.employee.attendence'); 
 //
}); 

//Catergory All Manage
Route::controller(CatergoryController::class)->group(function(){
    Route::get('all/catergory','AllCatergory')->name('all.catergory'); 
    Route::post('catergory/store','CatergoryStore')->name('catergory.store');
    Route::get('edit/catergory/{id}','EditCatergory')->name('edit.catergory');
    Route::post('catergory/update','CatergoryUpdate')->name('catergory.update');
    Route::get('delete/catergory/{id}','DeleteCatergory')->name('delete.catergory'); 
}); 

//Product All Manage
Route::controller(ProductController::class)->group(function(){
    Route::get('all/product','AllProduct')->name('all.product'); 
    Route::get('add/product','AddProduct')->name('add.product');
    Route::post('product/store','ProductStore')->name('product.store');
    Route::get('edit/product/{id}','EditProduct')->name('edit.product');
    Route::post('product/update','ProductUpdate')->name('product.update');
    Route::get('delete/product/{id}','DeleteProduct')->name('delete.product'); 
    Route::get('barcode/product/{id}','BarcodeProduct')->name('barcode.product');
    Route::get('import/product','ImportProduct')->name('import.product');
    Route::get('Export/product','Export')->name('export');
    Route::post('import/product','Import')->name('import');
}); 

//Expense All Manage
Route::controller(ExpenseController::class)->group(function(){
    Route::get('add/expense','AddExpense')->name('add.expense');
    Route::post('expense/store','ExpenseStore')->name('expense.store');
    Route::get('today/expense','TodayExpense')->name('today.expense');
    Route::get('edit/expense/{id}','EditExpense')->name('edit.expense');
    Route::post('expense/update','ExpenseUpdate')->name('expense.update');
    
    Route::get('month/expense','MonthExpense')->name('month.expense');
    Route::get('year/expense','YearExpense')->name('year.expense');
}); 

//POS All Manage
Route::controller(PosController::class)->group(function(){
    Route::get('/pos','Pos')->name('pos');//  /add-cart   ->middleware('permission:pos');
    Route::post('/add-cart','AddCart');
    Route::get('/all-item','AllItem');
    Route::post('/cart-update/{rowId}','CartUpdate');
    Route::get('/cart-remove/{rowId}','CartRemove');
    Route::post('/create-invoice','CreateInvoice');
}); 

//Order All Manage
Route::controller(OrderController::class)->group(function(){
    Route::post('/final-invoice','FinalInvoice');
    Route::get('/pending/order','PendingOrder')->name('pending.order');
    Route::get('/order/details/{id}','OrderDetails')->name('order.details');
    Route::post('/order/status/update','OrderStatusUpdate')->name('order.status.update');
    Route::get('/complete/order','CompleteOrder')->name('complete.order');
    Route::get('/stock/manage','StockManage')->name('stock.manage');
    Route::get('/order/invoice-download/{order_id}','OrderInvoice');
}); 

//Permission All Manage
Route::controller(RoleController::class)->group(function(){
    Route::get('/all/permission','AllPermission')->name('all.permission'); 
    Route::get('/add/permission','AddPermission')->name('add.permission'); 
    Route::post('/store/permission','StorePermission')->name('permission.store');
    Route::get('/edit/permission/{id}','EditPermission')->name('edit.permission');
    Route::post('/permission/update','PermissionUpdate')->name('permission.update');
    Route::get('delete/permission/{id}','DeletePermission')->name('delete.permission'); //all.roles
}); 

//Role All Manage
Route::controller(RoleController::class)->group(function(){
    Route::get('/all/roles','AllRoles')->name('all.roles');
    Route::get('/add/roles','AddRoles')->name('add.roles'); 
    Route::post('/store/roles','RolesStore')->name('roles.store');
    Route::get('/edit/roles/{id}','EditRoles')->name('edit.roles');
    Route::post('/roles/update','RolesUpdate')->name('roles.update');
    Route::get('delete/roles/{id}','DeleteRoles')->name('delete.roles');
}); 

//Add Roles in permission All Route
Route::controller(RoleController::class)->group(function(){
    Route::get('/add/roles/permission','AddRolesPermission')->name('add.roles.permission');
    Route::post('/role/permission/store','RolePermissionStore')->name('role.permission.store');
    Route::get('/all/roles/permission','AllRolesPermission')->name('all.roles.permission');
    Route::get('/admin/edit/roles/{id}','AdminEditRoles')->name('admin.edit.roles');
    Route::post('/role/permission/update/{id}','RolePermissionUpdate')->name('role.permission.update');
    Route::get('/admin/delete/roles/{id}','AdminDeleteRoles')->name('admin.delete.roles');
}); 

//Admin User All Route
Route::controller(AdminController::class)->group(function(){
    Route::get('/all/admin','AllAdmin')->name('all.admin'); 
    Route::get('/add/admin','AddAdmin')->name('add.admin');
    Route::post('/admin/store','AdminStore')->name('admin.store'); 
    Route::get('/edit/admin/{id}','EditAdmin')->name('edit.admin');
    Route::post('/update/admin','UpdateAdmin')->name('admin.update');
    Route::get('/delete/delete/{id}','DeleteAdmin')->name('delete.admin');
}); 
require __DIR__.'/auth.php';
