<?php

namespace Modules\AvnContact\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\AvnContact\Entities\Contact;

class ContactController extends Controller
{
    //-------------------------------- Quản lý --------------------------//
    public function listContact()
    {
        $contacts = Contact::get();
        return view('avncontact::list-contact', compact('contacts'));
    }

    public function deleteContact($id)
    {
        try {
            $contact = Contact::findOrFail($id)->delete();
            return back()->with('Success', 'Xóa thành công');
        } catch (Exception $e) {
            return back()->with('Failed', 'Xóa thất bại');
        }

    }

    //-------------------------------- Khách --------------------------//
    public function pageContact()
    {
        return view('avncontact::page-contact');
    }

    public function successContact()
    {
        return view('avncontact::success-contact');
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
            return redirect()->route('success-contact')->with('Success', 'Cảm ơn bạn đã liên hệ với chúng tôi');
        } catch (Exception $e) {
            return back()->with('Failed', 'Gửi thất bại');
        }

    }
}
