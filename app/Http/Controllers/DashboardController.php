<?php
// app/Http/Controllers/DashboardController.php
namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\User;


use Illuminate\Http\Request;

class DashboardController extends Controller
{
public function index()
{
return view('dashboard');
}

}