<?php

namespace App\Controllers;

use App\Models\Contact;

class ContactController extends Controller
{
    public function index($request,  $response, $args)
    {

        $model = new Contact();
        $perPage = 3;
        if (isset($_GET['search'])) {

            $contacts = $model->where('name', 'like', "%{$_GET['search']}%")->paginate($perPage);
        } else {

            $contacts = $model->where("id", "<", "10")->orderBy('id', 'desc')->paginate(3);

            // $contacts = $model->paginate($perPage);
            // return $contacts;
        }
        $response->getBody()->write(json_encode($contacts));
        return $response;
        
        return $this->view('contacts.index', compact('contacts'));
    }

    public function create()
    {
        return $this->view('contacts.create');
    }

    public function store()
    {
        $data = $_POST;
        $model = new Contact();
        $model->create($data);
        return $this->redirect('/contacts');
    }

    public function show($id)
    {
        $model = new Contact();
        $contact = $model->find($id);
        return $this->view('contacts.show', compact('contact'));
    }

    public function edit($id)
    {
        $model = new Contact();
        $contact = $model->find($id);
        return $this->view('contacts.edit', compact('contact'));
    }

    public function update($id)
    {
        $data = $_POST;
        $model = new Contact();
        $model->update($id, $data);
        return $this->redirect("/contacts/{$id}");
    }

    public function destroy($id)
    {
        $model = new Contact();
        $model->delete($id);
        return $this->redirect('/contacts');
    }
}
