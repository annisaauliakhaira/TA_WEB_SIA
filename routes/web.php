<?php

$router->get('/', function () use ($router) {
    return $router->app->version();
});


$router->group(['prefix' => 'v1', 'namespace' => 'Api\v1'], function () use ($router) {
    $router->get('periode', 'SemesterController@getListSemester');
    
    //user
    $router->get('/mahasiswa', 'Mahasiswa\MyController@getListData');
    $router->get('/dosen', 'Dosen\MyController@getListData');
    $router->get('/staff', 'Admin\MyController@getAllData');

    //perkuliahan
    $router->get('/gedung', 'BuildingController@getAllDataGedung');
    $router->get('/ruangan', 'BuildingController@getAllDataRuangan');
    $router->get('/matkul', 'MatkulController@getAllData');
    $router->get('/kelas', 'KelasController@getAllDataKelas');
    $router->get('/kelas-dosen', 'KelasController@getAllKelasDosen');
    $router->get('/kelas-mahasiswa', 'KelasController@getAllKrsMahasiswa');
    $router->get('/kelas-ujian', 'KelasController@jadwalUjian');
    $router->get('/kelas-ujian-mahasiswa', 'KelasController@jadwalUjianMahasiswa');

    //

});
