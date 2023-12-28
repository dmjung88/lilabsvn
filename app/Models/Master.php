<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Master extends Model
{
    use HasFactory;
    
    protected $guarded = [ ];
    //protected $primaryKey = 'id';
    //protected $fillable = [ '*' ];
    protected $table = 'T_MASTER_ICE';
    public $incrementing = false;

    //W : 도매장코드, S : 업소코드, G : 상품코드, F : 수리코드, C :회사코드, E : 사번
    public static  function  wCodeSeq() :string
    {       
        $wCount =DB::table('MASTER_WHOLESALE')->count();
        $length = strlen( $wCount );
        switch ($length) {
            case 1: return "000".$wCount + 1; break;
            case 2: return "00" .$wCount + 1; break;
            case 3: return "0"  .$wCount + 1; break;
            default: return   $wCount + 1;
        }
        exit;
    }
    public static  function  sCodeSeq() :string
    {       
        $wCount =DB::table('MASTER_STORE')->count();
        $length = strlen( $wCount );
        switch ($length) {
            case 1: return "000".$wCount + 1; break;
            case 2: return "00" .$wCount + 1; break;
            case 3: return "0"  .$wCount + 1; break;
            default: return   $wCount + 1;
        }
        exit;
    }
    public static  function  gCodeSeq() :string
    {       
        $wCount =DB::table('MASTER_GOODS')->count();
        $length = strlen( $wCount );
        switch ($length) {
            case 1: return "000".$wCount + 1; break;
            case 2: return "00" .$wCount + 1; break;
            case 3: return "0"  .$wCount + 1; break;
            default: return   $wCount + 1;
        }
        exit;
    }
    public static  function  fCodeSeq() :string
    {       
        $wCount =DB::table('MASTER_FIX')->count();
        $length = strlen( $wCount );
        switch ($length) {
            case 1: return "000".$wCount + 1; break;
            case 2: return "00" .$wCount + 1; break;
            case 3: return "0"  .$wCount + 1; break;
            default: return   $wCount + 1;
        }
        exit;
    }
    public static  function  cCodeSeq() :string
    {       
        $wCount =DB::table('MASTER_ICE')->count();
        $length = strlen( $wCount );
        switch ($length) {
            case 1: return "000".$wCount + 1; break;
            case 2: return "00" .$wCount + 1; break;
            case 3: return "0"  .$wCount + 1; break;
            default: return   $wCount + 1;
        }
        exit;
    }
    public static  function  eCodeSeq() :string
    {       
        $wCount =DB::table('MASTER_EMP')->count();
        $length = strlen( $wCount );
        switch ($length) {
            case 1: return "000".$wCount + 1; break;
            case 2: return "00" .$wCount + 1; break;
            case 3: return "0"  .$wCount + 1; break;
            default: return   $wCount + 1;
        }
        exit;
    }
}
