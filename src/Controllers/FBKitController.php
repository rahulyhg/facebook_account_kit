<?php
namespace Bundles\Controllers;

use Bundles\Models\FBConnection;
use Bundles\Models\Initialization;

class FBKitController extends Initialization
{

    private static $fbAppId;
    private static $fbAppSecret;
    private static $fbAppApiVersion;

    public function __construct()
    {
        parent::__construct();

        self::$fbAppId = $this->config['facebook_app_kit_id'];
        self::$fbAppSecret = $this->config['facebook_app_kit_secret'];
        self::$fbAppApiVersion = $this->config['facebook_app_kit_api_version'];

        session_start();
    }

    /**
     * Authorization
     *
     * @return bool
     */
    public function actionAuth()
    {

        require_once(ROOT . '/src/Views/auth/fb_kit.php');
        return true;
    }

    /**
     * Render success page
     *
     * @return bool
     */
    public function actionSuccess()
    {
        /**
         * Exchange authorization code for access token
         */
        $token_exchange_url = 'https://graph.accountkit.com/' . self::$fbAppApiVersion . '/access_token?' .
            'grant_type=authorization_code' .
            '&code=' . $_POST['code'] .
            "&access_token=AA|" . self::$fbAppId . "|" . self::$fbAppSecret;

        $data = FBConnection::doCurl($token_exchange_url);

        $_SESSION['fb']['user_id'] = $data['id'];
        $_SESSION['fb']['access_token'] = $data['access_token'];
        $_SESSION['fb']['refresh_interval'] = $data['token_refresh_interval_sec'];

        require_once(ROOT . '/src/Views/message/login_success.php');
        return true;
    }

    /**
     * Get account info
     *
     * @return bool
     */
    public function actionGetAccountKitInformation()
    {
        $me_endpoint_url = 'https://graph.accountkit.com/'. self::$fbAppApiVersion .'/me?'.
            'access_token=' . $_SESSION['fb']['access_token'];

        $accountKitInfo = FBConnection::doCurl($me_endpoint_url);
        FBConnection::validateResponse($accountKitInfo);

        $phone = isset($accountKitInfo['phone']) ? $accountKitInfo['phone']['number'] : '';
        $email = isset($accountKitInfo['email']) ? $accountKitInfo['email']['address'] : '';

        require_once(ROOT . '/src/Views/auth/account_kit.php');
        return true;
    }

    /**
     * Error page
     *
     * @return bool
     */
    public function actionError(){
        $msgJson = $_GET['msg'];
        $msg = json_decode($msgJson, true);

        require_once(ROOT . '/src/Views/message/error.php');
        return true;
    }

}