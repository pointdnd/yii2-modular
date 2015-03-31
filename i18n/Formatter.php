<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace mii\i18n;

class Formatter extends \yii\i18n\Formatter
{
    /**
    * Trunca una cadena a un límite de palabras y agrega un caracter al final
    *
    * @access public
    * @param String $str Cadena original
    * @param Integer $limit límite de palabras
    * @param String $endchar
    * @return String cadena truncada
    */
    public function toBr($str='')
    {
        return nl2br($str);
    }

    public function formatDayComment($data)
    {
        $data=date("Y-m-d",strtotime($data));
        $diferencia=(strtotime(date("Y-m-d")) - strtotime($data)) / 60 / 60 / 24;
        if(date("Y-m-d")==$data)
        {
            return "Hoy";
        }
        if($diferencia < 0)
        {
            if($diferencia==-1)
                return "Mañana";
            else if($diferencia==-2)
                return "Pasado mañana";
            else
                return "En ".abs((int)$diferencia)." Días";
        }

        if($diferencia==1)
            return "Ayér";
        elseif($diferencia==2)
            return "Antes de ayér";
        else
            return "Hace ".abs((int)$diferencia)." Días ";
    }

    /**
    * Cadena con fecha en formato de oración
    * @param Date $date
    * @param Boolean $hora true para concatenar hora
    */
    public function formatSayDay($date)
    {
        $fecha = $this->dias[date("w",strtotime($date))];
        return $fecha;
    }

    public function formatAgoComment($ptime)
    {
        $ptime=strtotime($ptime);
        $etime = time() - $ptime;

        if ($etime < 1)
            return 'Justo ahora';
       
        $a = array( 12 * 30 * 24 * 60 * 60  =>  'año',
                    30 * 24 * 60 * 60       =>  'mes',
                    24 * 60 * 60            =>  'día',
                    60 * 60                 =>  'hora',
                    60                      =>  'minuto',
                    1                       =>  'segunto'
                    );

        foreach ($a as $secs => $str)
        {
            $d = $etime / $secs;
            if ($d >= 1)
            {
                $r = round($d);
                return 'Hace '.$r . ' ' . $str . ($r > 1 ? '(s)' : '') . '';
            }
        }
    }

    public function ago($date)
    {
        return $this->formatAgoComment($date);
    }
    public function trimAndLower($cadena)
    {
        $originales = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ';
        $modificadas = 'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr';
        $cadena = utf8_decode($cadena);
        $cadena = strtr($cadena, utf8_decode($originales), $modificadas);
        $cadena = strtolower($cadena);
        $return=utf8_encode($cadena);
        return strtr($return,array(" "=>"-","/"=>"-","\\"=>"-","\'"=>"-","?"=>"-","="=>"-"));
    }

    /**
     * Formats the value as a number using PHP number_format() function.
     * @param mixed $value the value to be formatted
     * @return string the formatted result
     * @see numberFormat
     */
    public function formatMoney($value)
    {
        return number_format($value,2,".",",");
    }

    public function dateDot($value)
    {
        return date('d',strtotime($value))."/".date('m',strtotime($value))."/".strtr(number_format(date('Y',strtotime($value))),array(","=>"."));
    }

    public function sirToHtml($field_sir)
    {
        include_once(dirname(__FILE__)."/parsedown/Parsedown.php");
        $Parsedown = new Parsedown();

        $html="";
        $array=CJSON::decode($field_sir);
        foreach($array['data'] as $data)
        {
            if($data['type']==='heading')
                $html.="<h1>".strtr($Parsedown->text($data['data']['text']),array("<p>"=>"","</p>"=>""))."</h1>";
            if($data['type']==='text')
                $html.=strtr($Parsedown->text($data['data']['text']),array("<p></p>"=>""));
            if($data['type']==='list')
                $html.="<ul>".implode("</li><li>",explode("-",$Parsedown->text($data['data']['text'])))."</li></ul>";
            if($data['type']==='quote')
            {
                $html.="<blockquote class=\"blockquote-reverse\">";
                $html.=$Parsedown->text($data['data']['text']);
                $html.="<footer><cite title=\"Source Title\">".$Parsedown->text($data['data']['cite'])."</cite></footer>";
                $html.="</blockquote>";
            }
            if($data['type']==='image') {
                $html.="<img class=\"img-responsive mbm mtm\" src=\"".@$data['data']['file']['url']."\">";
                if(!empty($data['data']['alt'])) {
                    $html.="<div class=\"alt-text-for-image\">".$data['data']['alt']."</div>";
                }
            }
            if($data['type']==='video')
            {
                if(strpos($data['data']['source'],"youtube")!==false)
                    $html.="<div class=\"embed-responsive embed-responsive-16by9\"><iframe class=\"embed-responsive-item\" src=\"http://www.youtube.com/embed/".$data['data']['remote_id']."\" width=\"580\" height=\"320\" frameborder=\"0\" allowfullscreen=\"\"></iframe></div>";
                else
                    $html.="<div class=\"embed-responsive embed-responsive-16by9\"><iframe class=\"embed-responsive-item\" src=\"http://player.vimeo.com/video/".$data['data']['remote_id']."?title=0&amp;byline=0\" width=\"580\" height=\"320\" frameborder=\"0\"></iframe></div>";
            }
            if($data['type']==='tweet')
                $html.="TODO";
        }
        return $html;
    }
}
