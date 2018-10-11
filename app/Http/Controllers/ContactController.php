<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{

    /**
     * @api {GET} /contact.getList
     * @apiGroup Contact
     * @apiParam {Number{..100}} [per_page=25]
     * @apiParam {Number} [page=1]
     * @apiSampleRequest api/contact.getList
     */

    public function getList(Request $request)
    {
        $page = $request->input('page', 1);
        $per_page = $request->input('per_page', 25);

        $offset = paginationOffset($page, $per_page);

        $response = Contact::offset($offset)->limit($per_page)->orderBy('created_at', 'desc')->get();

        $total = Contact::all()->count();

        return [
            'response' => [
                'data' => $response,
                'all_loaded' => allEntitiesLoaded($total, $page, $per_page)
            ],
            'status_code' => 200
        ];
    }

    /**
     * @api {GET} /contact.getByName
     * @apiGroup Contact
     * @apiParam {String} name
     * @apiParam {Number{..100}} [per_page=25]
     * @apiParam {Number} [page=1]
     * @apiSampleRequest api/contact.getByName
     */
    public function getByName(Request $request)
    {
        $name = $request->input('name', '');
        $page = $request->input('page', 1);
        $per_page = $request->input('per_page', 25);

        $offset = paginationOffset($page, $per_page);

        $query = Contact::whereName($name);

        $total = clone $query;

        $response = $query->offset($offset)->limit($per_page)->get();

        return [
            'response' => [
                'data' => $response,
                'all_loaded' => allEntitiesLoaded($total->count(), $page, $per_page)
            ],
            'status_code' => 200
        ];

    }

    /**
     * @api {Post} /contact.create
     * @apiGroup Contact
     * @apiParam {String} name
     * @apiParam {String} phone
     * @apiSampleRequest api/contact.create
     */
    public function create(Request $request)
    {
        $name = $request->input('name', '');
        $phone = $request->input('phone', '');

        $response = Contact::create([
            'name' => $name,
            'phone' => $phone,
            'email' => ''
        ]);

        return [
            'response' => $response,
            'status_code' => 200
        ];
    }

    /**
     * @api {PUT} /contact.edit
     * @apiGroup Contact
     * @apiParam {Number} id
     * @apiParam {String} name
     * @apiParam {String} phone
     * @apiSampleRequest api/contact.edit
     */
    public function edit(Request $request)
    {
        $id = $request->input('id');
        $name = $request->input('name', '');
        $phone = $request->input('phone', '');


        $response = Contact::find($id)
            ->update([
                'name' => $name,
                'phone' => $phone
            ]);

        return [
            'response' => $response,
            'status_code' => 200
        ];
    }

    /**
     * @api {DELETE} /contact.delete
     * @apiGroup Contact
     * @apiParam {Number} id
     * @apiSampleRequest api/contact.delete
     */
    public function delete(Request $request)
    {
        $id = $request->input('id');

        $response = Contact::find($id)->delete();

        return [
            'response' => $response,
            'status_code' => 200
        ];
    }
}

