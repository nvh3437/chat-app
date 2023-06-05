<?php

namespace Modules\AvnContact\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\AvnContact\Entities\Contact;
use App\Models\GeneralSettings;

class ContactController extends Controller
{
    //-------------------------------- Quản lý --------------------------//
    public function listContact()
    {
        $contacts = Contact::orderByDesc('updated_at')->get();
        return view('avncontact::list-contact', compact('contacts'));
    }

    public function deleteContact($id)
    {
        try {
            $contact = Contact::findOrFail($id)->delete();
            return back()->with('Success', Lang::get('settings.Delete.Delete_success'));
        } catch (Exception $e) {
            return back()->with('Failed', Lang::get('settings.Delete.Delete_failed'));
        }

    }
    public function processContact($id, Request $request)
    {
        try {
            $contact = Contact::findOrFail($id);
            $contact->status = $request->status;
            $contact->save();
            return back()->with('Success', Lang::get('settings.Update.Update_success'));
        } catch (Exception $e) {
            return back()->with('Failed', Lang::get('settings.Update.Update_failed'));
        }

    }

    //-------------------------------- Khách --------------------------//
    public function contactPage($success = false)
    {
        $contact_seo = GeneralSettings::whereIn('key', [
            'contact_seo_title',
            'contact_seo_description',
            'contact_seo_keywords',
            'contact_seo_image',
            'contact_page_title',
            'contact_page_description',
            'contact_page_icon'
        ])->select('key', 'value')->get()->keyBy('key')->toArray();
        $company_info = GeneralSettings::whereIn('key', [
            'address',
            'phone_number',
            'email',
        ])->select('key', 'value')->get()->keyBy('key')->toArray();
        return view('avncontact::contact-page', compact('contact_seo', 'company_info', 'success'));
    }

    public function storeContact(Request $request)
    {
        try {
            $contact = new Contact();
            $contact->name = $request->name;
            $contact->title = $request->title;
            $contact->email = $request->email;
            $contact->message = $request->message;
            $contact->save();
            return redirect()->route('contact-page', ['success' => true])->with('Success', 'Cảm ơn bạn đã liên hệ với chúng tôi');
        } catch (Exception $e) {
            return back()->with('Failed', 'Gửi thất bại');
        }

    }
}