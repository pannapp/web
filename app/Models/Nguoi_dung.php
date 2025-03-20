<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nguoi_dung extends Model
{
    protected $table = "nguoi_dung";
    protected $fillable= ['ho_ten','ngay_sinh','email','sdt','tai_khoan','mat_khau'];
    protected $guarded=['id'];
    protected $primaryKey="id";
    protected $dateFormat   = 'd-m-Y H:i:s';
}
