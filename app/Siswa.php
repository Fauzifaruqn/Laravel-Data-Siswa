<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    //
    // menentukan table
    protected $table = 'siswa';

    // Mass assignment, berisi array dari nama nama fieldnya
    protected $fillable = ['nama_depan','nama_belakang','jenis_kelamin','agama','alamat','avatar','user_id'];


    public function getAvatar(){
        if(!$this->avatar){
            return asset('images/default.png');
        }
        return asset('images/'. $this->avatar);
    }

    public function mapel(){
        return $this->belongsToMany(Mapel::class)->withPivot(['nilai'])->withTimeStamps();
    }
}
