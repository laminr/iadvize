<?php
/**
 * Created by PhpStorm.
 * User: Thibault de Lambilly
 * Date: 23/03/15
 * Time: 21:00
 */

namespace AppBundle\Business;


use AppBundle\Entity\Vdm;

class ApiBusiness {

    public static function vdmToApiFormat(Vdm $vdm) {

        return $vdmJson = array(
            "id" => $vdm->getId(),
            "content" => $vdm->getContent(),
            "date" => $vdm->getWhen()->format("Y-m-d H:i:s"),
            "author" => $vdm->getAuthor(),
        );
    }
}