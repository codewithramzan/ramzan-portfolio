<?php

class ClientController extends Controller
{
    public function dashboard(): void
    {
        $this->view(
            'client/dashboard',
            [
                'title' => 'Client Dashboard'
            ],
            'client'
        );
    }
}