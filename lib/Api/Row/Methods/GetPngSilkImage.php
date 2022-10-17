<?php
/**
 * Created by PhpStorm.
 * User: Oleg_Symonchuk
 * Date: 04/1/15
 * Time: 3:44 PM
 */

namespace Api\Row\Methods;

/**
 * Class GetPngSilkImage
 *
 * returns Owner Silks PNG image name
 *
 * $package \Api\Row\Methods
 */
trait GetPngSilkImage
{
    /**
     * @param   int|null $owner_uid
     */
    public function getPngSilkImage(int $owner_uid = null)
    {
        $owner_uid = $this->owner_uid ?? $owner_uid;
        if (empty($owner_uid)) {
            return null;
        }

        $conf = \Phalcon\DI::getDefault()->get('config');

        $imgURL = (isset($conf->application->imagesurl) && isset($conf->application->pngsilkuri)) ?
            $conf->application->imagesurl . '/' . $conf->application->pngsilkuri . '/' : '';

        $rpOwnerChoice = '';

        if ((isset($this->rp_owner_choice))) {
            $rpOwnerChoice = trim($this->rp_owner_choice);
            if ($rpOwnerChoice == 'a') {
                $rpOwnerChoice = '';
            }

            // 194 is a ascii char code of box drawing character
            $noSilkChosenFlag = 194;

            // There is a special flag if the owner has no silk choice, if this
            // flag is present we must add an empty silk image based on a custom logic.
            if (ord($rpOwnerChoice) == $noSilkChosenFlag) {
                return $imgURL . 'empty.png';
            };
        }

        $silkName = (string)$owner_uid . $rpOwnerChoice;
        $digits = array_reverse(str_split(substr($silkName, -3)));

        return $imgURL . implode($digits, '/') . '/' . $silkName . '.png';
    }

    /**
     * Generate png silk image url with http, it is needed only for native for now.
     * Owner choice is a suffix that is required by some endpoints to indicate the
     * number of choice of the owner's silk.
     *
     * @param   int|null $owner_uid
     * @param   string|null $rp_owner_choice
     */
    public function getPngSilkImageNative(int $owner_uid = null, string $rp_owner_choice = null)
    {
        $owner_uid = $this->owner_uid ?? $owner_uid;
        if (empty($owner_uid)) {
            return null;
        }

        $conf = \Phalcon\DI::getDefault()->get('config');

        if (isset($rp_owner_choice)) {
            $this->rp_owner_choice = $rp_owner_choice;
        }

        $imgURL = $this->getPngSilkImage($owner_uid);

        // We set rp_owner_choice in the function getPngSilkImage
        // we unset it on every iteration just in case to prevent
        // cloning of values where we don't need them.
        if (isset($rp_owner_choice)) {
            unset($this->rp_owner_choice);
        }

        $regex = '/^http/';
        if (!preg_match($regex, $imgURL) && isset($conf->application->imagesurl) && isset($conf->application->pngsilkuri)) {
            $imgURL = 'http:' . $imgURL;
        }
        return $imgURL;
    }
}
