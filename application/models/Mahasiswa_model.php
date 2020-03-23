<?php 

use GuzzleHttp\Client;

class Mahasiswa_model extends CI_model 
{
    private $client;
    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'http://localhost/rest-server/api/',
            'auth' => ['bachtiar' , '110101']
        ]);
    }
    public function getAllMahasiswa()
    { 
        $response = $this->client->request('GET', 'mahasiswa', [
            'query' => [
                'BY-KEY' => 'by123'
            ]
        ]);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result['data'];
    }

    public function getMahasiswaById($id)
    {
        $response = $this->client->request('GET', 'mahasiswa',[
            'query' => [
                'id' => $id,
                'BY-KEY' => 'by123'
            ]
        ]);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result['data'][0];
    }

    public function tambahDataMahasiswa()
    {
        $data = [
            "nama" => $this->input->post('nama', true),
            "nim" => $this->input->post('nim', true),
            "email" => $this->input->post('email', true),
            "jurusan" => $this->input->post('jurusan', true),
            'BY-KEY' => 'by123'
        ];
        $response = $this->client->request('POST', 'mahasiswa',[
            'form_params' => $data
        ]);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function hapusDataMahasiswa($id)
    {
        $response = $this->client->request('DELETE', 'mahasiswa',[
            'form_params' => [
                'id' => $id,
                'BY-KEY' => 'by123'
            ]
        ]);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function ubahDataMahasiswa()
    {
        $data = [
            "nama" => $this->input->post('nama', true),
            "nim" => $this->input->post('nim', true),
            "email" => $this->input->post('email', true),
            "jurusan" => $this->input->post('jurusan', true),
            "id" => $this->input->post('id', true),
            'BY-KEY' => 'by123'
        ];
        $response = $this->client->request('PUT', 'mahasiswa',[
            'form_params' => $data
        ]);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }
}