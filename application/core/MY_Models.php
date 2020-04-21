<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MY_Models extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->db->db_debug = false;
    }

    public function get()
    {
        return $this->db->get($this->table);
    }

    public function getByKey($params)
    {
        return $this->db->get_where($this->table, [$this->key => $params]);
    }

    public function getBy($data = [])
    {
        return $this->db->get_where($this->table, $data);
    }

    public function update($data = [], $key = [], $returning = false)
    {
        $ok = $this->db->update($this->table, $data, $key);
        if ($returning) {
            if ($ok) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function delete($key = [], $returning = false)
    {
        $ok = $this->db->delete($this->table, $key);
        if ($returning) {
            if ($ok) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function insert($data = [], $returning = false)
    {
        $ok = $this->db->insert($this->table, $data);
        if ($returning) {
            if ($ok) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function joins($table = [], $index = [], $type = [], $condition = [], $orderby = [])
    {
        $args = "";
        $cond = "";
        $sort = "";
        $shuffle = str_shuffle($this->table);
        $chr = substr($shuffle, strlen($shuffle) - 2, strlen($shuffle));
        if (!empty($condition)) {
            foreach ($condition as $c => $value) {
                $cond .=  $c . "='" . $value . "' AND ";
            }
        }
        for ($x = 0; $x < count($table); $x++) {
            for ($y = $x; $y <= $x; $y++) {
                $key = $this->getKey($table[$x]);
                $x_shuffle = str_shuffle($table[$x]);
                $cut_str = substr($x_shuffle, strlen($x_shuffle) - 2, strlen($x_shuffle));
                $jtype = !empty($type[$y]) ? " " . strtoupper($type[$y]) . " " : " JOIN ";
                $args .= $jtype . $table[$x] . ' ' . $cut_str . " ON " . $chr . "." . "$index[$y]" . "=" . $cut_str . "." . $key;
            }
        }

        if (!empty($orderby)) {
            foreach ($orderby as $o => $val) {
                $sort .= " ORDER BY " . $o . " " . $val;
            }
        }

        $z = !empty($cond) ? " WHERE " . substr($cond, 0, strlen($cond) - 5) : "";
        $query = "SELECT * FROM " . $this->table . ' ' . $chr . $args . $z . $sort;
        return $this->db->query($query);
    }

    public function getAutoIncrement()
    {
        $query = "SELECT `AUTO_INCREMENT` FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA ='$this->schema' AND TABLE_NAME='$this->table'";
        return $this->db->query($query)->result_array()[0]['AUTO_INCREMENT'];
    }

    public function getKey($table = null)
    {
        $fields = $this->db->list_fields($table != null ? $table : $this->table);
        foreach ($fields as $field) {
            return $field;
        }
    }

    public function getfields()
    {

        $query = $this->db->query('SELECT * FROM ' . $this->table . ' limit 1');

        $fields = array();
        foreach ($query->list_fields() as $field) {
            $fields[] = $field;
        }

        return $fields;
    }

    public function beginTrans()
    {
        $this->db->trans_start();
    }

    public function statusTrans()
    {
        return $this->db->trans_status();
    }

    public function commitTrans($ok)
    {
        if ($ok) {
            $this->db->trans_commit();
            return true;
        } else {
            $this->db->trans_rollback();
            return false;
        }
    }
}
