<?php

namespace App\Controllers;


use Config\{Database,Services};

error_reporting(E_ALL & ~E_NOTICE);
session_start();
date_default_timezone_set('Asia/Jakarta');

class GlobalController extends BaseController {
    private $tempData;

    public $validator = null;
    public $targetRole,$err_validating_param;

    protected $errorDetails = [];
    protected $db;

    public function __construct() {
        // Checking CI VERSION
        if(defined('CI_VERSION')) {
            $fmVersion =& get_instance();
            $this->db  = $fmVersion->db;
        }else {
            $this->db = Database::connect();
        }
    }

    private function logError($e) {
        var_dump($e->getMessage() . " Line : " . $e->getLine());
    }

    private function flash() {

    }

    private function rekursifValidate($r,$data) {
        $data = [];
        if (array_keys($r)[0] == range(0,count($r)-1)) {
            for ($i=0; $i < count($r); $i++) {
                if (is_array($r[$i])) {
                    $data[$i] = [];
                    if (count($r[$i]) > 0) $data[$i] = $this->rekursifValidate($r[$i],$data[$i]);
                }else{
                    $data[$i] = str_replace("--","\-\-",addslashes(trim(htmlentities(strip_tags(str_replace("  "," ",$r[$i]))))));
                }
            }
        }else{
            $idx = 0;
            foreach ($r as $key => $req) {
                if (is_numeric($key)) {
                    if (is_array($req)) {
                        $data[$idx] = [];
                        $data[$idx] = $this->rekursifValidate($req,$data[$idx]);
                    }else{
                        $data[$idx] = str_replace("--","\-\-",addslashes(trim(htmlentities(strip_tags(str_replace("  "," ",$req))))));
                        if ($data[$idx] == "") $data[$idx] = null;
                    }
                    $idx++;
                }else{
                    if (is_array($req)) {
                        $data[$key] = [];
                        $data[$key] = $this->rekursifValidate($req,$data[$key]);
                    }else{
                        $data[$key] = str_replace("--","\-\-",addslashes(trim(htmlentities(strip_tags(str_replace("  "," ",$req))))));
                        if ($data[$key] == "") $data[$key] = null;
                    }
                }
            }
        }
        return $data;
    }

    public function validateInput($request, $except = [], $callback = null)
    {
        $this->tempData = [];
        $data           = $request->getPost();

        foreach ($data as $key => $value) {

            if (is_array($value)) {
                $this->tempData[$key] = [];

                if (count($value) > 0) {
                    $this->tempData[$key] = $this->rekursifValidate($value, $this->tempData[$key]);
                }

            } else {
                $cleanedValue = str_replace(
                    "--",
                    "\-\-",
                    addslashes(trim(htmlentities(str_replace("</script>", "", str_replace("<script", "", str_replace("  ", " ", $value))))))
                );
                $this->tempData[$key] = $cleanedValue === '' ? null : $cleanedValue;
            }
        }

        if ($callback) {
            $callback($this->tempData);
        } else {
            return $this->tempData;
        }
    }


    public function deleteAllFiles($scans,$baseUrl) {
        if (is_array($scans[0])) {
            for ($scansi=0; $scansi < count($scans); $scansi++) {
                for ($loop=2; $loop < count($scans[$scansi]) ; $loop++) {
                    unlink($baseUrl[$scansi].$scans[$scansi][$loop]);
                }
            }
        }else{
            for ($loop=2; $loop < count($scans) ; $loop++) {
                unlink($baseUrl.$scans[$loop]);
            }
        }
    }

    public function validateFormat($arr, $data) {
        foreach($arr as $key => $val) {
            $date = str_replace('-', '/', $val);
            $date = preg_replace('/^(\d{2})\/(\d{2})\/(\d{4})$/', '$3-$2-$1', $date);

            $data[$key] = $date;
        }
        return $data;
    }

    public function validatingParam($request, $rules, $sendDetailError = false)
    {
        $validation = Services::validation();
        $validation->setRules($rules);

        if (!$validation->run($request->getPost())) {
            $errors = $validation->getErrors();
            if ($sendDetailError) {
                $this->flash(["error", implode(", ", $errors)]);
            } else {
                $detailedErrors = [];
                foreach ($errors as $field => $message) {
                    $detailedErrors[$field] = $message;
                }
                $this->errorDetails = $detailedErrors;
            }
            $this->err_validating_param = $errors;
            return 0;
        }
        return 1;
    }


    public function getErrorDetails() {
        return $this->errorDetails;
    }

    protected function queryBuilder($processType = null, $callback, $catch = null)
    {
        $messages = [
            'store'  => ["success-store", "err-store"],
            'update' => ["success-update", "err-update"],
            'cancel' => ["success-cancel", "err-cancel"],
            'delete' => ["success-delete", "err-delete"]
        ];

        $msg = $messages[$processType] ?? ["success", "error"];

        $this->db->transStart();
        try {
            $result = $callback();
            $this->db->transComplete();

            if ($this->db->transStatus() === false) {
                throw new Exception("Database transaction failed.");
            }


        } catch (Exception $e) {
            $this->db->transRollback();

            log_message('error', $e->getMessage());

            if ($catch) {
                return $catch($e);
            }

            return null;
        }

        return $result ?? null;

    }

    protected function dump(mixed $data): void
    {
        echo "<pre>";
        if (is_array($data) || is_object($data)) {
            print_r($data);
        } else {
            var_dump($data);
        }
        echo "</pre>";
        die;
    }

}