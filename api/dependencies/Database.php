<?php
class Database
{
    private mysqli $client;

    function __construct($client)
    {
        $this->client = $client;
    }

    public function sql($sql, $vals = [], $act = false)
    {
        $stmt = $this->client->prepare($sql);
        if (!empty($vals) && is_array($vals)) {
            $types = ['integer' => 'i', 'boolean' => 'i', 'double' => 'd', 'string' => 's', 'NULL' => 's'];
            $bind = [''];
            $len = count($vals);
            for ($i = 0; $i < $len; $i++) {
                $bind[0] .= $types[gettype($vals[$i])];
                $bind[] = &$vals[$i];
            }

            call_user_func_array([$stmt, 'bind_param'], $bind);
            $stmt->execute();
        } else {
            $stmt->execute();
        }

        if ($stmt->error) {
            DI::logger()->log($stmt->error, [], LOGGERS::database, LEVELS::notice);
        }

        if ($act == 1) {
            $stmt->store_result();
            return $stmt->num_rows;
        } elseif ($act == 2) {
            $res2 = $stmt->get_result();
            $result = [];
            while ($res = $res2->fetch_array(MYSQLI_ASSOC)) {
                if (count($res) == 1) {
                    foreach ($res as $v) {
                        $result[] = $v;
                    }
                } elseif (count($res) > 1) {
                    $result[] = $res;
                }
            }
        } elseif ($act == 3) {
            $res2 = $stmt->get_result();
            while ($res = $res2->fetch_array(MYSQLI_ASSOC)) {
                $result[] = $res['Field'];
            }
        } else {
            if (strtoupper(substr($sql, 0, 6)) == 'INSERT') {
                return $stmt->insert_id;
            }
            return $stmt;
        }
        if ($this->client->error) {
            die($this->client->error);
        }
        $stmt->close();
        return $result;
    }

    public function col(string $table, string $col)
    {
        return DI::database()->sql("SELECT `$col` FROM `$table`", false, 2);
    }

    public function getOne($sql, $vals)
    {
        $res = DI::database()->sql($sql, $vals, 2);
        if (empty($res)) {
            return false;
        } else {
            return $res[0];
        }
    }

    public function insert($table, $cols, $vals)
    {
        $sql = "INSERT INTO `" . $table . "` (`" . implode('`,`', $cols) . "`) VALUES";
        $addedVals = [];
        if (is_array($vals[0])) {
            for($i = 0; $i < count($vals); $i++) {
                $sql .= "\n(" . rtrim(str_repeat('?,', count($vals[$i])), ',') . '),';
                $addedVals = array_merge($addedVals, $vals[$i]);
            }
        } else {
            $colCount = count($cols);
            $valCount = count($vals);

            if ($valCount > $colCount && $valCount % $colCount == 0) {
                $sql .= rtrim(str_repeat("\n(" . rtrim(str_repeat('?,', $colCount), ',') . "),", $valCount / $colCount), ',');
            } else {
                $sql .= "\n(" . rtrim(str_repeat('?,', $valCount), ',') . ")";
            }
            $addedVals = array_merge($addedVals, $vals);
        }
        $sql = rtrim($sql, ',') . ";";

        return $this->sql($sql, $addedVals);
    }

    public function empty($table, $sql = null)
    {
        if (!$sql) {
            return !$this->sql('SELECT EXISTS (SELECT 1 FROM ' . $table . ')', false, 2)[0];
        }

        return !$this->sql($sql, false, 1);
    }

    public function exist($table)
    {
        return $this->sql('SHOW TABLES LIKE ?', [$table], 1);
    }
}
