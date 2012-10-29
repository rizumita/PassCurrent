<?php

return array(
    'files_dir'       => APPPATH.'files',              // パス毎に証明書や画像を保存するディレクトリ
    'WWDR_cert'       => APPPATH.'cert/wwdr.pem',      // WWDR証明書パス
    'pkpasses_dir'    => DOCROOT.'passes',             // pkpassファイルの格納場所
    'pkpasses_url_path' => '/passes',
);

/* End of file pass.php */