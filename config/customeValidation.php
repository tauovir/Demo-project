<?php

return [
    'login' => [
                    'email' => 'required|max:50|email|exists:customers,cust_email',
                    'password' => 'required|min:6|max:50',
             ]
];
