<?php
/**
 * SocialAuther (http://socialauther.stanislasgroup.com/)
 *
 * @author: Stanislav Protasevich
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

namespace frontend\models\social;

interface AdapterInterface
{
    /**
     * Authenticate and return bool result of authentication
     *
     * @return bool
     */
    public function authenticate();
}