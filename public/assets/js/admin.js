/**
 * Created with JetBrains PhpStorm.
 * User: rizumita
 * Date: 2012/10/28
 * Time: 15:55
 * To change this template use File | Settings | File Templates.
 */

function generate_pkpass(id) {
    var password = prompt("Input certificate password", "");

    if (password == "") {
        alert('Cancel to generate');
        return false;
    } else {
        $('#form_cert_password_'+ id).val(password);
        return true;
    }
}