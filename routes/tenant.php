<?php

/** 
 * Arquivo criado para ficar na responsabilidade de garantir 
 * quem pode gerir a criação, exclusão etc das empresas (clientes do sispem);
*/

//Cria o banco de dados dos nossos clientes;
//http://projeto.local.com:8080/tenant/company/store

Route::get('company/store', 'Tenant\CompanyController@store')->name('company.store');

