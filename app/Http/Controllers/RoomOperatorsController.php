<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RoomOperatorsController extends Controller
{

    /**
     * Ez olyan felület legyen mint a volhuban a beosztó meg az elerkezett az időn a termék választó amit csináltál.
     *  Tehát egyik oldalról akit át billentesz ember, lefut a fetch es beleteszi a DB-be 
     */
    /**
     * ez a kivalszto felulet a view lesz
     */
    
    public function selectOperator(Request $request)
    {

        return view('operators.addoperator');
    }

    /**
     * Hozzad egy operatort
     * 
     * Ez fogja a insertet kezelni
     */
    public function addOperator(Request $request)
    {

    }


    /**
     * Az adatbazisbol eltavlit egy operatort
     */
    public function removeOperator(Request $request)
    {

    }
}
