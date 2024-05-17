<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Traits\ImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class DashboardController extends Controller
{
    use ImageTrait;

    // Dashboard View
    public function index()
    {
        return view('admin.dashboard.dashboard');
    }

    // Admin Logout
    public function adminLogout()
    {
        Auth::logout();
        session()->flush();
        return redirect()->route('admin.login');
    }

    public function advertisementView(Request $request)
    {
        $advertiseMent = null;
        try {

            if ($request->hasFile('advertise_image')) {
                $advertiseMent = Setting::first();

                $input = $request->except('_token');
                
                if (!$advertiseMent) {
                    if ($request->hasFile('advertise_image')) {
                        $file = $request->file('advertise_image');
                        $image_url = $this->addSingleImage('advertiseMent', 'advertise_image', $file, $old_image = '');
                        $input['advertise_image'] = $image_url;
                    }

                    $saveadvertiseMent = Setting::create($input);
                } else {
                
                    if ($advertiseMent->advertise_image) {
                        File::delete('public/images/uploads/advertise_image/' . $advertiseMent->advertise_image);
                    }
                    
                    if ($request->hasFile('advertise_image')) {
                        $file = $request->file('advertise_image');
                        $image_url = $this->addSingleImage('advertiseMent', 'advertise_image', $file, $old_image = '');
                        $input['advertise_image'] = $image_url;
                    }

                    $advertiseMent->update($input);
                }
            }

            return view('admin.advertisement.advertise-index',compact('advertiseMent'));    
           
        } catch (\Throwable $th) { 
            return redirect()->route('dashboard')->with('error','Internal Server Error!');
        }

    }
}
