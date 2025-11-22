<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    public function index()
    {
        $logo = Setting::get('site_logo');
        $introVideo = Setting::get('intro_video');
        return view('admin.settings.index', compact('logo', 'introVideo'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            'intro_video' => 'nullable|file|mimes:mp4,webm,ogg|max:102400', // Max 100MB
        ]);

        if ($request->hasFile('logo')) {
            // Delete old logo
            $oldLogo = Setting::get('site_logo');
            if ($oldLogo && Storage::disk('public')->exists($oldLogo)) {
                Storage::disk('public')->delete($oldLogo);
            }

            // Store new logo
            $path = $request->file('logo')->store('logo', 'public');
            Setting::set('site_logo', $path);

            return redirect()->back()->with('success', 'Logo başarıyla güncellendi!');
        }

        if ($request->hasFile('intro_video')) {
            // Delete old video
            $oldVideo = Setting::get('intro_video');
            if ($oldVideo && Storage::disk('public')->exists($oldVideo)) {
                Storage::disk('public')->delete($oldVideo);
            }

            // Store new video
            $path = $request->file('intro_video')->store('videos', 'public');
            Setting::set('intro_video', $path);

            return redirect()->back()->with('success', 'Tanıtım videosu başarıyla güncellendi!');
        }

        return redirect()->back()->with('error', 'Lütfen bir dosya seçin.');
    }

    public function deleteLogo()
    {
        $logo = Setting::get('site_logo');
        if ($logo && Storage::disk('public')->exists($logo)) {
            Storage::disk('public')->delete($logo);
        }
        Setting::set('site_logo', null);

        return redirect()->back()->with('success', 'Logo başarıyla silindi!');
    }

    public function deleteVideo()
    {
        $video = Setting::get('intro_video');
        if ($video && Storage::disk('public')->exists($video)) {
            Storage::disk('public')->delete($video);
        }
        Setting::set('intro_video', null);

        return redirect()->back()->with('success', 'Video başarıyla silindi!');
    }
}
