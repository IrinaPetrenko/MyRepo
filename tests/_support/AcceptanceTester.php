<?php


/**
 * Inherited Methods
 * @method void wantToTest($text)
 * @method void wantTo($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method \Codeception\Lib\Friend haveFriend($name, $actorClass = NULL)
 *
 * @SuppressWarnings(PHPMD)
*/
class AcceptanceTester extends \Codeception\Actor
{
    use _generated\AcceptanceTesterActions;

//    private static $ikeaUser=['xpath'=>".//*[@id='link_header_update_user']"];
//    private static $ikeaUserEmail=['xpath'=>".//*[@id='login_logonId']"];
//    private static $ikeaUserPass=['xpath'=>".//*[@id='login_logonPassword']"];
//    private static $ikeaUserLogin=['xpath'=>".//*[@id='login']/div[7]/input"];
//    private static $ikeaUserRememberMe=['xpath'=>".//*[@id='_rememberMe']"];
//    private static $ikeaUserLogOut=['xpath'=>".//*[@id='txtIKEATagHeader']/a"];
//
//    public function login($name, $password)
//    {
//        $I = $this;
//
//        sleep(5);
//        $I->click(self::$ikeaUser);
//        sleep(5);
//        $I->click(self::$ikeaUserEmail);
//        $I->fillField(self::$ikeaUserEmail,$name);
//        $I->click(self::$ikeaUserPass);
//        $I->fillField(self::$ikeaUserPass,$password);
//        $I->click(self::$ikeaUserRememberMe);
//        $I->click(self::$ikeaUserLogin);
//        sleep(5);
//
//
//    }

   /**
    * Define custom actions here
    */
}
