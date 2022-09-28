<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Support\Jsonable;

use Illuminate\Http\Request;

class FormatterController extends Controller
{
    public function igor($objeto,$estadohttp,$todolodemas)
    {
        $forma = null;
                        
        if($objeto)
            $forma = $objeto->jsonSerialize();
        else
            $forma = $this->esqueleto();

        $forma["igor"] = true;
                
        if(isset($todolodemas["error"])) $forma["error"] = $todolodemas["error"];
        else $forma["error"] = null;

        if(isset($todolodemas["warning"])) $forma["warning"] = $todolodemas["warning"];
        else $forma["warning"] = null;

        if(isset($todolodemas["info"])) $forma["info"] = $todolodemas["info"];
        else $forma["info"] = null;

        $forma = response()->json($forma,$estadohttp);

        return $forma;
    }

    public function esqueleto()
    {
        $esqueleto = [];
        $esqueleto["current_page"] = null;
        $esqueleto["data"] = null;
        $esqueleto["first_page_url"] = null;
        $esqueleto["from"] = null;
        $esqueleto["last_page"] = null;
        $esqueleto["last_page_url"] = null;
        $esqueleto["next_page_url"] = null;
        $esqueleto["path"] = null;
        $esqueleto["per_page"] = null;
        $esqueleto["prev_page_url"] = null;
        $esqueleto["to"] = null;
        $esqueleto["total"] = null;

        return $esqueleto;
    }
}
