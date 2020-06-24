<?php
/**
 * Desc: Please give a desc.
 * Created by PhpStorm.
 * User: Jiangliang
 * Date: 2018/6/24
 * Time: 17:24
 * Email: jiangliang@tanwan.com
 */
require __DIR__ . '/Helper.php';

use App\Service\Response;

class Upload
{
    /**
     * @var string
     */
    private $savePath = '/assets/upload/images';

    /**
     * @var array
     */
    private $allowExt = ['jpg', 'jpeg', 'gif', 'png'];

    /**
     * Upload constructor.
     */
    public function __construct()
    {
    }

    public function start()
    {
        $file = $_FILES['file'];
        if(is_uploaded_file($file)) {

            if (!is_dir($this->savePath) && !mkdir($this->savePath, 0755,  true)){
                json_back([
                    "status" => Response::ERROR,
                    "message" => realpath($this->savePath) . 'can not create.'
                ]);
            };

            if (!is_writable($this->savePath)) {
                json_back([
                    "status" => Response::ERROR,
                    "message" => realpath($this->savePath) . 'can not write.'
                ]);
            }

            $ext = pathinfo($file, PATHINFO_EXTENSION);
            if(!in_array($ext, $this->allowExt)) {
                json_back([
                    "status" => Response::ERROR,
                    "message" => "extension can not be allowed."
                ]);
            }

            $saveName = md5(microtime(true)). $ext;
            if(move_uploaded_file($file['tmp_name'], $saveName)) {
                json_back([
                    "status" => Response::SUCCESS,
                    "message" => "upload success.",
                    "data" => $this->savePath. '/' . $saveName
                ]);
            } else {
                json_back([
                    "status" => Response::ERROR,
                    "message" => "upload fail."
                ]);
            }

        } else {
            json_back([
                "status" => Response::ERROR,
                "message" => "非法文件"
            ]);
        }
    }
}

(new Upload())->start();