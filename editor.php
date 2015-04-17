<?php
/**
 * Created by PhpStorm.
 * User: stephen
 * Date: 4/17/15
 * Time: 11:03 AM
 */
include_once 'postfix_email.php';


class editor {
    /**
     *
     */
    public function __construct(){

    }

    /**
     * Prints out the page.
     */
    public static function display($id = null){

        // shows the editor. if no id is specified, it displays blank fields (new entry).
        $email_id = $_REQUEST['id'];
        $email = new postfix_email($email_id);
        ?>
<html>
<body>
<form action="index.php" method="post">
    <input type="email" id="address" />
</form>
</body>
</html>
<?php
    }
}
