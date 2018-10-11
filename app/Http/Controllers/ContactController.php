<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;

class ContactController extends Controller
{

    public function getList(Request $request)
    {
        $page = $request->input('page', 1);
        $per_page = $request->input('per_page', 25);

        $offset = paginationOffset($page, $per_page);

        $response = Contact::offset($offset)->limit($per_page)->orderBy('created_at', 'desc');

        $total = Contact::all()->count();

        return [
            'response' => [
                'data' => $response,
                'all_loaded' => allEntitiesLoaded($total, $page, $per_page)
            ],
            'status_code' => 200
        ];
    }
}

