<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    
    public function loadPage($page)
    {
        switch ($page) {

            case 'all_users':
                return view('admin.all_users');

            case 'add_a_plant':
                return view('admin.add_a_plant');

            case 'update_a_plant':
                return view('admin.update_a_plant');

            case 'delete_a_plant':
                return view('admin.delete_a_plant');

            case 'plant_catalog':
                return view('admin.plant_catalog');

            default:
                return view('admin.home');
        }
    }
   
}


// Method-2
//  public function loadPage($page)
//     {
//         $allowedPages = [
//             'home',
//             'plant_catalog'
//         ];

//         if (!in_array($page, $allowedPages)) {
//             abort(404);
//         }

//         return view('frontend.' . $page);
//     }