<?php
/**
 * Created by PhpStorm.
 * User: tweety
 * Date: 23/03/15
 * Time: 21:00
 */

namespace AppBundle\Business;


use AppBundle\Entity\Vdm;

class VdmBusiness {

    public static function parseOneVdm(\DOMElement $node) {

        $p = $node->getElementsByTagName("p");
        $text = "";
        if ($p->length > 0) {
            $a = $p->item(0)->getElementsByTagName("a");
            for ($i = 0; $i < $a->length; $i++) {
                if (strpos($a->item($i)->nodeValue, "VDM") === FALSE) {
                    $text .=  $a->item($i)->nodeValue;
                }
            }
        }

        $div = $node->getElementsByTagName("div");
        $when = "";
        $who = "";
        for ($i = 0; $i < $div->length; $i++) {
            if ($div->item($i)->getAttribute("class") == "right_part") {
                // getting date and hour
                $pattern = '/([\d]{2}\/[\d]{2}\/[\d]{4} à [\d]{2}:[\d]{2})/i';
                $matches = array();
                if (preg_match($pattern, $div->item($i)->nodeValue, $matches)) {
                    $whenFull = str_replace("à", "", $matches[0]);
                    $format = 'd/m/Y H:i';
                    $when = \DateTime::createFromFormat($format, $whenFull);
                };

                // getting author
                $pattern = '/- par ([a-zA-Z\d]*)\w[\(]*/i';
                $matches = array();
                if (preg_match($pattern, $div->item($i)->nodeValue, $matches)) {
                    $who = substr($matches[0], 6);
                };
            }
        }

        $vdm = new Vdm();
        $vdm->setContent(trim($text);
        $vdm->setAuthor($who);
        $vdm->setWhen($when);

        return $vdm;
    }
}