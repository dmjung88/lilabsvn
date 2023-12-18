<?php

namespace App\Exports;

use App\Models\AppModelsUser;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeading;

class UserExport implements FromCollection
{
    /** 엑셀 EXPORT 
    * https://www.youtube.com/watch?v=CoQa_Iaa320
    * https://stackoverflow.com/questions/75285913/badmethodcallexception-method-illuminate-foundation-applicationshare-does-not
    */
    public function collection()
    {
        //return AppModelsUser::all();
        //return User::all();
        return collect(User::getAllUsers());
    }
}
