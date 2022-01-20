<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code


define('PACKAGE_NAME', 'bhindimanu');

//Issue Receive Type ID
define('MANUFACTURE_TYPE_ISSUE_ID', 1);
define('MANUFACTURE_TYPE_RECEIVE_ID', 2);

define('MANUFACTURE_TYPE_ISSUE_FINISH_ID', 1);
define('MANUFACTURE_TYPE_ISSUE_SCRAP_ID', 2);
define('MANUFACTURE_TYPE_RECEIVE_FINISH_ID', 3);
define('MANUFACTURE_TYPE_RECEIVE_SCRAP_ID', 4);

// Process ID
define('CASTING_PROCESS_ID', 0);


define('KAARIGAR_PROCESS_ID', 1);
define('POLISH_PROCESS_ID', 2);
define('SETTINGS_PROCESS_ID', 3);
define('MEENA_PROCESS_ID', 4);
define('JADTAR_PROCESS_ID', 5);
define('BANDHANU_PROCESS_ID', 6);

// Items ID
define('ITEM_VETRAN_ID', 5);
define('ITEM_CHOL_ID', 16);

//----- Master Module Constants -----
define("MASTER_MODULE_ID", 1); //1
define("PARTY_MODULE_ID", 2); //1.1
define("ITEM_MODULE_ID", 3); //1.2
define("DESIGN_NO_MODULE_ID", 4); //1.3
define("PROCESS_MASTER_MODULE_ID", 5); //1.4
define("JOB_WORKER_MODULE_ID", 6); //1.5
define("MOTI_MODULE_ID", 15); //1.6
define("CHARGES_MODULE_ID", 16); //1.6
define("USER_MODULE_ID", 8); //1.7
define("USER_RIGHTS_MODULE_ID", 9); //1.8

//----- OTHER Module Constants -----
define("JOB_CARD_ENTRY_MODULE_ID", 10); //2
define("MANUFACTURE_MODULE_ID", 11); //3
define("PAYMENT_RECEIPT_MODULE_ID", 17); //4

define("REPORT_MODULE_ID", 12); //2
define("AD_PCS_REPORT_MODULE_ID", 13); //3
define("ITEM_STOCK_STATUS_REPORT_MODULE_ID", 18); //9.2
define("PERSON_LEDGER_REPORT_MODULE_ID", 19); //9.3
define("BACKUP_MODULE_ID", 14); //10

//----- Count Loss On -----
define("COUNT_LOSS_ON_WEIGHT", 1);
define("COUNT_LOSS_ON_PCS", 2);
define("LABOR_ON_PCS", 1);
define("LABOR_ON_ADPCS", 2);

define("MOTI_WT_TO_CT_TO_AMOUNT", 5);