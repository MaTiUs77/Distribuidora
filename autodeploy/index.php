<?php #!/usr/bin/env /usr/bin/php
set_time_limit(0);

function putlog($message) {
        $deployLog = './git.log';
        file_put_contents($deployLog, $message."\n", FILE_APPEND);
        echo $message;
}

echo "<pre>";

putlog("WebHook running...");

if ($_SERVER['HTTP_X_GITHUB_EVENT'] == 'push') {
        putlog("GIT PUSH DETECTED");

        $output = shell_exec("./pull.sh 2>&1");

        putlog($output);
} else {
        putlog("GIT PUSH NOT DETECTED");

}
echo "<pre>";

?>
